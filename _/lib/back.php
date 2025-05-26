<?
define("ADM", "1"); 
include($_SERVER['DOCUMENT_ROOT']."/config.php");


if(isset($_SERVER["HTTP_REFERER"]))	
{
	Header("Location: ".$_SERVER["HTTP_REFERER"]);	
	exit();
}
else 
{
	Header("Location: /");
	exit();
}
?>