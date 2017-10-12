<header role="navigation" class="navbar navbar-inverse navbar-fixed-top" style="min-width: max-content">
    <nav class="container">
        <div class="navbar-header">
            {{-- Collapsed Hamburger --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{-- Branding Image --}}
            <a class="navbar-brand" href="{{ route('index') }}">
                <span class="fa fa-home"></span> Главная
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            {{-- Left Side Of Navbar --}}
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('students.register') }}">
                        <span class="fa fa-pencil"></span> Регистрация
                    </a>
                </li>
            </ul>

            {{-- Right Side Of Navbar --}}
            <form class="navbar-form navbar-right" method="get" action="{{ route('students.search') }}">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Поиск">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Найти!</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </nav>
</header>