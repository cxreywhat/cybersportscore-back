export const getPaginationFromResponse = (response) => {
  return {
    currentPage: response.data.meta.current_page,
    lastPage: response.data.meta.last_page,
  }
}