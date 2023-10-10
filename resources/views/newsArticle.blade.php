@extends('main')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-6 gap-5">
    <div class="col-span-5 lg:col-span-4 bg-[#212D3D]">
        <div class="article-content col-span-2 md:col-span-4 w-full">
            <div class="flex flex-col w-full border border-gray-700 rounded-lg">
                <div class="flex flex-col md:flex-row items-center p-3 border-b border-gray-700">
                    <h4 class="text-m font-extrabold text-gray-500 text-white md:text-l">Article</h4>
                </div>
                <div class="p-4 relative min-h-[285px]">
                    <article itemscope itemtype="http://schema.org/NewsArticle">
                        <div style="display:none" itemprop="identifier" content="fake-identifier"></div>
                        <div style="display:none" itemprop="author" itemscope itemtype="http://schema.org/Person">
                            <span itemprop="name">John Doe</span>
                        </div>
                        <div style="display:none" itemprop="inLanguage" content="en"></div>
                        <picture class="newspic flex mb-4 h-[400px] bg-gray-800">
                            <source srcset="{{asset('/media/news/'.$data->pic == "" ? $data->pic_in : $data->pic)}}">
                            <img loading="lazy" src="{{asset('/media/news/'.$data->pic == "" ? $data->pic_in : $data->pic)}}" itemprop="image" class="rounded-md">
                        </picture>
                        <section class="articleBody" itemprop="articleBody">
                            <h1 itemprop="headline">{{$data->title}}</h1>
                            <i class="time sct text-gray-500 italic block mb-10 text-xs">
                                {{ $formattedDate }}
                            </i>
                            @foreach($blocks as $block)
                                @if($block->type === "paragraph")
                                    @include("components.blocks.paragraph", ['text' => $block->data->text])
                                @elseif($block->type === "header")
                                    @include("components.blocks.header",
                                        ['text' => $block->data->text],
                                        ['level' => $block->data->level])
                                @elseif($block->type === "image")
                                    @include("components.blocks.image", ['nameImg' => $block->data->file->url])
                                @elseif($block->type === "list")
                                    @include("components.blocks.list", [''])
                                @elseif($block->type === "quote")
                                    @include("components.blocks.quote", [
                                        'text' => $block->data->text,
                                        'caption' => $block->data->caption])
                                @elseif($block->type === "embed")
                                    @include("components.blocks.embed", [
                                        'id' => $block->data->embed])
                                @elseif($block->type === "table")
                                    @include("components.blocks.table", [''])
                                @elseif($block->type === "delimiter")
                                    @include("components.blocks.delimiter", [''])
                                @endif
                            @endforeach
                        </section>
                    </article>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-5 lg:col-span-2 ">
        @include('components.matchesIndex.articlesBlock')
    </div>
</div>
@endsection
<style lang="scss">
    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid #dcdee2;
    }
    ul.article-block-item,
    ol.article-block-item {
        list-style-position: outside;
        padding: 0 0 1rem 2rem;
        font-size: 90%;
    }

    ul.article-block-item li {
        list-style-image: none;
        list-style-type: circle;
    }

    ol.article-block-item li {
        list-style-type: decimal;
    }
    table {
        margin-bottom: 1rem;
        font-size: 0.7rem;
        border: 1px solid #dee2e6;
    }

    .table-bordered td, .table-bordered th {
        border: 1px solid #212d37; /* dark mode */
    }

    .warn-block p {
        font-size: 12px;
        padding: 0;
        margin: 0;
    }
    a.external-post {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding: 1rem 1rem 0;
        margin: 2rem 0 1rem;
        border-top: 1px dashed #b8c4d2;
        color: #344452;
        -webkit-transition: 0.3s linear;
        -o-transition: 0.3s linear;
        transition: 0.3s linear;
        text-decoration: none;

        & picture {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 170px;
            flex: 0 0 170px;
            margin-right: 0;
            overflow: hidden;
            width: 170px;
            position: relative;
            top: -19px;
            left: -18px;


            img {
                width: 100%;
                max-width: 100%;
            }
        }

        & picture:after {
            content: "";
            display: block;
            height: 105%;
            width: 49px;
            position: absolute;
            top: 0;
            right: -25px;
            -webkit-transform: skew(-25deg, 0);
            -ms-transform: skew(-25deg, 0);
            transform: skew(-25deg, 0);
        }

        .exp-title {
            font: 700 0.9rem/1rem Roboto, Arial, sans-serif;
        }

        .exp-subtitle {
            padding-top: 10px;
            font-size: 0.75rem;
            color: #30404f;
        }
    }

