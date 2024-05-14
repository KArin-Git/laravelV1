<!DOCTYPE html>
<html>

<head>
    <title>Laravel 10 Task List App</title>
    {{-- styles is in create.blade.php --}}
    @yield('styles')
</head>

<body>
    <h1>
        @yield('title', 'Laravel 10 Task List App')
    </h1>
    <div>
        @if (session()->has('success'))
            <div>{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>

</html>
