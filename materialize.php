<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <link rel="stylesheet" href="public/assets/css/materialize.css"  media="screen,projection">
	<title>Login</title>
<style>
    label{
    color:#039be5;
    }
    </style>
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
   <div class="card-panel" >
          <label  style="padding-left: 470px;font-size: 40px;font-weight:bold;">
              ADMIN LOGIN

             </label>
       <hr style="height:1px;border:none;color:#039be5;background-color:#039be5;" />
        <hr style="height:5px;border:none;color:#039be5;background-color:#039be5;" />

  <div class="row" >
    <form class="col s12" id="myform" action="controller/login.php" method="POST">

            <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate" name="email"  required>
          <label for="email" style="color:#039be5;">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" class="validate" name="password"  required>
          <label for="password" style="color:#039be5;">Password</label>
        </div>
      </div>


        <div class="row"  style="padding-left:25px;">
          <a class="col s11 waves-effect light-blue darken-1 btn" style="font-size:large" type="submit" href="#" onclick="document.getElementById('myform').submit()"><i class="material-icons ">lock_open</i>Login</a>
        </div>
         <div class="row">
             <div class=" col s6">
          <input class="with-gap" name="rememberMe" type="checkbox" id="rememberMe"/>
          <label for="rememberMe" style="color:#607d8b;">Remember Me</label>
                 </div>

        <div class=" col s6">
            <a href="#" class="with-gap" name="rememberMe"  id="rememberMe" style="padding-left: 200px;">Lost password ? </a>

                 </div>
        </div>

    </form>
  </div>

        <hr style="height:5px;border:none;color:#039be5;background-color:#039be5;" />

        <hr style="height:1px;border:none;color:#039be5;background-color:#039be5;" />

            </div>

         </div>
        <div class="col l4">

             <img src="EyesInTheSkyLogo.png" style="max-height:650px;">




        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
			integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	 		crossorigin="anonymous">
		</script>
  <script type="text/javascript" src="public/assets/js/materialize.js"></script>
  <!-- <script type="text/javascript" src="public/assets/scripts.js"></script> -->
</body>
</html>
