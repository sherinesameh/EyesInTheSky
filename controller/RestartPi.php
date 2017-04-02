<?php

session_start();
$flag = $_POST['flag'];
if($flag == "search")
$_SESSION['search'] = $_POST['search'];
elseif ($flag == 'profile') {
	$_SESSION['profile'] = $_POST['profile'];
}
if($flag == 'Likers')
{
	$_SESSION['poster_id'] = $_POST['id'];
	$_SESSION['post_time'] = $_POST['time'];
}
