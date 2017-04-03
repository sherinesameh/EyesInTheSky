$(document).ready(function()
{
  $.getScript('../../public/assets/js/handlers/dashboard.js', function() {
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
});
