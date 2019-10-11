<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>
            @hasSection('title')
                @lang('main.name') - @yield('title')
            @else
                @lang('main.name')
            @endif
        </title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <span class="navbar-brand" href="#">@lang('main.name')</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('index')}}">@lang('main.nav.home')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('domains.index')}}">@lang('main.nav.list')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/Dvengroff/php-project-lvl3">@lang('main.nav.source')</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            @yield('page_content')
        </main>
        <footer>
        </footer>
        <script type="text/javascript" src="./js/bundle.js"></script>
    </body>
</html>