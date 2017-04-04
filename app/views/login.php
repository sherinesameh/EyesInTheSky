<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mobile Ad-hock cloud.">
    <meta name="author" content="Sherine Sameh">
    <title>Eyes In The Sky</title>

    <link rel="stylesheet" href="assets/css/materialize.css"/>
    <link rel="stylesheet" href="assets/css/font.css"/>
</head>

<body>
    <nav class="blue">
        <div class="navbar-wrapper ">
            <a href="#" class="brand-logo" style="padding-left: 30px;">Eyes In The Sky "Admins"</a>
            <ul class="right" style="padding-right: 20px;">
                <li><a href="#">Policy</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
        </div>
    </nav>
    <div class="row" style="margin-left : 0px;">
        <div class="col l6" style="padding-top: 70px;">
            <div class="card-panel">
                <label style="padding-left: 470px;font-size: 40px;font-weight:bold;">ADMIN LOGIN</label>
                <hr style="height:1px;border:none;color:#039be5;background-color:#039be5;" />
                <hr style="height:5px;border:none;color:#039be5;background-color:#039be5;" />
                <div class="row">
                    <form class="col s12" id="myform" action="../app/controllers/login.php" method="POST">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate" name="email" required>
                                <label for="email" style="color:#039be5;">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate" name="password" required>
                                <label for="password" style="color:#039be5;">Password</label>
                            </div>
                        </div>
                        <div class="row" style="padding-left:25px;">
                            <a class="col s11 waves-effect light-blue darken-1 btn" style="font-size:large" type="submit" href="#" onclick="document.getElementById('myform').submit()"><i class="material-icons ">lock_open</i>Login</a>
                        </div>
                        <div class="row">
                            <div class=" col s6">
                                <input class="with-gap" name="rememberMe" type="checkbox" id="rememberMe" />
                                <label for="rememberMe" style="color:#607d8b;">Remember Me</label>
                            </div>
                            <div class=" col s6">
                                <a href="#" class="with-gap" name="rememberMe" id="rememberMe" style="padding-left: 200px;">Lost password ? </a>
                            </div>
                        </div>
                    </form>
                </div>
                <hr style="height:5px;border:none;color:#039be5;background-color:#039be5;" />
                <hr style="height:1px;border:none;color:#039be5;background-color:#039be5;" />
            </div>
        </div>
        <div class="col l4">
            <img src="assets/img/EyesInTheSkyLogo.png" style="max-height:650px;">
        </div>
    </div>

        <script type="text/javascript" src="assets/js/dependencies/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="assets/js/dependencies/materialize.js"></script>
</body>

</html>
