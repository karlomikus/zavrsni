<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project Zavrsni v0.1</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.js"></script>
    <script src="https://code.angularjs.org/1.3.2/angular-route.js"></script>
    <script src="js/vendor/angular.loading.min.js"></script>
    <script src="js/services.js"></script>
    <script src="js/controllers.js"></script>
    <script src="js/directives.js"></script>
    <script src="js/routes.js"></script>
    <script src="js/app.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container" ng-controller="authController">
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
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li ng-if="loggedIn == false"><a href="/signup">Sign up</a></li>
                </ul>
                <form ng-if="loggedIn == false" ng-submit="login()" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input ng-model="loginData.email" name="email" type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input ng-model="loginData.password" name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
                <ul ng-if="loggedIn == true" class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">Karlo Mikus <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/profile">Profile</a></li>
                            <li><a href="/admin" target="_blank">Administration</a></li>
                            <li class="divider"></li>
                            <li><a href="#" click="logout()">Logout</a></li>
                        </ul>
                    </li>
                    <li><a href="/new">Post new job</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div id="content" class="container" ng-view></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>