/*body.dark-mode*/
    a.external-post {
        border-top: 1px dashed #353b41;
        color: #7eadc2;

        & picture:after {
            background: #212D3D;
        }

        div.exp-subtitle {
            color: #737a7e;
        }
    }

    .articleBody, .article-content {
        color: #dcdee2;
    }

    .articleBody p {
        margin-bottom: 2rem;
        font-size: 1rem;
        line-height: 1.5rem;
    }

    .articleBody h1 {
        font-size: 1.4rem;
        line-height: 2rem;
        color: #fff;
        margin-bottom: 1rem;
        margin-top: 2rem;
    }
    .articleBody h2 {
        font-size: 1.2rem;
        line-height: 1.8rem;
        color: #fff;
        margin-bottom: 1rem;
        margin-top: 2rem;
        text-transform: uppercase;
        font-weight: 800;
    }
    .articleBody h3 {
        font-size: 1.1rem;
        line-height: 1.6rem;
        color: #fff;
        margin-bottom: 1rem;
        margin-top: 2rem;
        text-transform: uppercase;
        font-weight: 800;
    }
    .articleBody h4 {
        font-size: 1rem;
        line-height: 1rem;
        color: #fff;
        margin-bottom: 1rem;
        margin-top: 2rem;
        text-transform: uppercase;
        font-weight: 800;
    }
     .articleBody p a,
     .articleBody li a {
         /* color: rgb(168 164 235); */
         border-bottom: 1px dotted;
         color: inherit;
     }
    .articleBody p a:hover,
    .articleBody li a:hover {
        color: rgb(152, 148, 219);
        border-bottom: none
    }
    .source a {
        color: rgb(168 164 235);
    }
    .source a:hover {
        color: rgb(152, 148, 219);
    }
    .blockquote {
        font-size: 0.8rem;
        line-height: 0.8rem;
        padding: 0 0 0 1rem;
        margin: 1rem 0;
        border-left: 0.1rem solid #fc7c00;
        position: relative;
    }
    .blockquote p {
        margin-bottom: 0.3rem;
        margin-right: 1rem;
        line-height: 1.2rem;
    }
    .blockquote footer {
        display: block;
        font-size: 80%;
        color: #6c757d;
        text-align: left;
        font-style: inherit;
    }
    .blockquote footer:before {
        content: "\2014\00A0";
    }

    .embed-responsive {
        position: relative;
        display: block;
        width: 100%;
        padding: 0;
        overflow: hidden;
        margin: 1rem auto;
    }
    .embed-responsive:before {
        display: block;
        content: "";
    }

    .embed-responsive .embed-responsive-item,
    .embed-responsive embed,
    .embed-responsive iframe,
    .embed-responsive object,
    .embed-responsive video {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    .embed-responsive-21by9:before {
        padding-top: 42.85714%;
    }

    .embed-responsive-16by9:before {
        padding-top: 56.25%;
    }

    .embed-responsive-4by3:before {
        padding-top: 75%;
    }
    .embed-responsive-1by1:before {
        padding-top: 100%;
    }

    figure {
        margin: 0 0 1rem;
    }
    .source {
        font-size: 0.7rem;
        margin-top: 1rem;
    }

    .source a {
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        max-width: calc(100% - 7rem);
        vertical-align: bottom;
    }

</style>

