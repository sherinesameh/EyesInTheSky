
<!DOCTYPE html>
<html>

<head>

<script type="text/javascript" src="/Gov/js/jquery.js"></script>
<script type="text/javascript">
   $(document).ready(function(){



$.post("Controllers/getLog.php",
    {
      x: 1
    },function(data,status){
      var info1 = JSON.parse(data);
      var log = document.getElementById("logs");
      log.innerHTML ="";
      for (var i = info1.length - 1; i >= 0; i--) {
        
          log.innerHTML += "<tr> <td>"+info1[i].name+"</td> <td>"+info1[i].Action+"</td> <td>"+info1[i].Start_time+"</td> <td>"+info1[i].Crim_id+"</td> <td>";
          
      };
    });



$('ul.tabs').on('click', 'a', function(e) {
      $target = e.target.id;

      if ($target == "t1") {
       $.post("Controllers/getLog.php",
       {
        x: 1
      },function(data,status){
        var info1 = JSON.parse(data);
        var log = document.getElementById("logs");
        log.innerHTML ="";
        for (var i = info1.length - 1; i >= 0; i--) {
         
             log.innerHTML += "<tr> <td>"+info1[i].name+"</td> <td>"+info1[i].Action+"</td> <td>"+info1[i].Start_time+"</td> <td>"+info1[i].Crim_id+"</td> <td>";
        };
      });
</script>



<div class="col s12" >
    <ul class="tabs" class="right" class="grey darken-2">
      <li   class="tab col s3"><a id = "t1" href="#test1">Government Log</a></li>
    </ul>
</div>





<div id="test1" class="col s12" style="padding-top: 40px;">
    <table class="striped" class="responsive-table" class="centered">
      <thead>
        <tr>
          <th data-field="name">name</th>
          <th data-field="action">Action</th>
          <th data-field="rp">Start time</th>
          <th data-field="img">Criminal id</th>
          <th data-field="img">Action Time</th>
        </tr>
      </thead>

      <tbody id="logs">

      </tbody>
    </table>
  </div>