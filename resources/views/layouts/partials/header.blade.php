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
            <ul class="nav navbar-nav navbar-right">
            </ul>
        </div>
    </nav>
</header>