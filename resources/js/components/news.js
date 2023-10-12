export function addNews(items) {
    const elements = items.map((item) => {
        return `
            <a href="/news/${item.id}-${item.eng}" data-block="${item.id}-${item.eng}" class="ajax-news-block transition text-xs font-normal leading-1 inline-block pb-2 text-gray-300">
                <span class="text">${item.title}</span>
            </a>`
    })

    return elements.join('');
}


export function addToNewsPage(items) {
    const elements = items.map((item) => {
        return `
            <a id="news-block" href="/news/${item.id}-${item.eng}" class="ajax-news-block text-xs flex items-center font-normal leading-1 p-3 hover:bg-[#ffffff05] border-b border-gray-700 hover:text-gray-100" data-news-block="${item.id}-${item.eng}}">
                ${item.title}
            </a>`
    })
    return elements.join('');
}
