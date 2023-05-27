<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todos</title>
  @vite('resources/css/app.css')
  <style>
    .content {
      display: none;
    }
  </style>
</head>
<body class="bg-[#F1F1F1] flex flex-col items-center">
    @yield('content')
</body>
</html>