<?
	session_start();
	include("lib.php");
	
	if(isset($_GET["capcha_new"]))
	{
		capcha_init(1);
		$result[] = array("alert" => "1");
		print json_encode($result);
	}
	else
	{
		if(isset($_SESSION["capcha_img"]))
		{
			header("Content-Type: image/png");
			print($_SESSION["capcha_img"]);
		}
	}
?>