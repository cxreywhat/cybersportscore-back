import CryptoJS from "crypto-js";
const phps = require('php-serialize');


export function encrypt(data, key) {
    data = atob(data)
    data = JSON.parse(data);

    const iv = CryptoJS.enc.Base64.parse(data.iv);
    key = CryptoJS.enc.Base64.parse(key);
    const value = data.value;

    let decrypted = CryptoJS.AES.decrypt(value, key, {
        iv: iv
    });
    decrypted = decrypted.toString(CryptoJS.enc.Utf8);

    return phps.unserialize(decrypted);
}
