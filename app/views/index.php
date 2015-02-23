<!DOCTYPE html>
<html lang="en" ng-app="myApp">
    <head>
        <base href="/">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Jobbr &dash; Završni rad (Karlo Mikuš)</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/main.css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body ng-controller="MainController">
        <nav class="navbar navbar-jobbr navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Jobbr</a>
                </div>
                <div class="collapse navbar-collapse" id="nav-collapse">
                    <ul class="nav navbar-nav">
                        <li ng-if="!isLoggedIn()"><a href="/register">Registracija</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" ng-show="!isLoggedIn()" ng-submit="login(loginData)">
                        <div class="form-group">
                            <input ng-model="loginData.email" name="email" type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input ng-model="loginData.password" name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Prijava</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right" ng-show="isLoggedIn()">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ currentUser.fullName }} <span class="badge">2</span> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/profile">Profil</a></li>
                                <li><a href="/myprojects">Moji projekti <span class="badge">2</span></a></li>
                                <li ng-show="currentUser.admin"><a href="/admin" target="_blank">Administracija</a></li>
                                <li class="divider"></li>
                                <li><a href="#" ng-click="logout()">Odjava</a></li>
                            </ul>
                        </li>
                        <li><a href="/new">Novi posao</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="content" class="container" ng-view></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.4/angular.js"></script>
        <script src="//code.angularjs.org/1.3.4/angular-route.js"></script>
        <script src="//code.angularjs.org/1.3.4/angular-resource.js"></script>
        <script src="js/vendor/angular.loading.min.js"></script>
        <script src="js/vendor/angular.scroll.min.js"></script>
        <script src="js/vendor/noty.min.js"></script>
        <script src="js/vendor/bootstrap.datepicker.js"></script>
        <script src="js/vendor/locales/bootstrap-datepicker.hr.js"></script>
        <script src="js/services.js"></script>
        <script src="js/controllers.js"></script>
        <script src="js/directives.js"></script>
        <script src="js/routes.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>