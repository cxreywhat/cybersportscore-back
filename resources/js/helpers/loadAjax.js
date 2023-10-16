import {loadArticlesNewsBlock, loadHome, loadMatchBlock, loadMatchBlockInfo, loadNews, loadNewsBlock} from "./ajax";

const currentUrl = window.location.href;

if(currentUrl.match(/\/(\?page=\d+)?$/)) {
    loadMatchBlockInfo()
}
loadHome();
loadMatchBlock()
loadNews();
window.loadArticlesNewsBlock = loadArticlesNewsBlock;
