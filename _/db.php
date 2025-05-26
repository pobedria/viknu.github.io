<?
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	session_start();
	$db = @mysqli_connect("localhost", "root", ""); //dnb80935887151
	if (!$db) 
		die('Try again later.');
	mysqli_query($db, "SET NAMES utf8");
	mysqli_select_db("dut", $db);
	
	define("SITE_DOMAIN", "dut.edu.ua"); // for errors - without HTTP://
	
?>
