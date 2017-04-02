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
    </style>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous">
    </script>
  	<script type="text/javascript" src="../../public/assets/js/materialize.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $.post("../controllers/getInfo.php", {
                x: 1
            }, function(data, status)
            {
                var info = JSON.parse(data);
                var prof = document.getElementById("profile");
                prof.innerHTML += "<p><span style=\"color : black;text-align:center;font-size : 20px;\">" + info[0].Fname + " " + info[0].Lname + "</strong></p><img src='../../public/assets/img/" + info[0].image +
                    "' class=\"img\" height=\"300\" width=\"230\" alt=\"Avatar\">";
                var x = document.getElementById("info");
                x.innerHTML += "<p style=\"text-align:left;\"><span style = \"color:darkblue; font : bold;\">Email: </span>" + info[0].Email +
                    "</p><p style=\"text-align:left;\"><span style = \"color:darkblue ; font : bold;\">Phone:</br> </span>" + info[0].Phone_num +
                    "</p><p style=\"text-align:left;\"><span style = \"color:darkblue; font : bold;\">Join date:</br></span>" + info[0].Join_Date + "</p>";
            });
            $.post("../controllers/getLog.php", {
                x: 1
            }, function(data, status)
            {
                var info1 = JSON.parse(data);
                var log = document.getElementById("logs");
                log.innerHTML = "";
                for (var i = info1.length - 1; i >= 0; i--) {
                    if (info1[i].Img_id)
                        log.innerHTML += "<tr> <td>" + info1[i].name + "</td> <td>" + info1[i].The_Actions + "</td> <td>" + info1[i].Mac + "</td> <td>" + info1[i].Img_id + "</td> <td>" + info1[i].Action_time + "</td></tr>";
                    else
                        log.innerHTML += "<tr> <td>" + info1[i].name + "</td> <td>" + info1[i].The_Actions + "</td> <td>" + info1[i].Mac + "</td> <td>-------------</td> <td>" + info1[i].Action_time + "</td></tr>";
                };
            });
            $('ul.tabs').on('click', 'a', function(e) {
                $target = e.target.id;
                if ($target == "t1") {
                    $.post("../controllers/getLog.php", {
                        x: 1
                    }, function(data, status)
                    {
                        var info1 = JSON.parse(data);
                        var log = document.getElementById("logs");
                        log.innerHTML = "";
                        for (var i = info1.length - 1; i >= 0; i--)
                        {
                            if (info1[i].Img_id)
                                log.innerHTML += "<tr> <td>" + info1[i].name + "</td> <td>" + info1[i].The_Actions + "</td> <td>" + info1[i].Mac + "</td> <td>" + info1[i].Img_id + "</td> <td>" + info1[i].Action_time +
                                "</td></tr>";
                            else
                                log.innerHTML += "<tr> <td>" + info1[i].name + "</td> <td>" + info1[i].The_Actions + "</td> <td>" + info1[i].Mac + "</td> <td>-------------</td> <td>" + info1[i].Action_time + "</td></tr>";
                        };
                    });
                }
                else {
                    if ($target == "t2") {
                        $.post("../controllers/getRp.php", {
                            x: 1
                        }, function(data, status) {
                            var info1 = JSON.parse(data);
                            var Rp = document.getElementById("Rps");
                            Rp.innerHTML = "";
                            for (var i = info1.length - 1; i >= 0; i--)
                            {
                                Rp.innerHTML += "<tr> <td>" + info1[i].Mac + "</td> <td>" + info1[i].Generation + "</td> <td><a target=\"_blank\" href=\"" + info1[i].Location + "\">see location </a></td> <td>" + info1[i].Temperature +
                                    " &deg;C</td> <td>" + info1[i].CpuUsage + " %</td> <td>" + info1[i].FreeStorage + " MB</td></tr>";
                            };
                        });
                    }
                    else {
                        $.post("../controllers/getProcs.php", {
                            x: 1
                        }, function(data, status) {
                            var info1 = JSON.parse(data);
                            var Proc = document.getElementById("Proc");
                            Proc.innerHTML = "";
                            for (var i = info1.length - 1; i >= 0; i--)
                            {
                                Proc.innerHTML += "<tr> <td>" + info1[i].Mac + "</td> <td>" + info1[i].procs + "</td> <td>   <a  href=\"\" id = \"" + info1[i].Mac +
                                    "\"class=\"material-icons\">pause</a><td> <a  href=\"\" id = \"" + info1[i].Mac + "\"class=\"material-icons\">replay</a><td><a  href=\"\" id = \"" + info1[i].Mac +
                                    "\"class=\"material-icons\">power_settings_new</a></td></tr>";
                            };
                        });
                    }
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
            <div class="well" id="profile">
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
                    <li class="tab col s3"><a id="t1" href="#test1">Admins Log</a></li>
                    <li class="tab col s3"><a id="t2" href="#test2">Raspberry Pi Stat</a></li>
                    <li class="tab col s5"><a id="t3" href="#test3">Raspberry Pi Process</a></li>
                </ul>
            </div>
            <div id="test1" class="col s12" style="padding-top: 40px;">
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
                    <tbody id="logs">
                    </tbody>
                </table>
            </div>
            <div id="test2" class="col s12" style="padding-top: 40px;">
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
                    <tbody id="Rps">
                    </tbody>
                </table>
            </div>
            <div id="test3" class="col s12" style="padding-top: 40px;">
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
                    <tbody id="Proc">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
