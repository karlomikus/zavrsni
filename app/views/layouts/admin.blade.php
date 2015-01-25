<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jobbr Administracija</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/main.css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <header class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin">Jobbr Administracija</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/admin/projects" class="dropdown-toggle">{{{ $currentUser->first_name }}} {{{ $currentUser->last_name }}} (Administrator)</a>
                    </li>
                    <li>
                        <a href="/"><i class="glyphicon glyphicon-eye-open"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicon glyphicon-log-out"></i></a>
                    </li>
                </ul>
            </div>
        </header>
        <nav id="sidebar">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/admin">Kontrolni panel</a></li>
                <li><a href="/admin/projects">Projekti</a></li>
                <li><a href="/admin/categories">Kategorije</a></li>
                <li><a href="/admin/users">Korisnici</a></li>
                <li><a href="/admin/settings">Postavke</a></li>
            </ul>
        </nav>
        <section id="content">
            <div class="container-fluid">
                <div class="page-header">
                    @yield('pageHeader')
                </div>
                @yield('content')
            </div>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="/assets/js/chartjs.min.js"></script>
        <script src="/assets/js/admin.js"></script>
    </body>
</html>