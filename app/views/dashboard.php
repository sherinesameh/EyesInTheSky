<!DOCTYPE html>
<html>
<head>
    <title></title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="../../public/assets/css/materialize.css"  media="screen,projection">
    <style type="text/css">
        .nav {
            background-color: #111111 !important;
        }

        body {
            background-color: #E7E6ED;
        }

        .tabs .indicator {
            background-color: #000000 !important;
        }

        .tabs .tab a.active {
            color: #000000;
        }

        .tabs .tab a:hover {
            color: #000000;
        }

        .tabs .tab a {
            color: #000000;
        }
        #ppp {
          height:20px;
          width:20px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous">
    </script>
  	<script type="text/javascript" src="../../public/assets/js/dependencies/materialize.js"></script>
    <script type="text/javascript" src="../../public/assets/js/handlers/dashboard.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
          getUserInfo();
          getAdminsLog();
          $('ul.tabs').on('click', 'a', function(e) {
              $target = e.target.id;
              if ($target == "t1") {
                getAdminsLog();
              } else if ($target == "t2") {
                getRpSpecs();
              } else {
                getRunningProcesses();
              }
            });
        });
    </script>
</head>
<body>
    <nav class="grey darken-2">
        <div class="blue">
            <a href="#!" class="brand-logo"><i class="material-icons"><img src="../../public/assets/img/EyesInTheSkyLogo.png" style="max-height: 60px; padding-left: 40px;"></i></a>
            <ul class="right hide-on-med-and-down" style="padding-right:  40px;">
                <li><a href="logout.php"><i class="material-icons left">live_help</i>Help</a></li>
                <li><a href="logout.php"><i class="material-icons left">settings</i>Settings</a></li>
                <li><a href="logout.php"><i class="material-icons left">perm_identity</i>Log out</a></li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col l3 well" style="background-color: #ffffff; text-align: center;margin-top:10px;margin-left: 50px;border-style: solid;border-color: #000000 #000000;">
            <div class="well">
              <div id="pp" class="row">
              </div>
              <div id="profile" class="row">

              </div>
            </div>
            <form class="well" id="info">
            </form>
            <div class="well" style="margin-top: 15px;">
                <a class="waves-effect waves-light btn-large" style="margin-bottom: 7px;width: 250px;"><i class="material-icons left">mode_edit</i>Edit Profile</a>
                </br>
                <a class="waves-effect waves-light btn-large" style="margin-bottom: 7px;width: 250px;"><i class="material-icons left">supervisor_account</i>Add new admin</a>
                </br>
                <a class="waves-effect waves-light btn-large" style="margin-bottom: 5px;width: 250px;"><i class="material-icons left">not_interested</i>remove admin</a>
                </br>
            </div>
        </div>
        <div class="col l8" style="margin-top:10px;">
            <div class="col s12">
                <ul class="tabs" class="right" class="grey darken-2">
                    <li class="tab col s3"><a id="t1" href="#adminLog">Admins Log</a></li>
                    <li class="tab col s3"><a id="t2" href="#rpSpecs">Raspberry Pi Specs</a></li>
                    <li class="tab col s5"><a id="t3" href="#activeProcesses">Active Processes</a></li>
                </ul>
            </div>
            <div id="adminLog" class="col s12" style="padding-top: 40px;">
                <table class="striped" class="responsive-table" class="centered">
                    <thead>
                        <tr>
                            <th data-field="admin">Admin</th>
                            <th data-field="action">Action</th>
                            <th data-field="rp">Raspberry Pi</th>
                            <th data-field="img">Image ID</th>
                            <th data-field="img">Action Time</th>
                        </tr>
                    </thead>
                    <tbody id="log">
                    </tbody>
                </table>
            </div>
            <div id="rpSpecs" class="col s12" style="padding-top: 40px;">
                <table class="striped" class="responsive-table" class="centered">
                    <thead>
                        <tr>
                            <th data-field="admin">Mac</th>
                            <th data-field="action">Generation</th>
                            <th data-field="rp">Location</th>
                            <th data-field="img">Temperature</th>
                            <th data-field="img">CPU Usage</th>
                            <th data-field="img">Memory Usage</th>
                        </tr>
                    </thead>
                    <tbody id="specs">
                    </tbody>
                </table>
            </div>
            <div id="activeProcesses" class="col s12" style="padding-top: 40px;">
                <table class="striped" class="responsive-table" class="centered">
                    <thead>
                        <tr>
                            <th data-field="admin">Mac</th>
                            <th data-field="admin">Running Processes</th>
                            <th data-field="pause">Pause</th>
                            <th data-field="Restart">Restart</th>
                            <th data-field="shut">Shut down</th>
                        </tr>
                    </thead>
                    <tbody id="processes">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
