
<!DOCTYPE html>
<html>
<?php require_once('header.php') ?>
<head>
	<title></title>

  <script type="text/javascript" src="/yamen/js/jquery.js"></script>


</head>
<style type="text/css">

  .nav {
    background-color: #111111 !important;
  }

  .tabs .indicator { background-color: #000000 !important; }
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
<body>


  <nav class="grey darken-2"> 
    <div class="blue">
      <a href="#!" class="brand-logo"><i class="material-icons"><img src="EyesInTheSkyLogo.png" style="max-height: 60px; padding-left: 40px;"></i></a>
      <ul class="right hide-on-med-and-down" style="padding-right:  40px;">
        <li><a href="logout.php"><i class="material-icons left">live_help</i>Help</a></li>
        <li><a href="logout.php"><i class="material-icons left">settings</i>Settings</a></li>
        <li><a href="logout.php"><i class="material-icons left">perm_identity</i>Log out</a></li>
      </ul>
    </div>
  </nav>



  <div class="row">
    <div class="col s2" >
      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
          <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
        </li>

      </ul>

    </div>
    <div id="test1" class="col s12" style="padding-top: 40px;">
      <table>
        <thead>
          <tr>
            <th data-field="id">Name</th>
            <th data-field="name">Item Name</th>
            <th data-field="price">Item Price</th>
            
            <th data-field="pause">Pause</th>
            <th data-field="Restart">Restart</th>
            <th data-field="shut">Shut down</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>$0.87</td>
            <td>   <a  href="" class="material-icons">pause</a>
              <td> <a  href="" class="material-icons">replay</a>
                <td><a  href="" class="material-icons">power_settings_new</a>
                </td>
              </td>

            </td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>

            <td>   <a  href="" class="material-icons">pause</a>
              <td> <a  href="" class="material-icons">replay</a>
                <td><a  href="" class="material-icons">power_settings_new</a>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
            <td>$7.00</td>

            <td>   <a  href=\"\" class=\"material-icons\">pause</a><td> <a  href=\"\" class=\"material-icons\">replay</a><td><a  href=\"\" class=\"material-icons\">power_settings_new</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div id="test2" class="col s12">Test 2</div>

    <?php require_once('footer.php') ?>
  </body>
  </html>