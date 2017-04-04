$(document).ready(function()
{
  $.getScript('assets/js/handlers/dashboard.js', function()
  {
    getUserInfo();
    getAdminsLog();
    getRunningProcesses();
    getRpSpecs();
  });
});
