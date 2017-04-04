<?php
  include_once '../app/controllers/routing.php';
  $url = new Routing('/Administration/public/');
  if(!$url->segment(1))
    $page = 'home';
  else
    $page = $url->segment(1);
  switch($page) {
      case 'home':
        $url->loadPage('login');
        break;
      case 'dashboard':
        $url->loadPage('dashboard');
        break;
      default:
        $url->loadPage('404');
        break;
  }

?>
