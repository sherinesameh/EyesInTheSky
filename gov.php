<html>
<?php require_once('header.php') ?>

<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="public/assets/css/materialize.css"  media="screen,projection">

  <title>Government</title>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="public/assets/js/materialize.min.js"></script>
<script type="text/javascript" src="/Gov/js/init.js"></script>
<script type="text/javascript" src="/Gov/js/scripts.js"></script>




  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Cinzel|Racing+Sans+One');
    body{
      background-color: #eeeeee ;
      font-family: 'Cinzel', serif;
    }
    div.card{
      width:350px;
      height:450px;

    }
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){background-color: #e0e0e0 }

    th {
      background-color: #c62828;
      color: black;
    }


    input[type=text]:focus {
     border-bottom: 1px solid #e53935 !important;
     box-shadow: 0 1px 0 0 black;
   }
   a{
    color: black;
  }

  div.image{
    width:100px;
    height:130px;
    padding:10px;
    border:1px solid black;
    margin:0;
  }



</style>



</head>
<body>
 <nav>

   <div class="nav-wrapper red darken-3">


    <h5 class="brand-logo center">Government website</h5>

    <form>
      <div class="input-field">
        <input id="search" type="search">

        <label class="label-icon" for="search"><i class="material-icons " style="color: white;font-size:50px;padding-left:380px;">search</i></label>
        <i class="material-icons">close</i>
      </div>
    </form>
  </div>
</nav>

<div class="row" style="padding-top:70px">
  <div class="col s6" style="padding-left:70px">
    <div class="card">

      <div class="card-image">
        <img src="images/criminal1.png">
        <span class="card-title" style="color:#c62828">Add criminal</span>
        <div class="row">
         <a class="btn-floating halfway-fab waves-effect waves-light  red btn-large "  type="submit" href="#registration"><i class="material-icons red darken-3">add</i></a>

       </div>
     </div>


     <div class="card-content ">
      <input type="text" name="name">
    </div>

  </div>
</div>


<div class="col s6 " style="padding-left:200px" >
  <div class="card">

    <div class="card-image">
      <img src="images/govern.png">
      <span class="card-title" style="color:#c62828">Add/Remove government</span>
      <div class="row">
       <a class="btn-floating halfway-fab waves-effect waves-light  red btn-large " id = "delete" type="click" href="#governments"><i class="material-icons red darken-3">delete</i></a>
       <a class="btn-floating halfway-fab waves-effect waves-light  red btn-large left"  type="submit" href="#registration"><i class="material-icons red darken-3">add</i></a>

     </div>

   </div>

 </div>
</div>

<!--  start of registration modal  -->

<div id="registration" class="modal modal-close" style="color:#2081A0">
  <div class="modal-content">
    <form id="regForm" action = "" method="POST">
    <h1 style="color:#2081A0">Registration</h1>
    <hr>

    <div class="row">
      <div class="col s6">
        <i class="material-icons prefix">perm_identity</i>
        <div class="input-field inline">
          <input id="firstname" type="text" name="firstname" required="required">
          <label for="firstname">First Name</label>
        </div>
      </div>

      <div class="col s6">
        <i class="material-icons prefix">perm_identity</i>
        <div class="input-field inline">
          <input id="lastname" type="text" name="lastname" required="required">
          <label for="lastname">Last Name</label>
        </div>
      </div>
    </div>

    <div class="row">

      <div class="col s6">
        <i class="material-icons prefix">perm_identity</i>
        <div class="input-field inline">
          <input id="username" type="text" name="username" required="required">
          <label for="username">User Name</label>
        </div>
      </div>

      <div class="file-field input-field col s6">
        <div class="uploadButton">
          <span>Upload Your Image</span>
          <input type="file">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
     </div>

      <div class="row">
        <div class="col s6">
        <i class="material-icons prefix">lock</i>
        <div class="input-field inline">
          <input id="password" type="password" name="password" required="required">
          <label for="password">Password</label>
        </div>
      </div>

        <div class="col s6">
          <i class="material-icons prefix">email</i>
          <div class="input-field inline">
          <input id="email" type="email" name="email" required="required" class="validate">
          <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
      </div>

    <hr>
    <div class="col s5">
       <p>By clicking Register, you agree on our <a href="#">terms and condition</a>.</p>
    </div>
    <div class="col s2 offset-s5">
       <input type="submit" value="Register" class="button" id="registerButton">
    </div>
    </form>

  </div>
</div>
<!--  end of registration modal  -->


<table>
 <tr>
   <th><i class="large material-icons" style="font-size:x-large;">supervisor_account</i>   Government_Username</th>
   <th><i class="large material-icons" style="font-size:x-large;">perm_identity</i>   Criminal_Username</th>
   <th><i class="large material-icons" style="font-size:x-large;">info</i>   Action</th>
   <th><i class="large material-icons" style="font-size:x-large;">schedule</i>   Time</th>
 </tr>
 <tr>
   <td><a href="#modal1">Peter</a></td>
   <td><a href="">Griffin</a></td>
   <td></td>
   <td></td>
 </tr>
 <tr>
   <td>Lois</td>
   <td>Griffin</td>
   <td></td>
 </tr>


</table>

<footer class="page-footer" style="background-color:#b71c1c!important">
  <div class="container" >
    <div class="row">

      <div class="col l6" >
        <h5 class="white-text">Billing Policy</h5>
        <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
      </div>

    </div>
  </div>
  <div class="footer-copyright">
    <div class="container" >
      © 2017 Copyright Text
    </div>
  </div>
</footer>


<div id="governments" class="modal modal-close">
  <div class="modal-content">
    <div id="test3" class="col s12" style="padding-top: 40px;">
    <table class="striped" class="responsive-table" class="centered">

      <tbody id="govTable">


            </tbody>
          </table>
        </div>

  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Exit</a>
  </div>
</div>







  <script>
    $(document).ready(function()
    {

      $('.modal').modal();

  $("#regForm").submit(function(){
         var fname = document.getElementById("firstname").value;
         var lname = document.getElementById("lastname").value;
         var email = document.getElementById("email").value;
         var password = document.getElementById("password").value;
         var username = document.getElementById("username").value;


         $.post("Controllers/requests.php",
         {
          request : "register",
          firstname : fname ,
          lastname : lname ,
          email : email ,
          password : password ,
          username : username
        },function(data,status){
          alert(data);
        });

    });


  $("#delete").click(function(){
         $.post("Controllers/requests.php",
        {
          request: 'getGovs'
        },function(data,status){
          var info1 = JSON.parse(data);
          var Proc = document.getElementById("govTable");
          Proc.innerHTML ="";
          for (var i = info1.length - 1; i >= 0; i--) {
            Proc.innerHTML += "<tr> <div class=\"row\"> <div class=\"col 4s\"> <div class=\"image\" style=\"width: 70px; height: 70px;border:1px solid gray;\"> <img src=\"images/"+info1[i].images+"\"> </div> </div> <div class=\" col 4s\" style=\" padding-top: 30px;\"> <a href=\"\">"+info1[i].Fname+" "+info1[i].Lname+" ( "+info1[i].Gov_username+" ) </a>  </div> <div class=\" col 4s\" style=\"padding-top: 10px;\"> <a class=\"waves-effect waves-light btn-large\" id = \""+info1[i].Gov_id+ "\"style=\"margin-bottom: 5px;width:150px;\">remove </a>  </div> </div> </tr>";

          };

        });

    });


    });

  </script>
<?php require_once('footer.php') ?>

</body>

</html>
