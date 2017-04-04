
function getUserInfo() {
  $.post(
    '../app/controllers/dashboard.php',
    {request: 'getUserInfo'},
    function(result, status)
    {
      if (status == 'success') {
        var data = JSON.parse(result);
        $("#pp").html('<img id="ppp" src="assets/img/'+data[0].image + '">');
        $('#profile').html(data[0].Fname)
      }
      else {
        alert("error");
      }
    });
}

function getAdminsLog() {
  $.post(
    '../app/controllers/dashboard.php',
    {request: 'getAdminsLog'},
    function(result, status)
    {
      if (status == 'success') {
        var data = JSON.parse(result);
        $("#log").html("");
        for(var i = data.length-1; i >= 0; i--) {
          if (!data[i].Img_id) {
              data[i].Img_id = "_____";
          }
          $("#log").append("<tr> <td>" + data[i].name + "</td> <td>" + data[i].The_Actions + "</td> <td>" + data[i].Mac + "</td> <td>" + data[i].Img_id + "</td> <td>" + data[i].Action_time + "</td></tr>");
        }
      }
      else {
        alert("error");
      }
    });
}

function getRpSpecs()
{
  $.post(
    '../app/controllers/dashboard.php',
    {request: 'getRpSpecs'},
    function(result, status)
    {
      if (status == 'success') {
        var data = JSON.parse(result);
        $("#specs").html("");
        for(var i = data.length-1; i >= 0; i--) {
          if (!data[i].Img_id) {
              data[i].Img_id = "_______";
          }
          $("#specs").append("<tr> <td>" + data[i].Mac + "</td> <td>" + data[i].Generation + "</td> <td><a target=\"_blank\" href=\"" + data[i].Location + "\">see location </a></td> <td>" + data[i].Temperature + " &deg;C</td> <td>" + data[i].CpuUsage + " %</td> <td>" + data[i].FreeStorage + " MB</td></tr>");
        }
      }
      else {
        alert("error");
      }
    });
}

function getRunningProcesses()
{
  $.post(
    '../app/controllers/dashboard.php',
    {request: 'getRunningProcesses'},
    function(result, status)
    {
      if (status == 'success') {
        var data = JSON.parse(result);
        $("#processes").html("");
        for(var i = data.length-1; i >= 0; i--) {
          if (!data[i].Img_id) {
              data[i].Img_id = "_____";
          }
          $("#processes").append("<tr> <td>" + data[i].Mac + "</td> <td>" + data[i].procs + "</td> <td>   <a  href=\"\" id = \"" + data[i].Mac + "\"class=\"material-icons\">pause</a><td> <a  href=\"\" id = \"" + data[i].Mac + "\"class=\"material-icons\">replay</a><td><a  href=\"\" id = \"" + data[i].Mac + "\"class=\"material-icons\">power_settings_new</a></td></tr>");
        }
      }
      else {
        alert("error");
      }
    });
}
