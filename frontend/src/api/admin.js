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

export function logout(data) {
  return request({
    url: '/admin/authorization',
    method: 'delete',
    data
  })
}
