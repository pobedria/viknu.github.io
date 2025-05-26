<?
//define("AJAX", "1"); 
	include($_SERVER['DOCUMENT_ROOT']."/config.php");
	
	$text	= ""; 		if(isset($_GET["text"]))	$text = safe_str($_GET["text"]);	 
	$post_text	= ""; 	if(isset($_POST["text"]))	$post_text = safe_str($_POST["text"]);	 
	
	
	$allow = 1;
	if(preg_match_all("$[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&//=]*)$", $text.$post_text, $matches)  )
	{  
		foreach($matches AS $match)
		{
			foreach($match AS $mat)
			{
				if(strpos($mat, "ukrtrans") === false) 	
				{
					$allow = 0; 
				} 
			}
		}
	} 
	
	if($allow)
	{
	if(isset($_GET["act"]))
	{ 
		if($_GET["act"] == "appeal_finish")
		{
			if(isset($_POST["name"]))	$name = safe_str($_POST["name"]);		else unset($name);
			$code = ""; if(isset($_POST["code"]))	$code = safe_str($_POST["code"])."";		else unset($code);
			$title = ""; if(isset($_POST["title"]))	$title = safe_str($_POST["title"]).".";		else unset($title);
			$email = ""; if(isset($_POST["email"]))	$email = safe_str($_POST["email"]);		else unset($email);
			if(isset($_POST["phone"]))	$phone = safe_str($_POST["phone"]);		else unset($phone);
			if(isset($_POST["text"]))	$text = safe_str($_POST["text"]);		else unset($text);
			if(isset($_POST["type"]))	$type = safe_str($_POST["type"]);		else unset($type);
			if(isset($_SERVER["HTTP_X_REAL_IP"]))	$ip = safe_str($_SERVER["HTTP_X_REAL_IP"]);	else	$ip = safe_str($_SERVER["REMOTE_ADDR"]);
			
			if(is_auth(1))	
			{
				$name = $_SESSION["name"];
				$phone = $_SESSION["login"];
			}
			
			
			if((mb_strlen($name, "utf-8") >= 2) && ( (mb_strlen($phone, "utf-8") > 3)))
			{
				$ip = ""; if(isset($_SERVER["HTTP_X_REAL_IP"]))	$ip = safe_str($_SERVER["HTTP_X_REAL_IP"]);	else	$ip = safe_str($_SERVER["REMOTE_ADDR"]);
				
				$service_code_sql = "";
				if($type == "callback")		$type_sql = "Обратный звонок";
				if($type == "item")			$type_sql = "Запчасти заказ";
				if($type == "equipment")	$type_sql = "Оборудование";
				if($type == "service")		
				{
					if($code != "")	$service_code_sql = " service_code='".$code."', ";
					$type_sql = "Ремонт";
				}
				
				
				$auth_sql = "";	if(is_auth(1) && ($type == "service"))	$auth_sql = " user_id='".$_SESSION["id"]."', payment_method='".PAYMENT_WAY_1."', ";
				
			
								
				$insert = mysqli_query($db, "INSERT INTO callback SET 
								date='".date("Y-m-d H:i:s", time())."',
								status='new',
								".$auth_sql."
								".$service_code_sql."
								type='".$type_sql."',
								client_fio='".$name."',
								client_phone='".$phone."',
								client_email='".$email."',
								text='".$title." ".$text."', 
								ip='".$ip."'
					");
					if($insert)	
					{
						
						$inserted_callback = mysqli_insert_id($db);
						$files = "";
							// UPLOAD FILE
							$input_name = "service_file";
							if(isset($_FILES[$input_name]))
							{
								$filesCount = count($_FILES[$input_name]["tmp_name"]);
								for($i = 0; $i < $filesCount; $i++)
								{
									$SYSTEM_TMP_FILE = $_FILES[$input_name]["tmp_name"][$i];
									$img_title = $_FILES[$input_name]["name"][$i];
									$file_exts = explode(".", $_FILES[$input_name]["name"][$i]);
									$file_ext = $file_exts[count($file_exts) - 1];
									$file_ext = mb_strtolower($file_ext, "utf-8");
									$new_name = "service_".rand(1000,9999).rand(1000,9999).rand(1000,9999).".".$file_ext;
									
									
									$file_path = DOCUMENT_ROOT."/uploads_service/".$new_name;
									
									
									
									if(move_uploaded_file($SYSTEM_TMP_FILE, $file_path))
									{
										
										$insert = mysqli_query($db, "INSERT INTO files SET 
																			module='callback', 
																			module_id='".$inserted_callback."',
																			title='".$img_title."',
																			link='".$new_name."',
																			filetype='".$file_ext."', 
																			size='".filesize($file_path)."',
																			date_add='".date("Y-m-d H:i:s", time())."',
																			date='".date("Y-m-d H:i:s", time())."'
																		");
										$files = "".DOMAIN_ADRESS."/uploads_service/".$new_name."";
										//$files = "<div><a target=_blank href='".DOMAIN_ADRESS."/uploads_service/".$new_name."'>Photo</a></div>";
									}
								}
							}
							
							
						
	if($type == "callback")		$mail_text = "<b>Получено сообщение с сайта:</b>";
	if($type == "item")			$mail_text = "<b>Получен заказ запчасти с сайта:</b>";
	if($type == "equipment")	$mail_text = "<b>Получен заказ оборудования с сайта:</b>";
	if($type == "service")		$mail_text = "<b>Получен заказ услуги с сайта:</b>";


$mail_text .= "
Имя: ".$name."
Телефон: ".$phone."
"; //E-mail: ".$email."

if( $title != "")
{
	$mail_text .= "Страница: ";

	if($type == "")
	{
		$mail_text .= "<a href='".DOMAIN_ADRESS."item/".intval($title)."'>".$title."</a>";
	}
	else
	{
		$mail_text .= "".$title."";
	}
}

if( $text != "")
$mail_text .= "
Текст сообщения: ".$text."
";
if( $files != "")
$mail_text .= "
Загруженное фото: ".$files."
";
						//$type_sql = "test";
						
						//if(	!preg_match("/http(s)?:\/\//", $mail_text) )
							telegram_send($mail_text, $type_sql);
						
					}
					 
			}
			
			
		}
		
		Header("Location: /".LANG."/appeal_finished");
		exit();
	}
	else
	{
		
		
		if(isset($_GET["name"]))	$name = safe_str($_GET["name"]);		else unset($name);
		$code = ""; if(isset($_GET["code"]))	$code = safe_str($_GET["code"])."";		else unset($code);
		$title = ""; if(isset($_GET["title"]))	$title = safe_str($_GET["title"]).".";		else unset($title);
		$email = ""; if(isset($_GET["email"]))	$email = safe_str($_GET["email"]);		else unset($email);
		if(isset($_GET["phone"]))	$phone = safe_str($_GET["phone"]);		else unset($phone);
		if(isset($_GET["text"]))	$text = safe_str($_GET["text"]);		else unset($text);
		if(isset($_GET["type"]))	$type = safe_str($_GET["type"]);		else unset($type);
		if(isset($_SERVER["HTTP_X_REAL_IP"]))	$ip = safe_str($_SERVER["HTTP_X_REAL_IP"]);	else	$ip = safe_str($_SERVER["REMOTE_ADDR"]);
		
		if((mb_strlen($name, "utf-8") >= 2) && ( (mb_strlen($phone, "utf-8") > 3)))
		{
			$ip = ""; if(isset($_SERVER["HTTP_X_REAL_IP"]))	$ip = safe_str($_SERVER["HTTP_X_REAL_IP"]);	else	$ip = safe_str($_SERVER["REMOTE_ADDR"]);
			
			$service_code_sql = "";
			if($type == "callback")		$type_sql = "Обратный звонок";
			if($type == "item")			$type_sql = "Запчасти заказ";
			if($type == "equipment")	$type_sql = "Оборудование";
			if($type == "service")		
			{
				if($code != "")	$service_code_sql = " service_code='".$code."', ";
				$type_sql = "Ремонт";
			}
			
			
			$auth_sql = "";	if(is_auth(1) && ($type == "service"))	$auth_sql = " user_id='".$_SESSION["id"]."', payment_method='".PAYMENT_WAY_1."', ";
			
	 	
							
			$insert = mysqli_query($db, "INSERT INTO callback SET 
							date='".date("Y-m-d H:i:s", time())."',
							status='new',
							".$auth_sql."
							".$service_code_sql."
							type='".$type_sql."',
							client_fio='".$name."',
							client_phone='".$phone."',
							client_email='".$email."',
							text='".$title." ".$text."', 
							ip='".$ip."'
				");
				if($insert)	
				{
					$inserted_callback = mysqli_insert_id($db);
					 
						
						
					
if($type == "callback")		$mail_text = "<b>Получено сообщение с сайта:</b>";
if($type == "item")			$mail_text = "<b>Получен заказ запчасти с сайта:</b>";
if($type == "equipment")	$mail_text = "<b>Получен заказ оборудования с сайта:</b>";
if($type == "service")		$mail_text = "<b>Получен заказ услуги с сайта:</b>";


$mail_text .= "
Имя: ".$name."
Телефон: ".$phone."
"; //E-mail: ".$email."


if( $title != "")
{
	$mail_text .= "Страница: ";

	if($type == "item")
	{
		$mail_text .= "<a href='".DOMAIN_ADRESS."ua/item/".intval($title)."'>".$title."</a>";
	}
	else
	{
		$mail_text .= "".$title."";
	}
}
/*
if( $title != "")
$mail_text .= "
Страница: ".$title."
";
*/

if( $text != "")
$mail_text .= "
Текст сообщения: ".$text."
"; 
					 
				 
					telegram_send($mail_text, $type_sql);
				 	
					echo notifier("success", "".SENT_REQUEST."");
				}
				else
					echo notifier("error", SENT_REQUEST_ERROR);
		}
		else
			echo notifier("error", SENT_REQUEST_ERROR);
		
		
	}
	}
	
	
	
	//Header("Location: /back");
	exit();
?>