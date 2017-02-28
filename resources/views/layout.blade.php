<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Asistencia</title>
        <link rel="stylesheet" type="text/css" href="css/app.css">
        @yield('styles')

        <script>
            window.App = {
                csrfToken: "{{ csrf_token() }}"
            }
        </script>
    </head>
    <body>
    <div id="app">
        <div class="container">
            <header>
                <nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#">Colegio</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}">Asistencia</a></li>
                        <li><a href="{{ url('registro') }}">Registro de Personal</a></li>
                        <li><a href="{{ url('reporte') }}">Reportes</a></li>
                      </ul>
                    </div>
                  </div>
                </nav>
            </header>
        </div>
        @yield('content')
    </div>
    <script type="text/javascript" src="/js/app.js"></script>
    @yield('scripts')
    </body>
</html>
