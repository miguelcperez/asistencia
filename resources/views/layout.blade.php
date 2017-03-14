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
                        @if (Auth::guest())
                            <li><a href="{{ url('/') }}">Asistencia</a></li>
                            <li><a href="{{ url('registro') }}">Registro de Personal</a></li>
                            <li><a href="{{ url('reporte') }}">Reportes</a></li>
                        @else
                            <li><a href="{{ url('/') }}">Asistencia</a></li>
                            <li><a href="{{ url('registro') }}">Registro de Personal</a></li>
                            <li><a href="{{ url('reporte') }}">Reportes</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
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
    <footer class="footer no-print">
        <p>Place sticky footer content here.</p>
    </footer>
</html>
