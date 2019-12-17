import { asyncRoutes, constantRoutes } from '@/router'
import { getMenuList } from '@/api/menu'
import Layout from '@/layout'

/**
 * Use meta.role to determine if the current user has permission
 * @param roles
 * @param route
 */
function hasPermission(roles, route) {
  if (route.meta && route.meta.roles) {
    return roles.some(role => route.meta.roles.includes(role))
  } else {
    return true
  }
}

/**
 * 后台查询的菜单数据拼装成路由格式的数据
 * @param routes
 * @param data
 */
export function generaMenu(routes, data) {
  // console.log(data)
  data.forEach(item => {
    // alert(JSON.stringify(item))
    // console.log(item)
    const menu = {
      path: item.url === '#' ? item.id + '_key' : item.url,
      component: item.url === '#' ? Layout : () => import(`@/views${item.url}`),
      // hidden: true,
      children: [],
      name: 'menu_' + item.id,
      meta: { title: item.name, icon: item.icon, id: item.id, roles: ['super_admin'] }
    }
    if (item.children && item.children.length > 0) {
      // 设置父级菜单的redirect
      menu.redirect = item.children[0].url
      generaMenu(menu.children, item.children)
    }
    routes.push(menu)
  })
}

/**
 * Filter asynchronous routing tables by recursion
 * @param routes asyncRoutes
 * @param roles
 */
export function filterAsyncRoutes(routes, roles) {
  const res = []
  routes.forEach(route => {
    const tmp = { ...route }
    if (hasPermission(roles, tmp)) {
      if (tmp.children) {
        tmp.children = filterAsyncRoutes(tmp.children, roles)
      }
      res.push(tmp)
    }
  })
  return res
}

const state = {
  routes: [],
  addRoutes: []
}

const mutations = {
  SET_ROUTES: (state, routes) => {
    state.addRoutes = routes
    state.routes = constantRoutes.concat(routes)
  }
}

const actions = {
  generateRoutes({ commit }, roles) {
    return new Promise(resolve => {
      const loadMenuData = []
      // 先查询后台并返回左侧菜单数据并把数据添加到路由
      getMenuList().then(response => {
        const data = response.data
        Object.assign(loadMenuData, data)
        generaMenu(asyncRoutes, loadMenuData)
        let accessedRoutes
        console.log(roles)
        if (roles.includes('super_admin')) {
          // alert(JSON.stringify(asyncRoutes))
          accessedRoutes = asyncRoutes || []
        } else {
          accessedRoutes = filterAsyncRoutes(asyncRoutes, roles)
        }
        commit('SET_ROUTES', accessedRoutes)
        resolve(accessedRoutes)
      }).catch(error => {
        console.log(error)
      })
    })
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
