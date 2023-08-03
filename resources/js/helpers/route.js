// @router: useRouter
// @route: useRoute
// @data { name: {}, query: {}, params: {}}

export const routerReplace = (router, route, data) => {
  let params = {
    ...route.params,
    ...data.params,
  }

  let query = {
    ...route.query,
    ...data.query,
  }

  params = Object.entries(params).reduce((a,[k,v]) => (v == null ? a : (a[k]=v, a)), {})
  query = Object.entries(query).reduce((a,[k,v]) => (v == null ? a : (a[k]=v, a)), {})

  return new Promise(resolve => {
    resolve(
      router.push({
        name: data.name || route.name,
        hash: data.hash || route.hash,
        params: params,
        query: query
      })
    )
  })
}