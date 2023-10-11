const { minify } = require("terser");
const fs =  require("fs");

const inputFile = "resources/js/websocket.js";
const outputFile = "public/js/websocket-obfuscated.js";

fs.promises.readFile(inputFile, "utf8")
    .then((code) => {
        return minify(code);
    })
    .then((result) => {
        if (!result.error) {
            return fs.promises.writeFile(outputFile, result.code);
        } else {
            console.error("Error obfuscate:", result.error);
        }
    })
    .then(() => {
        console.log("Success obfuscate", outputFile);
    })
    .catch((error) => {
        console.error("Error:", error);
    });
