
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
    <link rel="stylesheet" href="../../public/assets/css/materialize.css"  media="screen,projection">
    <title>Login</title>
    <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Alfa+Slab+One|Raleway|Roboto');
    body{
    background-color: #eceff1;
    font-family: 'Raleway', sans-serif;

    }
    i{
    padding-right:15px;
    }
    div.container{
    padding-top:40px; 
    padding-left: 250px;
    }
    img{
    	padding-left:160px;

    }
    label{
color: #039be5;

  }
    .input-field input[type=text]:focus,
    .input-field input[type=password]:focus 
    {
      border-bottom: 2px solid #039be5;
      box-shadow: none;
    }
    
   a{
   	font-family: 'Alfa Slab One', cursive;
   }
   input{
   }
   .with-gap{
   	color: #039be5;

   }
    </style>

    <script type="text/javascript">
      function validateForm()
      {
          var username= document.getElementById("uname").value;
          var password= document.getElementById("psw").value;
          var button1 = document.getElementById("radio1");
          var button2 = document.getElementById("radio2");
          var button3 = document.getElementById("radio3");
          if(username==null || username=="")
          {
            alert ("Insert username");
            return false;
          }
          if(password== null || password == "")
          {
              alert ("Insert password");
              return false;
          }
          else
          {
            return true;
          }
      }
    </script>

</head>

<body>

  <div class="row">
    <div class="col s10"> 
      

       <div class="container" >
        <div class="z-depth-1 white row" style="display:inline-block; padding: 32px 48px 23px 48px; border: 1px solid #EEE;">
              <img src="../../public/assets/img/EyesInTheSkyLogo.png" class="logo" width="70%" />

      
      <form id="myform" action="../controllers/login.php" method="POST" class="col s12">
        <div class="input-field col s12">
          <input type="text" placeholder="Enter Email address" name="email" id="email" required>
          <label for="email" style="color:#039be5;font-size:medium;" ><b>Email</b></label>
        </div>

        <div class="input-field col s12">
        <input type="password"  placeholder="Enter Password" name="password" id="psw" required>
        <label for="password" style="color:#039be5;font-size:medium;"><b>Password</b></label>
        </div>

        <div class="row">
          <input name="btn" class="with-gap"  type="radio" id="user"  value="1" >
          <label for="user" style="color:#607d8b;">User</label>
        </div>
        <div class="row">
          <input name="btn" class="with-gap" type="radio" id="administrator"  value="2">
          <label for="administrator" style="color:#607d8b;">Administrator</label>
        </div>
        <div class="row">
          <input name="btn" class="with-gap" type="radio" id="government"  value="3">
          <label for="government" style="color:#607d8b;">Government</label>
        </div>
        
        <div class="row"  style="padding-left:25px;">
          <a class="col s11 waves-effect light-blue darken-1 btn" style="font-size:large" type="submit" href="#" onclick="document.getElementById('myform').submit()"><i class="material-icons ">lock_open</i>Login</a>
        </div>

        <div class="row">
          <input class="with-gap" name="rememberMe" type="checkbox" id="rememberMe"/>
          <label for="rememberMe" style="color:#607d8b;">Remember Me</label>
        </div>

      </form>
    </div>
  </div>
  </div>
  </div>
  <script type="text/javascript" src="../../public/assets/js/jquery"></script>
  <script type="text/javascript" src="../../public/assets/js/materialize.min.js"></script>
  <script type="text/javascript" src="../../public/assets/scripts.js"></script>

</body>

</html>
