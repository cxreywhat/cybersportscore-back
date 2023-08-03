export default {
    install() {
        let googleTagString = import.meta.env.VITE_GTAG_LIST;
        if (googleTagString) {
            let gtmHead = document.createElement('script');
            gtmHead.async = true;
            gtmHead.type = 'module';
            gtmHead.innerHTML = `(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','${googleTagString}');`;
            document.head.appendChild(gtmHead);
            let gtmBody = document.createElement('noscript');
            let iframe = document.createElement('iframe');
            iframe.setAttribute('src', `https://www.googletagmanager.com/ns.html?id=${googleTagString}`);
            iframe.setAttribute('height', '0');
            iframe.setAttribute('width', '0');
            iframe.setAttribute('style', 'display:none;visibility:hidden');
            gtmBody.appendChild(iframe);
            document.body.appendChild(gtmBody);
        }

        let yandexTagString = import.meta.env.VITE_YTAG_LIST;
        if (yandexTagString) {
            const yTags = yandexTagString.split('|');
            yTags.map((tag: any) => {
                let yTag = document.createElement('script')
                yTag.async = true;
                yTag.type = 'module';
                yTag.innerHTML = `
                (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                  m[i].l=1*new Date();
                  for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
                  k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
                (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");   ym(${tag}, "init", {
                  clickmap:true,
                  trackLinks:true,
                  accurateTrackBounce:true
                });
            `;
                document.head.appendChild(yTag)

                let yTagNoScript = document.createElement('noscript')
                let yTagNoScriptDiv = document.createElement('div');
                let yTagNoScriptDivImg = document.createElement('img');
                yTagNoScriptDivImg.setAttribute('src', `https://mc.yandex.ru/watch/${tag}`);
                yTagNoScriptDivImg.setAttribute('style', 'position:absolute; left:-9999px');
                yTagNoScriptDivImg.setAttribute('alt', '');
                yTagNoScriptDiv.appendChild(yTagNoScriptDivImg);
                yTagNoScript.appendChild(yTagNoScriptDiv);
                document.head.appendChild(yTagNoScript)
            });
        }
    }
}