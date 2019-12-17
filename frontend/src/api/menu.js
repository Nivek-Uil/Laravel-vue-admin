import request from '@/utils/request'

export function getMenuList() {
  return request({
    url: '/admin/menus',
    method: 'get'
  })
}

export function addMenu(data) {
  return request({
    url: '/admin/menus',
    method: 'post'
  })
}

export function updateMenu(id) {
  return request({
    url: '/admin/menus/' + id,
    method: 'put'
  })
}

export function deleteMenu(id) {
  return request({
    url: '/admin/menus/' + id,
    method: 'delete'
  })
}
