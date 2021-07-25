<html>
<head>
    <title>@yield('title')</title>
</head>
<body>

<header>
    @include('master.partials.header')
</header>
<div class="container">
    <aside>
        @include('master.partials.sidebar')
    </aside>
    @yield('content')
</div>

<footer>
    @include('master.partials.footer')
</footer>
</body>
</html>
