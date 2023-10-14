import {loadArticlesNewsBlock, loadHome, loadMatchBlock, loadMatchBlockInfo, loadNews, loadNewsBlock} from "./ajax";

const currentUrl = window.location.href;

if(currentUrl.match(/\/(\?page=\d+)?$/)) {
    loadMatchBlockInfo()
}
window.loadArticlesNewsBlock = loadArticlesNewsBlock;
loadHome();
loadMatchBlock()
loadNews();
loadNewsBlock();
