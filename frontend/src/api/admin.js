import request from '@/utils/request'

export function login(data) {
  return request({
    url: '/admin/authorization',
    method: 'post',
    data
  })
}

export function getInfo() {
  return request({
    url: '/admin/user',
    method: 'get'
  })
}

export function refreshToken() {
  return request({
    url: '/admin/authorization/current',
    method: 'put'
  })
}

export function logout() {
  return request({
    url: '/admin/authorization/current',
    method: 'delete'
  })
}
