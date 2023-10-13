<a id='embedNews' class="external-post">
</a>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $.ajax({
        url: `/api/news/{{$id}}`,
        method: 'GET',
        success: function(response) {
            createEmbed(response.data);
        },
    });

    function createEmbed(data) {
        const embed = document.getElementById('embedNews');
        embed.setAttribute('href', 'news/' + data.id);
        embed.className = 'external-post';
        embed.innerHTML = `
            <picture>
                <source srcset="/media/news/_182/${data.pic}">
                <img src="/media/news/_182/${data.pic}" loading="lazy">
            </picture>
            <div>
                <div class="exp-title">
                    ${data.title}
                </div>
                <div class="exp-subtitle"></div>
            </div>`
    }
</script>
