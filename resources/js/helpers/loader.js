export function showLoader(loader, container) {
    $('#' + loader).show();
    $('#' + container).hide();
}

export function hideLoader(loader, container, display) {
    $('#' + loader).hide();
    $('#' + container).css('display', display);
}
