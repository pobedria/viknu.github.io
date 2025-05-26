<? 
function change_lang($lang)
{
	global $db; 
	$return = "";
	
	$id = 0; if(isset($_GET["id"]))	$id = intval($_GET["id"]);
	$sys_link = ""; if(isset($_GET["sys_link"])) $sys_link = safe_str($_GET["sys_link"]);
	 
	if((SYSTEM_FILENAME == "index") ) 
	{ 
		$return = "/".$lang."/";
	} 
	elseif((SYSTEM_FILENAME == "pages") ) 
	{
		if($id > 0)
		{
			$pages = mysqli_query($db, "SELECT id, ".$lang."_title AS title, page, ".$lang."_sys_link AS sys_link FROM pages WHERE id='".$id."'");
			if($pages)	
			if(mysqli_num_rows($pages))	
			if(($page = mysqli_fetch_array($pages)))	
			{
				$return = "/".$lang."/".$page["id"]."-".$page["sys_link"];
			}
		}
		else
		{
			
			if($_GET["page"] == "catalog")
				$return = "/".$lang."/catalog";
			if($_GET["page"] == "oil_catalog")
				$return = "/".$lang."/oil_catalog";
		}
	}
	elseif((SYSTEM_FILENAME == "news")) 
	{
		$act = safe_str($_GET["act"]);
		$category = intval($_GET["category"]);
		
		if($act == "view")
		{
			$news = mysqli_query($db, "SELECT id, ".$lang."_title AS title FROM news WHERE id='".$id."'");
			if($news)	
			if(mysqli_num_rows($news))	
			if(($new = mysqli_fetch_array($news)))	
			{
				$return = "/".$lang."/news/".$category."/view/".$new["id"]."-".translit($new["title"]);
			}
		}
		else
		{
			$return = "/".$lang."/news/".$category;
		}
	} 
	elseif((SYSTEM_FILENAME == "search")) 
	{
		$return = "/".$lang."/search?".mb_substr(urldecode($_SERVER["REQUEST_URI"]), 11);;
	} 
	elseif(
			(SYSTEM_FILENAME == "search_clear")  
		) 
	{
		$return = "/".$lang."/".SYSTEM_FILENAME;
	}
	else
	{
		$return = "/".$lang."/";
	}
 	
	return $return;
}
function is_admin($su = 0)
{
	 
	//CHECK ADM
	if(is_auth(1))
	{
		if($su)
		{
			if(isset($_SESSION["adm"]))	
			{
				if($_SESSION["adm"] == 1)
					return true;
			}
		}
		else
		{
			return true;
		}
	}
	
	return false;
} 
function get_page_title($id)
{
	global $db;
	$items = mysqli_query($db,"SELECT id, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");  
	if($items)
	if(mysqli_num_rows($items))
	{
		if($item = mysqli_fetch_array($items))
		{
			return $item["title"];
		}
	}
	else
	{
		return "-";
	}
}
function get_data($table, $field, $id)
{
	global $db; 
	$items = mysqli_query($db,"SELECT id, ".$field." AS title FROM ".$table." WHERE id='".$id."'");  
	if($items)
	if(mysqli_num_rows($items))
	{
		if($item = mysqli_fetch_array($items))
		{
			return $item["title"];
		}
	}
	 
}
function get_data_where($table, $field, $where_field, $where_data)
{
	global $db;
	 
	$items = mysqli_query($db,"SELECT id, ".$field." AS title FROM ".$table." WHERE ".$where_field."='".$where_data."'");  
	if($items)
	if(mysqli_num_rows($items))
	{
		if($item = mysqli_fetch_array($items))
		{
			return $item["title"];
		}
	}
	 
}
function translit_new($text)
{
	$text = mb_strtolower($text, "utf-8");

	 $converter = array(
		' ' => "-", '(' => "", ')' => "", '[' => "", ']' => "", '\"' => "", '\'' => "", '&quot;' => "", ':' => "", ';' => "", '«' => "", '»' => "", '!' => "", '.' => "", ',' => "", '%' => "",
		'а' => 'a',   'б' => 'b',   'в' => 'v',
		'г' => 'g',   'д' => 'd',   'е' => 'e',
		'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
		'и' => 'i',   'й' => 'y',   'к' => 'k',
		'л' => 'l',   'м' => 'm',   'н' => 'n',
		'о' => 'o',   'п' => 'p',   'р' => 'r',
		'с' => 's',   'т' => 't',   'у' => 'u',
		'ф' => 'f',   'х' => 'h',   'ц' => 'c',
		'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
		'ь' => '',  'ы' => 'y',   'ъ' => '',
		'э' => 'e',   'ю' => 'yu',  'я' => 'ya', 'і' => 'i', 'є' => 'e', 'ї' => 'i',
		
		'А' => 'A',   'Б' => 'B',   'В' => 'V',
		'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
		'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
		'И' => 'I',   'Й' => 'Y',   'К' => 'K',
		'Л' => 'L',   'М' => 'M',   'Н' => 'N',
		'О' => 'O',   'П' => 'P',   'Р' => 'R',
		'С' => 'S',   'Т' => 'T',   'У' => 'U',
		'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
		'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
		'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
		'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
	);
	return strtr($text, $converter);
}
function translit($text)
{
	$text = mb_strtolower($text, "utf-8");

	 $converter = array(
		' ' => "-", '(' => "", ')' => "", '[' => "", ']' => "", '\"' => "", '\'' => "", '&quot;' => "", '&#039;' => "",  '’' => "", ':' => "", ';' => "", '«' => "", '»' => "", '!' => "", '.' => "", ',' => "", '%' => "", '`' => "", '*' => "",  '#' => "",  '№' => "",  '?' => "", 
		'а' => 'a',   'б' => 'b',   'в' => 'v',
		'г' => 'g',   'д' => 'd',   'е' => 'e',
		'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
		'и' => 'i',   'й' => 'y',   'к' => 'k',
		'л' => 'l',   'м' => 'm',   'н' => 'n',
		'о' => 'o',   'п' => 'p',   'р' => 'r',
		'с' => 's',   'т' => 't',   'у' => 'u',
		'ф' => 'f',   'х' => 'h',   'ц' => 'c',
		'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
		'ь' => '',  'ы' => 'y',   'ъ' => '',
		'э' => 'e',   'ю' => 'yu',  'я' => 'ya', 'і' => 'i', 'є' => 'e', 'ї' => 'i',
		
		'А' => 'A',   'Б' => 'B',   'В' => 'V',
		'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
		'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
		'И' => 'I',   'Й' => 'Y',   'К' => 'K',
		'Л' => 'L',   'М' => 'M',   'Н' => 'N',
		'О' => 'O',   'П' => 'P',   'Р' => 'R',
		'С' => 'S',   'Т' => 'T',   'У' => 'U',
		'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
		'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
		'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
		'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
	);
	return strtr($text, $converter);
}
function print_keywords($meta_d, $meta_k)
{
	$return = "";
	if($meta_d != "")
	{
		$return = "<div class='seo_description hidden-xs'>".$meta_d."</div>";
	}
	if($meta_k != "")
	{
		$return .= "<div class='seo_keywords hidden-xs'>";
		//echo "<div class='seo_keywords_title'><h3>".SEO_KEYWORDS."</h3></div>";
		$keywords = explode(",", $meta_k);
		for($i = 0; $i < count($keywords); $i++ )
		{
			$word = trim($keywords[$i]);
			$return .= "<a target=_blank href='/".LANG."/search/".$word."'>".$word."</a>&nbsp;&nbsp;&nbsp;";
			//echo "<a target=_blank href='/".LANG."/search?search_request=".$word."&pages=1&news=1&lib=0'>".$word."</a>&nbsp;&nbsp;&nbsp;";
		}
		$return .= "</div>";
	}
	return $return;
}
function day($date)
{
	if($date == "Mon") return DAY_MONDAY;
	if($date == "Tue") return DAY_TUEDAY;
	if($date == "Wed") return DAY_WEDNESDAY;
	if($date == "Thu") return DAY_THUESDAY;
	if($date == "Fri") return DAY_FRIDAY;
	if($date == "Sat") return DAY_SATURDAY;
	if($date == "Sun") return DAY_SUNDAY;
}
function head_create_sub_title($id = 0)
{
	global $db;
	$pages = mysqli_query($db, "SELECT id, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");
	if($pages)
	if(mysqli_num_rows($pages))
	if($page = mysqli_fetch_array($pages)) 
	{
		if($page["id"] != 1)
		return " :: ".$page["title"];
	}
}
function redirect($url)
{
	Header("Location: ".$url."");
	exit();
}
function br2n($text)
{
	return str_replace("<br />", "\n", $text);
}
function n2br($text)
{
	$text = str_replace("\n", "<br />", $text);
	return str_replace("\n", "", $text);
}
function n2dots($text)
{
	//$text = str_replace("\n", ";", $text);
	return str_replace("\n", ";", $text);
}
function get_related_categories($module, $parent)
{
	global $db;
	$return = "";
	$pages = mysqli_query($db, "SELECT id, ".LANG_DB."title AS title, rel FROM pages WHERE rel='".$parent."'");
	if($pages)
	if(mysqli_num_rows($pages))
	while($page = mysqli_fetch_array($pages))
	{
		if(($module == "news") || ($module == "galleries") || ($module == "videos"))
			$return .= " OR ".$module."_categories.page_id='".$page["id"]."' ";
		//else			$return .= " OR ".$module.".category='".$page["id"]."' ";
		$return .= get_related_categories($module, $page["id"]);
	}
	return $return;
}
function referal_tree($parent, $padding = 1)
{
	global $db;
	$pages = mysqli_query($db, "SELECT id, ".LANG_DB."title AS title, rel FROM pages WHERE rel='".$parent."'");
	if($pages)
	if(mysqli_num_rows($pages))
	while($page = mysqli_fetch_array($pages))
	{
		echo "<div style='margin-left:".(30 * $padding)."px;'>".$page["id"]." - ".$page["title"]."</div>";
		$padding++;
		referal_tree($page["id"], $padding);
		$padding--;
	}
}
function get_img($system_page, $id, $act = "", $highlight = "")
{
	 global $db;
	 $return = "";
	//return "/img/gallery/f3La1int8Ac.jpg";
	$sql = " AND highlight=1 ";
	//if($act == "") 	$sql = " AND slider_highlight=1 ";	
	
	
	if($highlight == "canvas") 		$sql = " AND slider_highlight=1 ";	
	if($highlight == "star") 		$sql = " AND index_highlight=1 ";	
	//if($highlight == "") 			$sql = " ";	
	 
	
	$imgs = mysqli_query($db, "SELECT id, link, link_png FROM files WHERE img=1 AND module='".$system_page."' AND module_id='".$id."' ".$sql."");
	if($imgs)
	if(mysqli_num_rows($imgs))
	{ 
		if($img = mysqli_fetch_array($imgs))
		{
			if($act == "thumb_square")	
			{  
				//($img["link_png"] != "") ?  $return = "/uploads/thumb_square/".$img["link_png"]."" :
				$return = "/uploads/thumb_square/".$img["link"]."";
			} 
			elseif($act == "thumb")	
			{ 
				//($img["link_png"] != "") ?  $return = "/uploads/thumb/".$img["link_png"]."" :
				$return = "/uploads/thumb/".$img["link"]."";
			} 
			elseif($act == "src")		
			{
				($img["link_png"] != "") ?  $return = "/uploads/".$img["link_png"]."" : $return = "/uploads/".$img["link"]."";
			}
			else
			{ 
				($img["link_png"] != "") ?  $return = "<img src='/uploads/".$img["link_png"]."'>" : $return = "<img src='/uploads/".$img["link"]."'>";
			}
		} 
	}
	 
	return $return;
}
function sub_pages($page_id, $type, $page = "", $where = "")
{
	global $db;
	if($type == 1)	// 3 col
	{ 
		$sub_pages = mysqli_query($db, "SELECT 
										pages.id, 
										pages.".LANG_DB."description AS description,  
										pages.page,
										pages.".LANG_DB."sys_link AS sys_link,
										pages.".LANG_DB."title AS title
									FROM pages 
									WHERE pages.rel='".$page_id."' ".$where." AND pages.hide=0  AND pages.".LANG_DB."title<>'' 
									ORDER BY pages.priority, title ");
		if($sub_pages)
		if(mysqli_num_rows($sub_pages))	
		{
			$j = 0;
			$i = 0;
			$k = 0;
			echo "<div class='row'>";
			while($sub_page = mysqli_fetch_array($sub_pages))
			{
				$i++;
				$k++;
				$link = create_link($sub_page["page"], $sub_page["id"], $sub_page["sys_link"]);
				 
				/*
				echo "<div class='col-lg-4 col-md-4 sub_menu_3_col'>";
			//onclick='redirect(\"".$link."\")'
				echo "<a style='' href='".$link."'><div class='sub_menu_3_col_img'  style='background: url(/img/banner6.png), url(".get_img("pages", $sub_page["id"], "src").") center center no-repeat; background-size:cover;'></div></a>";
				echo "
						<div class='spacer'></div>
						<div class='news_title'><a style='' href='".$link."'>".$sub_page["title"]."</a></div>
						<div class='spacer_half'></div>
						<div class='news_description'>".$sub_page["description"]."</div>";
						
				 echo "</div>";
				 
				*/ 
				echo "
					<div class='col-lg-4 col-md-4'>
						<div class='sub_pages_block sub_pages_3' onclick='document.location.href=\"".$link."\"'> 
							<div class='sub_pages_block_title'>
								".$sub_page["title"]."
							</div>
							<div class='sub_pages_block_arrow'>
								<svg class='navigation-social'  viewBox='0 0 16 32' width='32' height='32' aria-hidden='true'>
									<use xlink:href='/img/socials.svg#arrow_white'></use>
								</svg>
							</div>
						</div>
					</div>
				";
			}
			echo "</div>";
		}
	}
	if($type == 2)	// 4 col
	{
		$sub_pages = mysqli_query($db, "SELECT 
										pages.id, 
										pages.".LANG_DB."description AS description,  
										pages.page,
										pages.".LANG_DB."sys_link AS sys_link,
										pages.".LANG_DB."title AS title
									FROM pages 
									WHERE pages.rel='".$page_id."' ".$where." AND pages.hide=0  AND pages.".LANG_DB."title<>'' 
									ORDER BY pages.priority, title ");
		if($sub_pages)
		if(mysqli_num_rows($sub_pages))	
		{
			$j = 0;
			$i = 0;
			$k = 0;
			echo "<div class='row'>";
			while($sub_page = mysqli_fetch_array($sub_pages))
			{
				$i++;
				$j++;
				$k++;
				$link = create_link($sub_page["page"], $sub_page["id"], $sub_page["sys_link"]);
				
				echo "
					<div class='col-lg-3 col-md-3'>
						<div class='sub_pages_block sub_pages_4' onclick='document.location.href=\"".$link."\"'> 
							<div class='sub_pages_block_title'>
								".$sub_page["title"]."
							</div>
							<div class='sub_pages_block_arrow'>
								<svg class='navigation-social'  viewBox='0 0 16 32' width='32' height='32' aria-hidden='true'>
									<use xlink:href='/img/socials.svg#arrow_white'></use>
								</svg>
							</div>
						</div>
					</div>
				";
				 /**
				echo "<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12 sub_menu_4_col'>";
				
						if($sub_page["page"] == "participant")
						{  
	//						CALC REITING
							
							if($sub_page["master_reiting"] > 0)
							{
								echo "
									<div class='master_reiting_circle'>
										<div class='master_reiting_circle_text'>
											".MASTER_RATE."
										</div>
										<div class='master_reiting_circle_score'>
											".round($sub_page["master_reiting"], 1)."
										</div>
										<div class='master_reiting_circle_total'>
											/ 5
										</div>
									</div>
									
									";
							}
							
						}
						
					echo "
						<div class='sub_menu_4_col_img' >";
						//	if($sub_page["page"] == "master")	echo "<a style='' href='".$link."'>".get_img("pages", $sub_page["id"], "master_thumb")."</a>";else	
							
						if($page == "competition")			echo "<a style='' href='".$link."'>".get_img("pages", $sub_page["id"], "sub_pages_square")."</a>";
						else								echo "<a style='' href='".$link."'>".get_img("pages", $sub_page["id"], "sub_pages")."</a>";
							
					echo "</div>
						<h2><a style='' href='".$link."'>".$sub_page["title"]."</a></h2>
						<div class='clarification'>".$sub_page["description"]."</div>
					</div>
					
					<div class='clear visible-xs'></div>
					<div class='spacer_5 visible-xs'></div>
					";
				
				
				if($k != mysqli_num_rows($sub_pages))
				{
					if($i == 4)
					{
						$i = 0;
						echo "<div class='clear visible-lg visible-md'></div>
						<div class='spacer_5 visible-lg visible-md'></div>";
					}
					if($j == 2)
					{
						$j = 0;
						echo "<div class='clear visible-sm'></div>
							<div class='spacer_5 visible-sm'></div>";
					}
				}
				//echo "<h3 class='sub_pages' style=''></h3>";
				*/
			}
			echo "</div>";
		}
	}		
	if($type == 4)	// 6 col
	{ 
		$sub_pages = mysqli_query($db, "SELECT 
										pages.id, 
										pages.".LANG_DB."description AS description,  
										pages.page,
										pages.".LANG_DB."sys_link AS sys_link,
										pages.".LANG_DB."title AS title
									FROM pages 
									WHERE pages.rel='".$page_id."' ".$where." AND pages.hide=0  AND pages.".LANG_DB."title<>'' 
									ORDER BY pages.priority, title ");
		if($sub_pages)
		if(mysqli_num_rows($sub_pages))	
		{
			$j = 0;
			$i = 0;
			$k = 0;
			echo "<div class='row'>";
			while($sub_page = mysqli_fetch_array($sub_pages))
			{
				$i++;
				$k++;
				$link = create_link($sub_page["page"], $sub_page["id"], $sub_page["sys_link"]);
				 
				/*
				echo "<div class='col-lg-4 col-md-4 sub_menu_3_col'>";
			//onclick='redirect(\"".$link."\")'
				echo "<a style='' href='".$link."'><div class='sub_menu_3_col_img'  style='background: url(/img/banner6.png), url(".get_img("pages", $sub_page["id"], "src").") center center no-repeat; background-size:cover;'></div></a>";
				echo "
						<div class='spacer'></div>
						<div class='news_title'><a style='' href='".$link."'>".$sub_page["title"]."</a></div>
						<div class='spacer_half'></div>
						<div class='news_description'>".$sub_page["description"]."</div>";
						
				 echo "</div>";
				 
				*/ 
				echo "
					<div class='col-lg-2 col-md-2'>
						<div class='sub_pages_block sub_pages_6' onclick='document.location.href=\"".$link."\"'> 
							<div class='sub_pages_block_title'>
								".$sub_page["title"]."
							</div>
							<div class='sub_pages_block_arrow'>
								<svg class='navigation-social'  viewBox='0 0 16 32' width='32' height='32' aria-hidden='true'>
									<use xlink:href='/img/socials.svg#arrow_white'></use>
								</svg>
							</div>
						</div>
					</div>
				";
			}
			echo "</div>";
		}
	}
	if($type == 5)	// all col in row
	{ 
		$sub_pages = mysqli_query($db, "SELECT 
										pages.id, 
										pages.".LANG_DB."description AS description,  
										pages.page,
										pages.".LANG_DB."sys_link AS sys_link,
										pages.".LANG_DB."title AS title
									FROM pages 
									WHERE pages.rel='".$page_id."' ".$where." AND pages.hide=0  AND pages.".LANG_DB."title<>'' 
									ORDER BY pages.priority, title ");
		if($sub_pages)
		if(mysqli_num_rows($sub_pages))	
		{
			$j = 0;
			$i = 0;
			$k = 0;
			echo "<div class='row'>";
			while($sub_page = mysqli_fetch_array($sub_pages))
			{
				$i++;
				$k++;
				$link = create_link($sub_page["page"], $sub_page["id"], $sub_page["sys_link"]);
				 
			 
				echo "
					<div class='col'>
						<div class='sub_pages_block sub_pages_6' onclick='document.location.href=\"".$link."\"'> 
							<div class='sub_pages_block_title'>
								".$sub_page["title"]."
							</div>
							<div class='sub_pages_block_arrow'>
								<svg class='navigation-social'  viewBox='0 0 16 32' width='32' height='32' aria-hidden='true'>
									<use xlink:href='/img/socials.svg#arrow_white'></use>
								</svg>
							</div>
						</div>
					</div>
				";
			}
			echo "</div>";
		}
	}
	if($type == 3)
	{
		$sub_pages = mysqli_query($db, "SELECT 
										pages.id, 
										pages.page, 
										pages.".LANG_DB."sys_link AS sys_link,
										pages.".LANG_DB."title AS title
									FROM pages 
									WHERE pages.rel='".$page_id."' ".$where." AND pages.hide=0  AND pages.".LANG_DB."title<>'' 
									ORDER BY pages.priority, title ");
		if($sub_pages)
		if(mysqli_num_rows($sub_pages))	
		{
			echo "<div class='row'>";
			while($subcategory = mysqli_fetch_array($sub_pages))
			{ 
				echo "<div class=' '>";
					echo "<div class='catalog_subcategory_title'><h4><a href='".create_menu_link("pages", $subcategory["id"], $subcategory["sys_link"])."'>".$subcategory["title"]."</a></h4></div>"; //onclick='redirect(\"".create_menu_link("pages", $subcategory["id"], $subcategory["sys_link"])."\")'
					echo "<div class='spacer'></div>"; 
				echo "</div>"; 
			}
			echo "</div>";
			/*
			while($sub_page = mysqli_fetch_array($sub_pages))
			{
				$link = create_link($sub_page["page"], $sub_page["id"], $sub_page["sys_link"]);
				echo "<h3 class='sub_pages' style=''><a style='' href='".$link."'>".$sub_page["title"]."</a></h3>";
			}
			*/
		}
	}
	 
	
	
	return 0;
}
function get_marque($act = "index")
{
	$announ = "";
	$announs = mysqli_query($GLOBALS['db'], "SELECT id, ".LANG_DB."title AS title FROM pages WHERE page='announ' AND hide='0'");
	if($announs)
	if(mysqli_num_rows($announs))
	if($an = mysqli_fetch_array($announs))
	{
		$announ = "<a href='/".LANG."/pages/".$an["id"]."'>".$an["title"]."</a>";
	}
	$announ2 = "";
	$announs = mysqli_query($GLOBALS['db'], "SELECT id, ".LANG_DB."title AS title FROM pages WHERE page='announ2' AND hide='0'");
	if($announs)
	if(mysqli_num_rows($announs))
	if($an = mysqli_fetch_array($announs))
	{ 
		$announ2 = "<a href='/".LANG."/pages/".$an["id"]."'>".$an["title"]."</a>"; 
	} 
	 
	if(($announ != "") || ($announ2 != ""))
	{
		
	}
	
	
	if($act == "index")
	{
		return "<div class='marque'>
					<div class='marque'>
						<marquee>
							".$announ." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$announ2."
						</marquee>
					</div>
				</div>
		";
	}
	else
	{
		return "<div class='marque_page'>
					<marquee>
						".$announ." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$announ2."
					</marquee>
				</div>";
	}
	
}
function share()
{
	echo  "<div class='spacer_3'></div>";
	//echo  "<hr>"; 
	echo  "<div class='sharethis-inline-share-buttons' style='text-align:left;'></div>";
	 
}
function print_uploads($module = "", $id = 0, $act = "")
{
	global $db;
	$sql_id = intval($_GET["id"]);
	$sql_module = SYSTEM_FILENAME;
	if($module != "")	$sql_module = $module;
	if($id != 0)	$sql_id = $id;
	
	if($module == "news")
	{
		echo "<div class='content_text'>";
			echo "<div class=' '>";
			$files = mysqli_query($db, "SELECT id, title, date, link, filetype, size FROM files WHERE module='".$sql_module."' AND module_id='".$sql_id."' AND img=0 AND hide=0  ORDER BY priority, filetype, title");
			if($files)
				if(mysqli_num_rows($files))
				{
					echo "<div class='files'><br>";
					echo "<div class=''>
							<div class='page_hr'></div>
							<div class='spacer'></div> 
							</div>";//margin-left:0px;
					while($file = mysqli_fetch_array($files))
						echo "<div class='file'><a href='/uploads/".$file["link"]."' target='_blank'><img src='/img/filetypes/".$file["filetype"].".png'> ".$file["title"]."</a></div>";
					echo "</div>";
				}
			echo "</div>";
			echo "<div style='clear:both;'></div>";
		echo "</div>";
	
	
	 
		$galleries = mysqli_query($db, "SELECT id, link FROM files WHERE hide='0' AND img='1' AND module='".$sql_module."' AND module_id='".$sql_id."' ORDER BY priority  ");
		if($galleries)
		if(mysqli_num_rows($galleries))
		{ 
			echo "<div class=''>"; 
			echo "<div id='owl-carousel' class='owl-carousel owl-carousel-slider owl-theme'>";
								
			$i = 0;	
			$j = 0;	
			 
			while($slider = mysqli_fetch_array($galleries))
			{
				 
				 
				if($slider["date_publish"] == "")	$slider["date_publish"] = $slider["date"];
				echo "<div class='item gallery_holder ";   if($j == 0) echo " active ";  echo "' data-fancybox  data-src='/uploads/".$slider["link"]."'  style='background:   url(/uploads/".$slider["link"].") center center no-repeat; background-color:#000; "; if($slider["id"] == 13) echo " background-size:contain; "; else echo " background-size:cover; ";
				echo "'>";	
					 
				 
				echo "</div>";
				 
				$j++; 
			}
			echo " </div>"; 
			echo " </div>"; 
			echo "<script>
				  var owl = $('#owl-carousel');
				  owl.owlCarousel({
					margin: 0,
					loop: false,
					dots: false,
					nav:true,
					navText:[\"<div class='owl_arrow_left'><svg class='navigation-social' viewBox='0 0 24 24' width='24' height='24' aria-hidden='true'><use xlink:href='/img/socials.svg#arrow_left'></use></svg></div>\", \"<div class='owl_arrow_right'><svg class='navigation-social' viewBox='2 0 24 24' width='24' height='24' aria-hidden='true'><use xlink:href='/img/socials.svg#arrow_right'></use></svg></div>\"],
					autoplay:true,
					autoplayTimeout:15000,
					autoplayHoverPause:true,
					responsive: {
					  0: {
						items: 1,
						margin: 0 
					  },
					  576: {
						items: 2,
						margin: 0 
					  },
					  768: {
						items: 3,
						margin: 0	
					  },
					  992: {
						items: 5,
						margin: 0	
					  },
					  1200: {
						items: 5
					  }
					}
				  })
				</script>";  
			
			if($j > 5)
			{
				echo "<div class='clear'></div>"; 
				echo "<div class='spacer_5'></div>"; 
				echo "<div class='spacer_3'></div>"; 
			}
		}
	}
	else
	{
	/*
	if($module == "galleries")
	{
		echo "<div class='clear'></div>";
		$photos = mysqli_query($db, "SELECT id, title, date, link, filetype, size FROM files WHERE module='".SYSTEM_FILENAME."' AND module_id='".intval($_GET["id"])."' AND img=1 AND hide=0");
		if($photos)
			if(mysqli_num_rows($photos))
			{
				echo "<div class=''>";
				$i = 0;
				$j = 0;
				while($photo = mysqli_fetch_array($photos))
				{
					$i++;
					$j++;
					echo "<div class='col-lg-3 col-md-3 col-sm-6 col-xs-6 photo'><a  href='/uploads/".$photo["link"]."' data-fancybox='gallery' data-caption='<a href=\"/uploads/".$photo["link"]."\" target=_blank>".DOWNLOAD_ORIG."</a>'>";
							echo "<img src='/uploads/galleries_thumb/".$photo["link"]."'>";
					echo "	</a></div>";
						echo "<div class='clear visible-xs'></div>";
						echo "<div class='spacer_3 visible-xs'></div>";
						
					if($i == 3)
					{
						$i = 0;
						echo "<div class='clear visible-lg visible-md'></div>";
						echo "<div class='spacer_3 visible-lg visible-md'></div>";
					}
					if($j == 2)
					{
						$j = 0;
						echo "<div class='clear visible-sm'></div>";
						echo "<div class='spacer_3 visible-sm'></div>";
					}
				}
				echo "</div>";
			}
		echo "<div class='clear'></div>";
	}
	else
	{
		*/
		
		
		echo "<div class='content_text'>";
			echo "<div class='clear'></div>";
			$photos = mysqli_query($db, "SELECT id, title, date, link, filetype, size FROM files WHERE module='".$sql_module."' AND module_id='".$sql_id."' AND img=1 AND hide=0 ORDER BY priority");
			
			if($photos) 
				if(mysqli_num_rows($photos))
				{ 
					echo "<div class='photos'><div class='row'>"; 
					$i = 0;
					$j = 0;
					while($photo = mysqli_fetch_array($photos))
					{
						$i++;
						$j++; 
						echo "<div class='col-lg-2 col-md-3 col-sm-6 col-xs-6 photo'><a  href='/uploads/".$photo["link"]."' data-fancybox='gallery'  >";
								echo "<img src='/uploads/thumb_square/".$photo["link"]."'>";
						echo "	</a></div>";
							//echo "<div class='clear visible-xs'></div>";
							//echo "<div class='spacer_3 visible-xs'></div>";
						/*
						if($i == 4)
						{
							$i = 0;
							echo "<div class='clear visible-lg visible-md'></div>";
							echo "<div class='spacer_3 visible-lg visible-md'></div>";
						}
						if($j == 2)
						{
							$j = 0;
							echo "<div class='clear visible-sm  visible-xs '></div>";
							echo "<div class='spacer_3 visible-sm  visible-xs'></div>";
						}
						*/
					} 
					echo "</div>";
					echo "</div>";
				}
				else
				{
				 
				}
			echo "<div class='clear'></div>";
		echo "</div>";
	
	echo "<div class='content_text'>";
		echo "<div class=' '>";
		$files = mysqli_query($db, "SELECT id, title, date, link, filetype, size FROM files WHERE module='".$sql_module."' AND module_id='".$sql_id."' AND img=0 AND hide=0  ORDER BY priority, filetype, title");
		if($files)
			if(mysqli_num_rows($files))
			{
				echo "<div class='files'><br>";
				echo "<div class=''>
						<div class='page_hr'></div>
						<div class='spacer'></div> 
						</div>";//margin-left:0px;
				while($file = mysqli_fetch_array($files))
					echo "<div class='file'><a href='/uploads/".$file["link"]."' target='_blank'><img src='/img/filetypes/".$file["filetype"].".png'> ".$file["title"]."</a></div>";
				echo "</div>";
			}
		echo "</div>";
		echo "<div style='clear:both;'></div>";
	echo "</div>";
	}
	
}
function create_link($module, $module_id, $link = "")
{
	return create_menu_link($module, $module_id, $link);
}
function create_menu_link($page, $id, $link = "")
{ 
	//return "/1";
	if($page == "index")	 	 return LANG_LINK."/"; 
	if($page == "abit")	 	 	return LANG_LINK."/".$id."-".$link; 
	if(($page == "pages") || ($page == "index_blocks"))	 	 return LANG_LINK."/".$id."-".$link; 
	if($page == "news")		 
	{
		$link = LANG_LINK."/news/".$id;
	}
	if($page == "news_view")		 
	{
		$link = LANG_LINK."/news/".NEWS_CATEGORY_ID."/view/".$id;
	}
	if($page == "galleries") 		return LANG_LINK."/galleries/".$id;
	if($page == "videos")	 		return LANG_LINK."/videos/".$id;
	if($page == "lib")	 			return LANG_LINK."/lib/".$id;
	if($page == "lib_view")	 		return LANG_LINK."/lib/".LIB_CATEGORY_ID."/view/".$id;
	
	
	
	return $link;
}
function find_menu_id($id)
{
	global $db;
	$pages = mysqli_query($db, "SELECT id, rel, menu FROM pages WHERE id='".$id."'");
	if($pages)
	if(mysqli_num_rows($pages))
	if($page = mysqli_fetch_array($pages))
	{
		if($page["menu"] == 1)	return $page["id"];
		$pages = mysqli_query($db, "SELECT id, rel, menu FROM pages WHERE id='".$page["rel"]."'");
		if($pages)
		if(mysqli_num_rows($pages))
		if($page = mysqli_fetch_array($pages))
		{
			if($page["menu"] == 1)	return $page["id"];
			
			$pages = mysqli_query($db, "SELECT id, rel, menu FROM pages WHERE id='".$page["rel"]."'");
			if($pages)
			if(mysqli_num_rows($pages))
			if($page = mysqli_fetch_array($pages))
			{
				if($page["menu"] == 1)	return $page["id"];
			
			}
		}
		
	}
	return 0;
}
function create_menu($act = "", $limit_1 = 0, $limit_2 = 10)
{
	global $db;
	$return = "";
	if($act == "footer")
	{  
		$menus = mysqli_query($db, "SELECT id, page, ".LANG_DB."title AS title, ".LANG_DB."sys_link AS sys_link FROM pages WHERE menu=1 AND hide=0 AND ".LANG_DB."title<>'' ORDER BY priority LIMIT ".$limit_1.", ".$limit_2."");
		if($menus)
		if(mysqli_num_rows($menus))
		{
			$return = "<div class=''>";
			while($menu = mysqli_fetch_array($menus))
			{
				$link = "".create_menu_link($menu["page"], $menu["id"], $menu["sys_link"])."";
				$return .= "<a href='".$link."' class='footer_menu_title'>".$menu["title"]."</a>";
				
				// GET PAGES
				$return .= "<div class='hidden-xs '>";
				$pages = mysqli_query($db, "SELECT id, page, ".LANG_DB."title AS title, ".LANG_DB."sys_link AS sys_link FROM pages WHERE rel=".$menu["id"]." AND hide=0 AND ".LANG_DB."title<>'' ORDER BY priority LIMIT 15");
				if($pages)
				if(mysqli_num_rows($pages))
				{
					$return .= "<div class='spacer'></div>";
					while($page = mysqli_fetch_array($pages))
					{
						$link = "".create_menu_link($page["page"], $page["id"], $page["sys_link"])."";
						$return .= "<div class='footer_menu'><a href='".$link."'>".$page["title"]."</a></div>";
					}
				}
				$return .= "</div>";
			}
			$return .= "</div>";
		}
	}
    
	else
	if($act == "mobile")
	{
		$menus = mysqli_query($db, "SELECT id, page, ".LANG_DB."title AS title, ".LANG_DB."sys_link AS sys_link FROM pages WHERE menu=1 AND hide=0 AND ".LANG_DB."title<>'' ORDER BY priority");
		if($menus)
		if(mysqli_num_rows($menus))
		{
			$return = "";
			while($menu = mysqli_fetch_array($menus))
			{
				$link = create_menu_link($menu["page"], $menu["id"], $menu["sys_link"])."";
                if ('kniga-poshani' !== $menu['sys_link']) {
                    $return .= "<div class='mobile_menu_item'><a href='" . $link . "'>" . $menu["title"] . "</a></div>";
                } else {
                    $return .= "<div class='mobile_menu_item'><a href='" . $link . "'>Кращі серед рівних</a></div>";
                }
            }
			$return .= "";
		}
	}
 
	else
	{
		$return = "";
		 
		$menus = mysqli_query($GLOBALS['db'], "SELECT id, page, ".LANG_DB."title AS title, ".LANG_DB."sys_link AS sys_link FROM pages WHERE menu=1 AND hide=0 AND ".LANG_DB."title<>'' ORDER BY priority");
		if($menus)
		if(mysqli_num_rows($menus))
		{
			$return .= "<ul class='menu_desktop '>";
            while ($menu = mysqli_fetch_array($menus)) {
                if ('kniga-poshani' == $menu['sys_link']) {
                    continue;
                }

                if ($menu["id"] == 132) {
                    $return .= "<li><div style='margin:5px 8px 0px 8px; width:1px; height:18px; background:#fff;'></div></li>";
                }

                if ($menu["id"] == 143) {
                    $return .= "<li><div style='margin:5px 8px 0px 8px; width:1px; height:18px; background:#fff;'></div></li>";
                }

                $return .= "<li><a class='no_bg";
                $return .= "' href='" . create_menu_link($menu["page"], $menu["id"], $menu["sys_link"]) . "'>"
                    . $menu["title"] . "</a>";
                if ($menu["id"] != 1) {
                    $items = mysqli_query($GLOBALS['db'], "SELECT id, page, " . LANG_DB . "title AS title, " . LANG_DB
                        . "sys_link AS sys_link FROM pages WHERE rel='" . $menu["id"] . "' AND hide=0 AND " . LANG_DB
                        . "title<>'' ORDER BY priority"
                    );
                    if ($items) {
                        if (mysqli_num_rows($items)) {
                            $return .= "<ul class=''>";

                            while ($item = mysqli_fetch_array($items)) {
                                $return .= "<li><a class='no_bg' href='" . create_menu_link(
                                        $item["page"], $item["id"], $item["sys_link"]
                                    ) . "'>" . $item["title"] . "</a></li>";
                            }

                            $return .= "</ul>";
                        }
                    }
                }
                $return .= "</li>";
            }

            $return .= "<li style='margin-top: -23px !important;'><a class='no_bg' href='/ua/147-kniga-poshani'><img src='/img/ribbon_new.png' style='width: 150px;height: auto;'></a></li>";
			$return .= "</ul>";
		}
	}
	return $return;
}
function file_text($filetype)
{
	if($filetype == "doc") return DOC;
	if($filetype == "docx") return DOCX;
	if($filetype == "xls") return XLS;
	if($filetype == "xlsx") return XLSX;
	if($filetype == "ppt") return PPT;
	if($filetype == "pptx") return PPTX;
	if($filetype == "zip") return ZIP;
	if($filetype == "rar") return RAR;
	if($filetype == "pdf") return PDF;
	if($filetype == "txt") return TXT;
	if($filetype == "jpg") return JPG;
	if($filetype == "jpeg") return JPEG;
}
function calendar_month($date)
{
	if($date == 1) return MONTH_JANUARY;
	if($date == 2) return MONTH_FEBRUARY;
	if($date == 3) return MONTH_MARCH;
	if($date == 4) return MONTH_APRIL;
	if($date == 5) return MONTH_MAY;
	if($date == 6) return MONTH_JUNE;
	if($date == 7) return MONTH_JULY;
	if($date == 8) return MONTH_AUGUST;
	if($date == 9) return MONTH_SEPTEMBER;
	if($date == 10) return MONTH_OCTOBER;
	if($date == 11) return MONTH_NOVEMBER;
	if($date == 12) return MONTH_DECEMBER;
}
function month($date)
{
	if($date == 1) return JANUARY;
	if($date == 2) return FEBRUARY;
	if($date == 3) return MARCH;
	if($date == 4) return APRIL;
	if($date == 5) return MAY;
	if($date == 6) return JUNE;
	if($date == 7) return JULY;
	if($date == 8) return AUGUST;
	if($date == 9) return SEPTEMBER;
	if($date == 10) return OCTOBER;
	if($date == 11) return NOVEMBER;
	if($date == 12) return DECEMBER;
}
function views($count)
{
	return number_format($count, 0, '', '&nbsp;');
}
function views_exchange($count)
{
	return number_format($count, 2, '.', '&nbsp;');
}
function views_sql($count)
{
	return number_format($count, 2, '.', '');
}
function notifier($act, $text)
{
	if($act == "success")	$return = "<div class='notifier_success'><span class='notifier_text'>".$text."</span></div>";
	if($act == "error")		$return = "<div class='notifier_error'><span class='notifier_text'>".$text."</span></div>";
	if($act == "warning")	$return = "<div class='notifier_warning'><span class='notifier_text'>".$text."</span></div>";
	if($act == "info")		$return = "<div class='notifier_info'><span class='notifier_text'>".$text."</span></div>";
	
	return $return;
}
function notifier_mini($act, $text)
{
	if($act == "success")	$return = "<div class='notifier_mini_success'><span class='notifier_text'>".$text."</span></div>";
	if($act == "error")		$return = "<div class='notifier_mini_error'><span class='notifier_text'>".$text."</span></div>";
	if($act == "warning")	$return = "<div class='notifier_mini_warning'><span class='notifier_text'>".$text."</span></div>";
	if($act == "info")		$return = "<div class='notifier_mini_info'><span class='notifier_text_mini'>".$text."</span></div>";
	
	return $return;
}
function referal_tree_navigation($parent)
{
	global $db;
	$pages = mysqli_query($db, "SELECT id, ".LANG_DB."title AS title, ".LANG_DB."sys_link AS sys_link, rel, page FROM pages WHERE id='".$parent."'");
	if($pages)
	if(mysqli_num_rows($pages))
	if($page = mysqli_fetch_array($pages))
	{
		referal_tree_navigation($page["rel"]);
		echo "<a href='".create_menu_link($page["page"], $page["id"], $page["sys_link"])."'>".$page["title"]."</a> &nbsp;/&nbsp;  ";
	}
}
function navigation($system_page, $id = 0, $act = "")
{
	global $db;
	echo "<div class='navigation  '>";
	
	if($system_page == "abit")
	{
		$act = ""; if(isset($_GET["act"]))	$act = $_GET["act"];
		 
		if($act == "list")
		{
			$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");
			if($pages)
			if(mysqli_num_rows($pages))
			if($page = mysqli_fetch_array($pages))
			{ 
				referal_tree_navigation($page["rel"]);
				echo $page["title"]." ";//".$page["id"]."
			}
		}
		elseif($act == "view")
		{
			$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE page='abit'");
			if($pages)
			if(mysqli_num_rows($pages))
			if($page = mysqli_fetch_array($pages))
			{ 
				referal_tree_navigation($page["rel"]);
				echo "<a href='/".LANG."/abit/".date("Y", time())."'>".$page["title"]."</a> "; 
			}
			$pages = mysqli_query($db, "SELECT id, ".LANG_DB."title AS title FROM abit WHERE id='".$id."'");
			if($pages)
			if(mysqli_num_rows($pages))
			if($page = mysqli_fetch_array($pages))
			{ 
				 
				echo " /   ";  //".$page["title"]."
			}
		}
	}
	if($system_page == "search")
	{
		$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE page='index'");
		if($pages)
		if(mysqli_num_rows($pages))
		if($page = mysqli_fetch_array($pages))
		{ 
			referal_tree_navigation($page["rel"]);
			echo "<a href='/".LANG."/abit/".date("Y", time())."'>".$page["title"]."</a> "; 
		}
				echo " / ".SEARCH."  "; 
	}  
	if($system_page == "index")
	{
		//echo "Main page";
	}  
	if(($system_page == "lib")   )
	{
		
		$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");
		if($pages)
		if(mysqli_num_rows($pages))
		if($page = mysqli_fetch_array($pages))
		{
			referal_tree_navigation($page["rel"]);
			echo $page["title"]." ";//".$page["id"]."
		}
	}
	if(($system_page == "pages")   )
	{ 
		
			$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");
			if($pages)
			if(mysqli_num_rows($pages))
			if($page = mysqli_fetch_array($pages))
			{
				referal_tree_navigation($page["rel"]);
				echo $page["title"]." ";//".$page["id"]."
			}
		 
	} 
	if($system_page == "news")
	{ 
 
		$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");
		if($pages)
		if(mysqli_num_rows($pages))
		if($page = mysqli_fetch_array($pages))
		{
			referal_tree_navigation($page["rel"]);
			
			if(isset($_GET["page"]))		$page_current = intval($_GET["page"]); 	else	$page_current = 1;
			if(isset($_GET["id"]))			$news_id = intval($_GET["id"]); 		else	$news_id = 0;
			
			if($news_id != 0)
			{ 
				$news = mysqli_query($db, "SELECT news.id, news.".LANG_DB."title AS title FROM news WHERE id='".$news_id."'");
				if($news)
				if(mysqli_num_rows($news))
				if($new = mysqli_fetch_array($news))
				{ 
					$lang_link = "/".LANG;
					echo " <a href='".create_menu_link($system_page, intval($_GET["category"]))."'>".$page["title"]."</a> &nbsp;/&nbsp; "; // ".$new["title"]."
					//echo " <a href='".$lang_link."/".$system_page."/".$page_current."/category/".intval($_GET["category"])."'>".$page["title"]."</a> &nbsp;/&nbsp; "; // ".$new["title"]."
				}
			}
			else				echo $page["title"];
		}
	}
	if($system_page == "galleries")
	{
		$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");
		if($pages)
		if(mysqli_num_rows($pages))
		if($page = mysqli_fetch_array($pages))
		{ 	
			referal_tree_navigation($page["rel"]);
			
			if(isset($_GET["page"]))		$page_current = intval($_GET["page"]); 	else	$page_current = 1;
			if(isset($_GET["id"]))			$gallery_id = intval($_GET["id"]); 		else	$gallery_id = 0;
			
			if($gallery_id != 0)
			{
				$galleries = mysqli_query($db, "SELECT id, ".LANG_DB."title AS title, category FROM galleries WHERE id='".$gallery_id."'");
				if($galleries)
				if(mysqli_num_rows($galleries))
				if($gallery = mysqli_fetch_array($galleries))
				{
					$lang_link = "/".LANG;
					echo " <a href='".$lang_link."/".$system_page."/".$page_current."/category/".intval($_GET["category"])."'>".$page["title"]."</a>  &nbsp;/&nbsp;  "; //".$gallery["title"]."
				}
			}
			//else				echo $page["title"];
		}
	}
	if($system_page == "videos")
	{
		$pages = mysqli_query($db, "SELECT id, rel, ".LANG_DB."title AS title FROM pages WHERE id='".$id."'");
		if($pages)
		if(mysqli_num_rows($pages))
		if($page = mysqli_fetch_array($pages))
		{
			referal_tree_navigation($page["rel"]);
			
			if(isset($_GET["page"]))		$page_current = intval($_GET["page"]); 	else	$page_current = 1;
			if(isset($_GET["id"]))			$gallery_id = intval($_GET["id"]); 		else	$gallery_id = 0;
			
			if($gallery_id != 0)
			{
				$videos = mysqli_query($db, "SELECT id, ".LANG_DB."title AS title, category FROM videos WHERE id='".$gallery_id."'");
				if($videos)
				if(mysqli_num_rows($videos))
				if($video = mysqli_fetch_array($videos))
				{
					$lang_link = "/".LANG;
					echo " <a href='".$lang_link."/".$system_page."/".$page_current."/category/".intval($_GET["category"])."'>".$page["title"]."</a>  &nbsp;/&nbsp;  "; //".$video["title"]."
				}
			}
			//else				echo $page["title"];
		}
	}

	echo "</div>";
	//echo "<div class='spacer_2'></div>";
	
}
function safe_str($str)
{
	return htmlspecialchars(trim(mres($str)), ENT_QUOTES, "UTF-8");
}
function print_text($text)
{
	//return (clear_text_print($text));
	return htmlspecialchars(clear_text_print($text), ENT_QUOTES, "UTF-8");
}
function clear_text($text)
{
	$search = array ("'<.+?>'",  
                 "'([\r\n])[\s]+'",                 // Вырезается пустое пространство 
                 "'&(quot|#34);'i",                 // Замещаются html-элементы 
                 "'&(amp|#38);'i", 
                 "'&(lt|#60);'i", 
                 "'&(gt|#62);'i", 
                 "'&(nbsp|#160);'i", 
                 "'&(iexcl|#161);'i", 
                 "'&(cent|#162);'i", 
                 "'&(pound|#163);'i", 
                 "'&(copy|#169);'i" 
	); 
	
	$replace = array ("", 
                  "", 
                  "", 
                  "", 
                  "", 
                  "", 
                  "", 
                  "", 
                  "", 
                  "", 
                  "",  
                  ""  
	);
	return $text = preg_replace($search, $replace, $text); 
}

function clear_text_from_htmlspecialchars($text)
{
	$search = array (                          
                 "'&(quot|#34);'i",                 
                 "'&(amp|#38);'i", 
                 "'&(lt|#60);'i", 
                 "'&(gt|#62);'i", 
                 "'&(nbsp|#160);'i", 
                 "'&(iexcl|#161);'i", 
                 "'&(cent|#162);'i", 
                 "'&(pound|#163);'i", 
                 "'&(#039);'i", 
                 "'&(copy|#169);'i" 
	); 

	$replace = array (
                  "\"", 
                  "&", 
                  "<", 
                  ">", 
                  "&nbps;", 
                  chr(161), 
                  chr(162), 
                  chr(163), 
                  "'", 
                  chr(169) 
	);
	return $text = preg_replace($search, $replace, $text); 
}
function clear_text2($text)
{
	$search = array ("'<script[^>]*?>.*?</script>'si",  // Вырезается javascript 
                "'<[\/\!]*?(?!iframe)(?!\/iframe)[^<>]*?>'si",        // Вырезаются html-тэги 
                 "'([\r\n])[\s]+'",                 // Вырезается пустое пространство 
                 "'&(quot|#34);'i",                 // Замещаются html-элементы 
                 "'&(amp|#38);'i", 
                 "'&(lt|#60);'i", 
                 "'&(gt|#62);'i", 
                 "'&(nbsp|#160);'i", 
                 "'&(iexcl|#161);'i", 
                 "'&(cent|#162);'i", 
                 "'&(pound|#163);'i", 
                 "'&(copy|#169);'i" 
	); 

	$replace = array ("", 
                  "", 
                  "\\1", 
                  "\"", 
                  "&", 
                  "<", 
                  ">", 
                  " ", 
                  chr(161), 
                  chr(162), 
                  chr(163), 
                  chr(169) 
	);
	return $text = preg_replace($search, $replace, $text); 
}
function clear_text_print($text)
{
	$search = array (                          
                 "'&(quot|#34);'i",                 
                 "'&(amp|#38);'i", 
                 "'&(lt|#60);'i", 
                 "'&(gt|#62);'i", 
                 "'&(nbsp|#160);'i", 
                 "'&(iexcl|#161);'i", 
                 "'&(cent|#162);'i", 
                 "'&(pound|#163);'i", 
                 "'&(#039);'i", 
                 "'&(copy|#169);'i" 
	); 

	$replace = array (
                  "\"", 
                  "&", 
                  "<", 
                  ">", 
                  "&nbsp;", 
                  chr(161), 
                  chr(162), 
                  chr(163), 
                  "'", 
                  chr(169) 
	);
	return $text = preg_replace($search, $replace, $text); 
}
function youtube_check($link, $act) 
{
	if(preg_match("$(http\:\/\/|https\:\/\/|)(www\.)?((youtube.com)|(youtu.be))\/.*(v|embed)?(=|/)?([0-9a-zA-Z-_]{11})$", $link, $matches, PREG_OFFSET_CAPTURE))
	{ 
		if($act == "link")
			return "https://youtube.com/embed/".$matches[8][0];
		if($act == "id")
			return $matches[8][0];
	}
	return false;
}
function site_date($date, $full = 0)
{
	if($full == 0)	return date("d", strtotime($date))." ".month(date("m", strtotime($date)))." ".date("Y", strtotime($date));
	if($full == 1)	return date("d", strtotime($date))." ".month(date("m", strtotime($date)))." ".date("Y", strtotime($date))." ".IN." ".date("H:i", strtotime($date));
}
function calc_size($size)
{
	// $size - байт
	if($size > 1000000)	return round($size/1000000, 2)." Мб";
	elseif($size > 1000)	return round($size/1000)." Кб";
	elseif($size < 1000)	return $size." Байт";
}
function calc_pages($table, $where, $pagename = "page")
{
	global $db;
	
		$num = 12;
		
		if($table == "news")	$num = NEWS_PER_PAGE;
		if($table == "galleries")	$num = GALLERIES_PER_PAGE;
		if($table == "videos")	$num = VIDEOS_PER_PAGE;
		
		$posts = 1; 
		$parsed_url = parse_url($_SERVER["REQUEST_URI"]);
		@parse_str($parsed_url["query"], $url);
		@$page = intval($url[$pagename]);
		
		
		 
		$result00 = mysqli_query($db, "SELECT COUNT(*) FROM $table ".$where);
		if(mysqli_num_rows($result00) > 1)	
		{
			
			$posts = mysqli_num_rows($result00);
		}
		else
		{  
	 
			//$posts = mysqli_num_rows($result00);
			$temp = @mysqli_fetch_array($result00);
			$posts = $temp[0];
			
			 
		} 
		
		
		/*
		$counts = mysqli_query($db, "SELECT COUNT(*) AS count FROM ".$table." ".$where);
		if($counts)
		if($count = mysqli_fetch_array($counts))
		{
			$posts = $count["count"];
		}
		 */
		
		$total = intval((($posts - 1) / $num) + 1);
	 
		$page = intval($page);
		if(empty($page) or $page < 0) $page = 1;
		if($total == 0)	$total = 1;
		if($page > $total) $page = $total;
		  
		  
		$mass[0] = $page * $num - $num;
		$mass[1] = $num;
		$mass[2] = $page;
		$mass[3] = $total;
		$mass[4] = $posts;
		return $mass;
}
function print_pages($filename, $page, $total, $category)
{
	$prevpage = "<li class='page-item "; if($page == 1) $prevpage .= "disabled"; $prevpage .= "' >
					  <a class='page-link' href='".$filename."?page=1".$category."' aria-label='First page'>
						<span aria-hidden='true'>&laquo;&laquo;</span>
					  </a> 
				</li>
				<li class='page-item "; if($page == 1) $prevpage .= "disabled"; $prevpage .= "' >
					  <a class='page-link' href='".$filename."?page=".($page - 1)."".$category."' aria-label='Previous page'>
						<span aria-hidden='true'>&laquo;</span>
					  </a> 
				</li>  ";
		
	$nextpage = "
				<li class='page-item "; if($page == $total) $nextpage .= "disabled"; $nextpage .= "' >
					  <a class='page-link' href='".$filename."?page=".($page + 1)."".$category."' aria-label='Last page'>
						<span aria-hidden='true'>&raquo;</span>
					  </a> 
				</li> 
				<li class='page-item "; if($page == $total) $nextpage .= "disabled"; $nextpage .= "' >
					  <a class='page-link' href='".$filename."?page=" .$total. "".$category."' aria-label='Next page'>
						<span aria-hidden='true'>&raquo;&raquo;</span>
					  </a> 
				</li>
		";
	$page3left = "";	$page2left = ""; 	$page1left = "";	$page3right = "";	$page2right = "";	$page1right = "";
	
	if($page - 3 > 0) $page3left = "<li class='page-item'><a class='page-link' href='".$filename."?page=". ($page - 3) ."".$category."'>". ($page - 3) ."</a></li>";
	if($page - 2 > 0) $page2left = "<li class='page-item'><a class='page-link' href='".$filename."?page=". ($page - 2) ."".$category."'>". ($page - 2) ."</a></li>";
	if($page - 1 > 0) $page1left = "<li class='page-item'><a class='page-link' href='".$filename."?page=". ($page - 1) ."".$category."'>". ($page - 1) ."</a></li>";
	
	if($page + 3 <= $total) $page3right = "<li class='page-item'><a class='page-link' href='".$filename."?page=". ($page + 3) ."".$category."'>". ($page + 3) ."</a></li>";
	if($page + 2 <= $total) $page2right = "<li class='page-item'><a class='page-link' href='".$filename."?page=". ($page + 2) ."".$category."'>". ($page + 2) ."</a></li>";
	if($page + 1 <= $total) $page1right = "<li class='page-item'><a class='page-link' href='".$filename."?page=". ($page + 1) ."".$category."'>". ($page + 1) ."</a></li>";
	
	$current_page = "
				<li class='page-item disabled' >
					<a class='page-link' href='".$filename."?page=" .$total. "".$category."' aria-label='Next page'>
						<span aria-hidden='true'>".$page."</span>
					</a> 
				</li>";
	
	if ($total > 1)
	{ 
		echo "<div class='spacer_3'></div>";
		echo "
			<nav aria-label='Page navigation'>
				<ul class='pagination'>
					".$prevpage.$page3left.$page2left.$page1left.$current_page.$page1right.$page2right.$page3right.$nextpage."
				</ul>
			</nav>
		"; 
	}
	
}
function mres($text)
{
	global $db;
	return mysqli_real_escape_string($db, $text);
}
function checkmail($mail) {
   $mail = trim($mail);
   if (strlen($mail)==0) 
		return 0;
   if (!preg_match("/^[-a-z0-9!#$%&'*+^_`{|}~]+(?:\.[-a-z0-9!#$%&'*+^_`{|}~]+)*@(?:[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(?:aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/is",$mail))
  		return 0;
   return 1;
}
/*
function send_mail_notification($main_text = "", $email = "", $title = "")
{
	$email_from = "utc@mediasoft.com.ua";
	$from_title = "UTC";
	$name_to = "Admin";
	
	
	$text = "
		<!doctype html>
		<html lang='uk'>
			<head>
				<meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
				<meta charset=utf-8>
				<title>".$title."</title>
			</head>
			<body style=' font-family: arial,sans-serif;'>
				".$main_text."
			</body>
		</html>";

	require_once "SendMailSmtpClass.php"; // подключаем класс
	
	
	 
	$mailSMTP = new SendMailSmtpClass($email_from, 's_6DY2v!8;Ps', 'ssl://mail.adm.tools', $from_title, 465); // создаем экземпляр класса
	 
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
	$headers .= "From: ".$from_title." <".$email_from.">\r\n"; // от кого письмо
	$headers .= "To: ".$name_to." <".$email_to.">\r\n"; // от кого письмо

	return $mailSMTP->send($email_to, $title, $text, $headers); // отправляем письмо	

}
*/
function send_mail_notification($main_text = "", $email = "", $title = "")
{
	 	
	$text = "
		<!doctype html>
		<html lang='uk'>
			<head>
				<meta http-equiv='Content-Type' content='text/html charset=UTF-8' />
				<meta charset=utf-8>
				<title>".$title."</title>
			</head>
			<body style=' font-family: arial,sans-serif;'>
				".$main_text."
			</body>
		</html>";

	require_once "SendMailSmtpClass.php"; // подключаем класс
	$from_title = "UTC";
	$name_to = "Admin";
	
	if($email == "")
		$email_to = "webx.ghost@gmail.com";
	else
		$email_to = $email;
	
	
	$mailSMTP = new SendMailSmtpClass('utc@mediasoft.com.ua', 'B4y-(j6UJ4n+', 'ssl://mail.adm.tools', $from_title, 465); // создаем экземпляр класса
	// $mailSMTP = new SendMailSmtpClass('логин', 'пароль', 'хост', 'имя отправителя');
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
	$headers .= "From: ".$from_title." <utc@mediasoft.com.ua>\r\n"; // от кого письмо
	$headers .= "To: ".$name_to." <".$email_to.">\r\n"; // от кого письмо

	return $mailSMTP->send($email_to, $title, $text, $headers); // отправляем письмо	

}
function send_mail($name_from, // ".NAME." отправителя
					$email_from, // email отправителя
					$name_to, // ".NAME." получателя
					$email_to, // email получателя
					$subject, // тема письма
					$body, // текст письма
					$html = TRUE // письмо в виде html или обычного текста
					) 
{
	$data_charset = "utf-8";
	$send_charset = "utf-8";
	$to = mime_header_encode($name_to, $data_charset, $send_charset) . ' <' . $email_to . '>';
	$subject = mime_header_encode($subject, $data_charset, $send_charset);
	$from =  mime_header_encode($name_from, $data_charset, $send_charset) .' <' . $email_from . '>';
	if($data_charset != $send_charset) 
		$body = iconv($data_charset, $send_charset, $body);
	  
	$headers = "From: $from\r\n";
	$type = ($html) ? 'html' : 'plain';
	$headers .= "Content-type: text/$type; charset=$send_charset\r\n";
	$headers .= "Mime-Version: 1.0\r\n";

	return mail($to, $subject, $body, $headers);
}

function mime_header_encode($str, $data_charset, $send_charset) 
{
	if($data_charset != $send_charset)
		$str = iconv($data_charset, $send_charset, $str);
	return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}
function is_auth($check = 0)
{ 
	//print_r($_SESSION);
	if(isset($_SESSION["id"]) && isset($_SESSION["name"]) && isset($_SESSION["login"]) && isset($_SESSION["pass"]))
	{   
		$check = mysqli_query($GLOBALS['db'], "SELECT id, blocked, login, pass FROM site_users WHERE login='".safe_str($_SESSION["login"])."' AND pass='".safe_str($_SESSION["pass"])."' AND id='".intval($_SESSION["id"])."'");
		if($check)
		{ 
			if(mysqli_num_rows($check))
			{ 
				if($user = mysqli_fetch_array($check))
				{  
					if($user["blocked"] == 0)
					{   
						$update = mysqli_query($GLOBALS['db'], "UPDATE site_users SET date_last_action='".date("Y-m-d H:i:s", time())."'  WHERE id='".$user["id"]."'");
						
						return true;
					}
					else	exit_auth();
				}
				else	exit_auth();
			}
			else	exit_auth();
		}
		else	exit_auth();
			  
	}
	else
	{ 
		if(!$check)
		if(SYSTEM_FILENAME != "auth")	
		{
			//Header("Location: /".LANG."/auth");
			//exit();
		}
	} 
	
	return false;
}
function exit_auth()
{ 
	unset($_SESSION["id"]);
	unset($_SESSION["name"]);
	unset($_SESSION["login"]);
	unset($_SESSION["pass"]);
	unset($_SESSION["email"]);
	
	if (isset($_COOKIE['auth_token'])) 
	{ 
		unset($_COOKIE['auth_token']); 
		setcookie('auth_token', null, -1, '/'); 
		 
	}  
	
	//Header("Location: /".LANG."/auth");
	//exit();
}
function read_error($name = "", $del = 1)
{	
	$error = "";
	if(isset($_SESSION["site_error".$name]))
	{
		$error = $_SESSION["site_error".$name];
		if($del)	unset($_SESSION["site_error".$name]);
	}
	return $error;
}
function save_error($str, $name = "")
{
	$_SESSION["site_error".$name] = $str;
}
function is_mail($url)
{
	if(filter_var($url, FILTER_VALIDATE_EMAIL) === FALSE)
		return $url;
	else
		return "<a href='mailto:".$url."'>".$url."</a>";
}
function is_url($url)
{
	
	if(filter_var($url, FILTER_VALIDATE_URL) === FALSE)
	{
		
		$pos = strpos("http://", $url);
		if($pos == false)	$url = "http://".$url;
		
		if(filter_var($url, FILTER_VALIDATE_URL) === FALSE)
			return $url;
		else
			return "<a href='".$url."' target=_blank>".$url."</a>";
	}
	else
		return "<a href='".$url."' target=_blank>".$url."</a>";
}
function writeText($text)
{
	return preg_replace("/\n/", "<br />", $text);
}
function phone_clear($text)
{
	$search = array ("'-'si",  
                 "'\('si",
                 "'\)'si"
	); 

	$replace = array ("", 
                  "",
                  ""
	);
	return $text = preg_replace($search, $replace, $text); 
}
function capcha_check()
{
	if(isset($_POST["capcha"]))	$capcha = safe_capcha($_POST["capcha"]); 	
	if(isset($_SESSION["capcha_text"]))
	{
		if($capcha == $_SESSION["capcha_text"])
		{
			unset($_SESSION["capcha_text"]);
			unset($_SESSION["capcha_img"]);
			return true;
		}
	}
	return false;
}
function safe_capcha($str)
{
	$str = safe_str($str);
	$str = str_replace("o", "0", strtolower(trim($str)));
	$str = str_replace("l", "i", strtolower(trim($str)));
	return $str;
}
function change_capcha_violation()
{
	if(!isset($_SESSION["capcha_violation"]))	$_SESSION["capcha_violation"] = 1;
	else	$_SESSION["capcha_violation"]++;
}
function check_capcha_violation()
{
	if(!isset($_SESSION["capcha_violation"]))	$_SESSION["capcha_violation"] = 0;
	
	if(isset($_SESSION["capcha_violation"]))
	{
		if($_SESSION["capcha_violation"] < 2)	return 0;
	}
	return 1;
}
function check_capcha($force_capcha = 0)
{ 
	if($force_capcha == 0)	if(!check_capcha_violation())	return true;
	
	if(isset($_POST["capcha"]))	
	{
		$capcha = safe_str($_POST["capcha"]); 
		
		 
		if(isset($_SESSION["capcha_text"]))
		{
			if($capcha == $_SESSION["capcha_text"])
			{
				unset($_SESSION["capcha_text"]);
				unset($_SESSION["capcha_img"]);
				return true;
			}
		}
	}
	
	return false;
}
function form_capcha($force_capcha = 0)
{
	if($force_capcha == 0)	if(!check_capcha_violation())	return "";
	
	if(!defined("CAPCHA_WIDTH"))	capcha_init();

	return "<div class='auth_line'>
				<label>".CAPCHA_SYMBOLS_TEXT."</label> 
				<div class='capcha_block'>
					<img src='/capcha' id='capcha_img'>
					<div class='capcha_refresh' onclick='change_capcha()'><img src='/img/refresh.png'></div>
				</div>
				<input type='text' name='capcha' value='' placeholder='' autocomplete='off'>
			</div>"; //".$_SESSION["capcha_text"]."
}
function capcha_init($value = 0)
{
	$result = capcha($value);
	$_SESSION["capcha_text"] = str_replace("o", "0", strtolower($result["string"]));
	$_SESSION["capcha_text"] = str_replace("l", "i", strtolower($result["string"]));
	$_SESSION["capcha_img"]  = base64_decode($result["image"]);
}
function capcha($ajax = 0)
{
	define("CAPCHA_WIDTH", 200);
	define("CAPCHA_HEIGHT", 70);
	define("CAPCHA_PADDING", 0);

	define("RENDER_SIZE", 30);
	define("RENDER_PADDING", 15);

	define("ANGLE_DELTA", 10);
	define("OVERLAP_AMOUNT", 30);

	//COLORS
	define("MIN_COLOR_1", 50);
	define("MIN_COLOR_2", 50);
	define("MIN_COLOR_3", 50);
	
	define("MAX_COLOR_1", MIN_COLOR_1);
	define("MAX_COLOR_2", MIN_COLOR_2);
	define("MAX_COLOR_3", MIN_COLOR_3);
	
	define("ALPHA_COLOR", 0);
	/* // green
		define("MIN_COLOR_1", 0);
		define("MIN_COLOR_2", 90);
		define("MIN_COLOR_3", 0);
		define("MAX_COLOR_1", 0);
		define("MAX_COLOR_2", 90);
		define("MAX_COLOR_3", 0);
		define("ALPHA_COLOR", 0);
	*/
	  
define("FONT_FILE", $_SERVER["DOCUMENT_ROOT"]."/_/fonts/arial.ttf");
	//if($ajax == 0)	define("FONT_FILE", "./modules/fonts/arial.ttf");
	//if($ajax == 1)	define("FONT_FILE", "../fonts/arial.ttf");
	//if($ajax == 0)	define("FONT_FILE", "modules\fonts\arial.ttf");
	//if($ajax == 1)	define("FONT_FILE", "../fonts/arial.ttf");

	define("SYMBOLS_MIN", 5);
	define("SYMBOLS_MAX", 5);
	define("NOISE_MIN", 0);
	define("NOISE_MAX", 0);
	define("NOISE_THICK_MIN", 0);
	define("NOISE_THICK_MAX", 0);

	define("LENS_MIN", 0);//40
	define("LENS_MAX", 0);//70

	define("CAPCHA_LIFETIME", 120);


	$result = array("string" => "");

	$capchaContentWidth = CAPCHA_WIDTH - 2 * CAPCHA_PADDING;
	$capchaContentHeight = CAPCHA_HEIGHT - 2 * CAPCHA_PADDING;

	$capchaImage = imagecreatetruecolor(CAPCHA_WIDTH, CAPCHA_HEIGHT);
	$colorWhite = imagecolorallocate($capchaImage, 255, 255, 255);
	$colorTransparent = imagecolorallocatealpha($capchaImage, 0, 0, 0, 127);
	$charColor = imagecolorallocatealpha($capchaImage, mt_rand(MIN_COLOR_1, MAX_COLOR_1), mt_rand(MIN_COLOR_2, MAX_COLOR_2), mt_rand(MIN_COLOR_3, MAX_COLOR_3), ALPHA_COLOR);
	imagefill($capchaImage, 0, 0, $colorWhite);

	$linesCount = mt_rand(NOISE_MIN, NOISE_MAX);
	for($i = 0; $i < $linesCount; $i++)
	{
		$lineCoords = array(mt_rand(0, CAPCHA_WIDTH), mt_rand(0, CAPCHA_HEIGHT), mt_rand(0, CAPCHA_WIDTH), mt_rand(0, CAPCHA_HEIGHT));
		imagesetthickness($capchaImage, mt_rand(NOISE_THICK_MIN, NOISE_THICK_MAX));
		imageline($capchaImage, $lineCoords[0], $lineCoords[1], $lineCoords[2], $lineCoords[3], $charColor);
	}

	$symbolsCount = mt_rand(SYMBOLS_MIN, SYMBOLS_MAX);
	$symbolWidth = ($capchaContentWidth - OVERLAP_AMOUNT) / $symbolsCount + OVERLAP_AMOUNT;
	$symbolHeight = $capchaContentHeight;
	$xOffset = CAPCHA_PADDING;
	
	//$alphabet = "";
	for($i = 97; $i < 123; $i++)
	{
		if(($i != 105) && ($i != 108) && ($i != 111))
			$alphabet[] = $i;
	}
	
	
	for($i = 1; $i <= $symbolsCount; $i++)
	{
		//$char = chr(mt_rand(97, 122));
		$char = chr($alphabet[array_rand($alphabet, 1)]);
		/*
		$case = mt_rand(0, 2);
		if($case == 0)
			$char = mt_rand(0, 9);
		elseif($case == 1)
			$char = chr(mt_rand(65, 90));
		else
			$char = chr(mt_rand(97, 122));
		*/
		$result["string"] .= $char;
		
		$charAngle = mt_rand(-ANGLE_DELTA, ANGLE_DELTA);
		$boxSize = imagettfbbox(RENDER_SIZE, 0, FONT_FILE, $char);
		$charImageWidth = $boxSize[2] - $boxSize[0] + 2 * RENDER_PADDING;
		$charImageHeight = $boxSize[1] - $boxSize[5] + 2.5 * RENDER_PADDING;
		$charImage = imagecreatetruecolor($charImageWidth, $charImageHeight);
		imagefill($charImage, 0, 0, $colorTransparent);
		imagettftext($charImage, RENDER_SIZE, 0, -$boxSize[0] + RENDER_PADDING, -$boxSize[5] + RENDER_PADDING, $charColor, FONT_FILE, $char);
		$charImage = imagerotate($charImage, $charAngle, $colorTransparent);
		imagecopyresized($capchaImage, $charImage, $xOffset, (CAPCHA_HEIGHT - $charImageHeight) / 2, 0, 0, $symbolWidth, $symbolHeight, imagesx($charImage), imagesy($charImage));
		imagedestroy($charImage);
		$xOffset += $symbolWidth - OVERLAP_AMOUNT;
	}
	$capchaImage = applyLens($capchaImage, mt_rand(CAPCHA_PADDING, CAPCHA_WIDTH - CAPCHA_PADDING), mt_rand(CAPCHA_PADDING, CAPCHA_HEIGHT - CAPCHA_PADDING), mt_rand(LENS_MIN, LENS_MAX));
	imagefilter($capchaImage, IMG_FILTER_GAUSSIAN_BLUR);

	ob_start();
	imagepng($capchaImage, null, 9);
	imagedestroy($capchaImage);
	$result["image"] = base64_encode(ob_get_contents());
	ob_end_clean();
	//print(json_encode($result));
	return $result;
}
 
function applyLens(&$image, $px, $py, $psize, $convex = true)
{
	$width = imagesx($image);
	$height = imagesy($image);
	$newImage = imagecreatetruecolor($width, $height);
	for($x = 0; $x < $width; $x++)
		for($y = 0; $y < $height; $y++)
		{
			$xx = $x;
			$yy = $y;
			$dx = $x - $px;
			$dy = $y - $py;
			$distance = sqrt($dx * $dx + $dy * $dy);
			if($distance < $psize)
			{
				$a = atan2($dy, $dx);
				if($convex)
					$k = sin(($psize - $distance) / $psize) + 1;
				else
					$k = cos(($psize - $distance) / $psize);
				$xx = $px + cos($a) * $distance / $k;
				$yy = $py + sin($a) * $distance / $k;
			}
			imagesetpixel($newImage, $x, $y, imagecolorat($image, $xx, $yy));
		}
	return $newImage;
}
function calc_statistic()
{
	global $db;
	$unique["count"] = 0;
	$all["count"] = 0;
	
	$contents = mysqli_query($db, "SELECT module, module_id, date FROM statistic_tmp WHERE date='".date("Y-m-d 00:00:00", (time() - 60*60*24))."' GROUP BY module, module_id"); // - 60*60*24
	if($contents)
	if(mysqli_num_rows($contents))
	while($content = mysqli_fetch_array($contents))
	{
		$all_sql = mysqli_query($db, "SELECT COUNT(*) AS count FROM statistic_tmp WHERE module='".$content["module"]."' AND module_id='".$content["module_id"]."'");
		$all = mysqli_fetch_array($all_sql);

		$unique_sql = mysqli_query($db, "SELECT COUNT(DISTINCT user_id) AS count  FROM statistic_tmp WHERE module='".$content["module"]."' AND module_id='".$content["module_id"]."'");
		$unique = mysqli_fetch_array($unique_sql);

		if(($unique["count"] != 0) && ($all["count"] != 0))
		{
			$insert = mysqli_query($db, "INSERT INTO statistic SET module='".$content["module"]."', module_id='".$content["module_id"]."', date='".$content["date"]."', `unique`='".$unique["count"]."', `all`='".$all["count"]."'");
			$delete = mysqli_query($db, "DELETE FROM statistic_tmp WHERE date='".date("Y-m-d 00:00:00", (time() - 60*60*24))."' AND module='".$content["module"]."' AND module_id='".$content["module_id"]."'");
		}
	}
}
function log_statistic($system_page)
{
	global $db;
	if(isset($_SERVER["HTTP_X_REAL_IP"]))	$ip = safe_str($_SERVER["HTTP_X_REAL_IP"]);	else	$ip = safe_str($_SERVER["REMOTE_ADDR"]);
	$user_id = md5($ip.safe_str($_SERVER["HTTP_USER_AGENT"]));

	$module_id = 0;
	if($system_page == "index")
	{
		$module = "p";
		$module_id = 1;
	}
	if($system_page == "pages")
	{
		$module = "p";
		$module_id = intval($_GET["id"]);
	}
	if(($system_page == "news") || ($system_page == "galleries") || ($system_page == "lib"))
	{	
		if(isset($_GET["id"]))
		{
			$module = safe_str(mb_substr($system_page, 0, 1, "utf-8"));
			$module_id = intval($_GET["id"]);
		}
		else
		{
			$module = "p";
			$module_id = intval($_GET["category"]);
		}
	}
	if(($system_page == "sitemap") || ($system_page == "search") || ($system_page == "abit_form") || ($system_page == "404"))
	{
		$pages = mysqli_query($db, "SELECT id FROM pages WHERE page='".$system_page."' ");
		if($pages)	
		if(mysqli_num_rows($pages))	
		if(($page = mysqli_fetch_array($pages)))	
		$module_id = intval($page["id"]);
		
		$module = "p";
	}
	
	if($module_id > 0)
		$insert = mysqli_query($db, "INSERT INTO statistic_tmp SET module='".$module."', module_id='".$module_id."', date='".date("Y-m-d 00:00:00", (time()))."', user_id='".$user_id."'");
}
function page404($str = "")
{
	//echo $str;
	writeLog();
	redirect("/".LANG."/404");
}
function writeLog($act = 0)
{
	global $db;
	if(!isset($_SESSION["banAttempt"]))	$_SESSION["banAttempt"] = 0;
	$_SESSION["banAttempt"]++;
	
	// LOGS
	mysqli_query($db, "INSERT INTO logs SET 
					date='".date("Y-m-d H:i:s", time())."',
					ip='".safe_str($_SERVER["REMOTE_ADDR"])."',
					type='".$act."',
					host='".safe_str($_SESSION["hostname"])."', 
					useragent='".safe_str($_SERVER["HTTP_USER_AGENT"])."',
					request='http://".safe_str($_SERVER["SERVER_NAME"]).safe_str($_SERVER["REQUEST_URI"])."'
					");
	
	// LOGS COUNT
		mysqli_query($db, "REPLACE INTO logs_counts (ip, date, host, useragent, attempt) 
									VALUES ('".safe_str($_SERVER["REMOTE_ADDR"])."', 
											'".date("Y-m-d H:i:s", time())."', 
											'".safe_str($_SESSION["hostname"])."', 
											'".safe_str($_SERVER["HTTP_USER_AGENT"])."',
											".intval($_SESSION["banAttempt"] + 1)."
											)");
	
}
class SMS{

  public static $sender='UtcShop';
  public static $login='utcakpp';
  public static $pwd='gerh78453yj9u8hrt';  
 // public static $login='kafo';
  //public static $pwd='CfkjyRfaj2012!';    
 
  public static function send($r,$m,$d=false){
    
			$client = new SoapClient ('http://turbosms.in.ua/api/wsdl.html'); 
			$auth = array( 
				'login' => SMS::$login, 
		        'password' => SMS::$pwd 
        	); 
        	$res=$client->Auth($auth);
			 $res->AuthResult ; 
			 $result = $client->GetCreditBalance();   
			
        	$sms = array( 
        		'sender' => SMS::$sender, 
        		'destination' => $r, 
		        'text' => $m
        	);
        	$res=$client->SendSMS($sms); 
    
  }
}
/*
function send_sms($sms_text = "", $phone_to = PHONE_TO)
{
	$login='utcakpp';
	$pwd='gerh78453yj9u8hrt'; 
	$client = new SoapClient ('http://turbosms.in.ua/api/wsdl.html'); 
	$auth = array( 
		'login' => SMS::$login, 
		'password' => SMS::$pwd 
	); 
	$res=$client->Auth($auth);
	$res->AuthResult ; 
	$result = $client->GetCreditBalance();   
	
	$sms = array( 
		'sender' => 'UtcShop', 
		'destination' => $phone_to, 
		'text' => $sms_text
	);
	$res=$client->SendSMS($sms); 
	
	//SMS::send($phone_to, $sms_text);
}
*/

function happy_new_year()
{
	echo "
	<link rel='stylesheet' href='/new_year/style.css'>
    <script type='text/javascript' src='/new_year/swfobject.min.js'></script>
    <script type='text/javascript' src='/new_year/newyear.js'></script>
	
	 <!-- новогодняя мотня newyear.html -->
	<div class='b-page_newyear debug' style='z-index: 100000;'>
		<div class='b-page__content'>

			<i class='b-head-decor'>
				<i class='b-head-decor__inner b-head-decor__inner_n1'>
					<div class='b-ball b-ball_n1 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n2 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n3 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n4 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n5 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n6 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n7 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_n8 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n9 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i1'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i2'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i3'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i4'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i5'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i6'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
				</i>

				<i class='b-head-decor__inner b-head-decor__inner_n2'>
					<div class='b-ball b-ball_n1 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n2 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n3 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n4 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n5 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n6 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n7 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n8 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_n9 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i1'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i2'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i3'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i4'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i5'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i6'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
				</i>
				<i class='b-head-decor__inner b-head-decor__inner_n3'>

					<div class='b-ball b-ball_n1 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n2 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n3 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n4 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n5 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n6 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n7 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n8 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n9 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_i1'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i2'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i3'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i4'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i5'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i6'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
				</i>
				<i class='b-head-decor__inner b-head-decor__inner_n4'>
					<div class='b-ball b-ball_n1 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_n2 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n3 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n4 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n5 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n6 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n7 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n8 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n9 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i1'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_i2'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i3'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i4'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i5'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i6'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
				</i>
				<i class='b-head-decor__inner b-head-decor__inner_n5'>
					<div class='b-ball b-ball_n1 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n2 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_n3 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n4 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n5 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n6 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n7 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n8 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n9 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i1'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i2'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_i3'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i4'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i5'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i6'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
				</i>
				<i class='b-head-decor__inner b-head-decor__inner_n6'>
					<div class='b-ball b-ball_n1 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n2 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n3 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_n4 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n5 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n6 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n7 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n8 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n9 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i1'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i2'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i3'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_i4'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i5'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i6'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
				</i>
				<i class='b-head-decor__inner b-head-decor__inner_n7'>
					<div class='b-ball b-ball_n1 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n2 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n3 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n4 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_n5 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n6 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n7 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n8 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_n9 b-ball_bounce'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i1'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i2'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i3'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i4'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>

					<div class='b-ball b-ball_i5'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
					<div class='b-ball b-ball_i6'><div class='b-ball__right'></div><div class='b-ball__i'></div></div>
				</i>
			</i>
	</div>
	</div>

	";
}  
?>