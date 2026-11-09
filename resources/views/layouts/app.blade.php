
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Fan Hub Plus</title>
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('Main/css/style.css')}}">
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: var(--fanhub-bg-main);">

  <!-- Minimal Sticky Navbar -->
  <nav class="navbar navbar-light navbar-custom">
    <div class="container justify-content-between">
      <a class="navbar-brand" href="{{url('/')}}">
        <i class="bi bi-balloon-heart-fill text-success"></i>
        <span>Fan Hub</span>
      </a>
      <a href="{{url('/')}}" class="btn btn-sm btn-surface">
        <i class="bi bi-arrow-left"></i>  Back to Hub
      </a>
    </div>
  </nav>
  @section('content')
  @show
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('Main/js/main.js')}}"></script>
  <script src="{{asset('Main/js/chatbot.js')}}"></script>
</body>
</html>
