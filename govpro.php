<html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/materialize.css"  media="screen,projection">
<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Michroma');


	body{
	background-color:#e0e0e0;
	font-family: 'Michroma', sans-serif;

	}

	div.section{
	color:black;
	}

	input{
	border:1px solid black !important;
	padding:0 30px 0 50px !important;
	display:inline;



		}


    input[type=text]:focus {
     box-shadow: 0 0px 0 0 black !important;

 		}
 	div.form{
 	width:350px;
    padding: 20px;
    margin-left:30px;
		}

</style>
</head>
<body>
	<img src="../../public/assets/img/govlogo.png" width="900" height="500" style="padding-left:300px;position:initial;" />


  <div style="margin-left:50px">
  <div class="divider"></div>
  <div class="section">
    <h5>Name</h5>
    <p>Stuff</p>
  </div>
  <div class="divider"></div>
  <div class="section">
    <h5>Email</h5>
    <p>Stuff</p>
  </div>
  <div class="divider"></div>
  <div class="section">
    <h5>Authority</h5>
    <p>Stuff</p>
  </div>
  </div>
  </div>

  	<a class="waves-effect waves-light btn red accent-4 btn-large" style="margin-left:50px;padding:0 80px 0 75px;font-size:20px;"><i class="material-icons left" style="font-size:30px;">mode_edit</i>Edit Profile</a>
  	<br>

  	<div class="form">

  	<form action="govpro.php" method="post">
  	<div>
  	<input  type="text" name="user">
  	</div>

  	<div  >
  	<button type="submit" name="action" class="waves-effect waves-light btn red accent-4 btn-large" style="margin:-67px 0 0 395px;width:410px;height:45px;font-size:20px; text-align: center;"><i class="material-icons right">send</i style="font-size:15px">Change Authority</button>
  	</div>

  	</div>

  	</form>


</body>
</html>
