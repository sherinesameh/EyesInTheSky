
<!DOCTYPE html>
<html>
<?php require_once('header.php') ?>
<head>
	<title></title>

  <style type="text/css">

    div.image{
      width:280px;
      height:250px;
      padding:10px;
      border:5px solid gray;
      margin:0;
    }


  </style>


  <script type="text/javascript">
   $(document).ready(function(){

    $('.modal').modal();


    $('#test3').on('submit','button',function(event){
      var mac = event.target.id;
      var index = document.getElementById(mac);
      if(index.innerHTML == "replay"){



        $.post("RestartPi.php",
        {
         mac : mac 
       },function(data,status){
       });  
          }//lw likerssssss
          else{
            if (index.innerHTML == "pause") {
              $.post("PausePi.php",
              {
               mac : mac 
             },function(data,status){
             });  
            }else{
              $.post("ShutPi.php",
              {
               mac : mac 
             },function(data,status){
             });
            }
          }


        });

  });

</script>
</head>

<body>
  <!-- Modal Trigger -->

  <div id="test3" class="col s12" style="padding-top: 40px;">
    <table class="striped" class="responsive-table" class="centered">

      <tbody id="Proc">

        <tr>

          <div class="row">
            <div class="col 4s">
              <div class="image" style="width: 70px; height: 70px;border:1px solid gray;">
                <img src="">
              </div>
            </div>
            <div class=" col 4s" style="padding-top: 30px;">
              <a href="#">yamen emad abde el hamed</a>
            </div>
            <div class=" col 4s" style="padding-top: 10px;">
              <a class="waves-effect waves-light btn-large" style="margin-bottom: 5px;width:150px;">remove </a>  </div>
            </div>

          </tr>
          <tr>

            <div class="row">
              <div class="col 4s">
                <div class="image" style="width: 70px; height: 70px;border:1px solid gray;">
                  <img src="">
                </div>
              </div>
              <div class=" col 4s" style="padding-top: 30px;">
                <a href="#">yamen emad abde el hamed</a>
              </div>
              <div class=" col 4s" style="padding-top: 10px;">
                <a class="waves-effect waves-light btn-large" style="margin-bottom: 5px;width:150px;">remove </a>  </div>
              </div>

            </tr>
            <tr>

              <div class="row">
                <div class="col 4s">
                  <div class="image" style="width: 70px; height: 70px;border:1px solid gray;">
                    <img src="">
                  </div>
                </div>
                <div class=" col 4s" style="padding-top: 30px;">
                  <a href="#">yamen emad abde el hamed</a>
                </div>
                <div class=" col 4s" style="padding-top: 10px;">
                  <a class="waves-effect waves-light btn-large" style="margin-bottom: 5px;width:150px;">remove </a>  </div>
                </div>

              </tr>


            </tbody>
          </table>
        </div>

     


          <?php require_once('footer.php') ?>
        </body>
        </html>