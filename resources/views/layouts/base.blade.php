<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="/images/logo.ico">
  {{-- Bootstrap --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/sidebars.css">
  {{-- Custom CSS --}}
  <link rel="stylesheet" href="/css/base_layout.css">
  <title>{{$title}}</title>
</head>

<body>
  <div class="konten">
    {{-- Sidebar --}}
    @if (auth()->user()->status === 'Admin')
    @include('layouts.admin_sidebar')
    @else
    @include('layouts.siswa_sidebar')
    @endif
    {{-- Contents --}}
    <div class="container" id="konten">
      @yield('content')
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="/js/sidebars.js"></script>
  <script>
    var winHeight = window.innerHeight;
    document.getElementById('konten').style.minHeight = winHeight.toString() + 'px';
  </script>
</body>

</html>