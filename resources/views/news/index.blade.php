<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Uudised</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Styles -->
        <style>
            * {
                box-sizing: border-box;
            }

            html,
            body {
                background-color: #e8e8e8;
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0 auto;
                line-height: 1.3;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 2.5em;
                margin-top: 5px;
                margin-bottom: 5px;
            }

            a {
                font-family: 'Raleway', sans-serif;
                color: #636b6f;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            ul,
            li {
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .news {
                display: flex;
                flex-wrap: wrap;
            }

            .news-item {
                display: flex;
                padding: 0.5em;
                width: 100%;
                padding: 0.5em;
                transition: 300ms all ease-in-out;
            }

            @media all and (min-width: 40em) {
                .news-item {
                    width: 50%;
                }
            }

            @media all and (min-width: 60em) {
                .news-item {
                    width: 33.33%;
                }
            }

            .news-content {
                display: flex;
                flex-direction: column;
                padding: 1em;
                width: 100%;
                background-color: #fff;
            }

            .news-content p {
                flex: 1 0 auto;
            }

        </style>
    </head>
    <body>
        <h2 class="content title">Uudised</h2>
        <div class="pagination" data-next-page="1">
            <ul class="news">
                @foreach($news as $val)
                <li class="news-item">
                    <div class="news-content">
                        <p><a href="{{ $val->link }}" target="_blank">{{ $val->title}}</a></p>
                        <p>{{ $val->description }}</p>
                        <p>{{ $val->pubDate }}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <script>
            $(document).ready(function () {
                page = 2;
                $.each($('div'), function (index, item) {
                    $(item).attr('data-news', index);
                });
                $(window).scroll(function () {
                    if (page != null) {
                        clearTimeout($.data(this, "scrollCheck"));
                        $.data(this, "scrollCheck", setTimeout(function () {
                            if (($(window).height() + $(window).scrollTop() + 100) >= $(document).height()) {
                                $.ajax({
                                    url: "?page=" + page,
                                    method: "GET",
                                    data: {
                                        page: page
                                    },
                                    dataType: 'json',
                                    success: function (data) {
                                        page++;
                                        // $.each($('li'), function (index, item) {
                                        //     $(item).attr('data-news', index);
                                        // });
                                        if (data.news != "") {
                                            $('.news').append(data.news);
                                        } else {
                                            return;
                                        }
                                        
                                        
                                    }
                                });
                            }
                        }, 350))
                    }
                });
            });
        </script>
    </body>
</html>
