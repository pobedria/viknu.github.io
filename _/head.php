<?
if(!isset($page["rel"]))	$page["rel"] = 0;
if(!isset($page["meta_d"]))	$page["meta_d"] = "";
if(!isset($page["meta_k"]))	$page["meta_k"] = "";




echo "<!doctype html>
<html lang='";	if(LANG == "ua")	echo "uk";	else	echo LANG; 	echo "'>
	<head>
		<meta charset=utf-8>
		<title>";
			if(isset($page["seotitle"]))
			{
				if($page["seotitle"] != "")		echo $page["seotitle"];
				else
					echo $page["title"];
			}
			else
				echo $page["title"];
		echo " ";  
			if(SYSTEM_FILENAME != "index") echo " :: ".SITE_TITLE."";
			
		echo "</title>
		<meta name='description' content=\"".$page["meta_d"]."\"> 
		<meta name='keywords' content=\"".$page["meta_k"]."\"> ";
		if(isset($system_page))
		if($system_page == "news")
		{
			echo "<link rel='image_src' href=\"".get_img("news", intval($_GET["id"]), "meta")."\" />";
		}
		echo "
			<link rel='shortcut icon' href='/img/favicon.ico' type='image/x-icon'>
			<meta name='viewport' content='width=device-width, initial-scale=1.0 ";   echo " , maximum-scale=1.0"; echo "'>
			<meta http-equiv='cache-control' content='no-store' />
			<meta http-equiv='cache-control' content='no-cache' />
			<meta http-equiv='cache-control' content='no-store' /> 
			<meta name='theme-color' content='#'> 
		";
 
		// CSS
		echo "   
		<link rel='stylesheet' href='/css_bootstrap' type='text/css' media='all' />
		<link rel='stylesheet' href='/css_fancybox?".time()."' >
		<link rel='stylesheet' href='/css_owl?".time()."' type='text/css' media='all' /> 
		<link rel='stylesheet' href='/css_fonts?".time()."' type='text/css' media='all' />
		<link rel='stylesheet' href='/css_style?".time()."' type='text/css' media='all' />
		"; 
		// JQUERY
		echo "<script type='text/javascript' src='/js_jquery'></script>";
		// BOOTSTRAP
		echo "<script type='text/javascript' src='/js_bootstrap'></script>";
		// FANCY BOX
		echo "<script type='text/javascript' src='/js_fancybox'></script>";
		// OWL
		echo "<script type='text/javascript' src='/js_owl_carousel'></script>"; 
		 
		// MASK INPUT
		echo "<script type='text/javascript' src='/js_maskinput'></script>"; 
		echo "<script>
				$(function(){
				  $('.reg_phone').mask('+38(999)999-99-99');
				});
				$(function(){
				  $('.reg_code').mask('99-99');
				});
				</script>"; 
		// LIB
		echo "<script type='text/javascript' src='/js_lib?".time()."'></script>";
		
		// ANALYTICS
		echo "
			<script async src='https://www.googletagmanager.com/gtag/js?id=G-74E2N2D1TG'></script>
			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());

			  gtag('config', 'G-74E2N2D1TG');
			</script>
		";  
		//SNOW
		/*
		echo "<script type='text/javascript' src='/_/js/snowfall.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){
					$(document).snowfall({
						flakeCount: 60,
						minSize: 2, 
						maxSize: 5,
						round: true,
						shadow: false,
					});
				});
			</script>";
			*/
	//	echo "<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=596dd7a431b8b90012c6a9fe&product=inline-share-buttons'></script>";
		 
	echo "</head>";
	
	echo "<body style='width: 100%;    '  onload='  '>"; //overflow-x: hidden;
 
//happy_new_year();
	 
	echo "
		<div class='screen_size' style='position:fixed; z-index:1; opacity:0.7; display:none   !important;'>
			<div class='d-block d-sm-none'>XS</div>
			<div class='d-none d-sm-block d-md-none'>SM</div>
			<div class='d-none d-md-block d-lg-none'>MD</div>
			<div class='d-none d-lg-block d-xl-none'>LG</div>
			<div class='d-none d-xl-block d-xxl-none'>XL</div>
			<div class='d-none d-xxl-block'>XXL</div>
		</div>";
 		
		
	echo "
		<div class='pre_head'>
		<div class='page'>
			<div class='row'>
						<div class='col-12 col-sm-12 col-md-9 col-lg-9 col-xl-7   d-none d-md-block'  >
							
							<span style='color:#F5922F; font-weight:700;font-size: 13px;'>Приймальна комісія:</span>&nbsp;
							 Денне навчання <a href='tel:+380501456276'>(050)145-62-76</a>&nbsp;<a href='tel:+380932577037'>(093)257-70-37</a> | 
							 Військова кафедра <a href='tel:+380445213557'>(044)521-35-57</a>
							
						 
				";

/*
	<a href='https://adl.mil.gov.ua/course/index.php?categoryid=2972' target=_blank>Moodle (Центральний)</a>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href='https://eduviknu.mil.gov.ua/' target=_blank>Moodle (ВІКНУ)</a>


						echo "<div class='row'>";
				echo "<div class='col-lg-6 center'>";
					echo "Приймальна комісія щодо вступу на денну форму навчання:<br>";
				echo "</div>";
				echo "<div class='col-lg-6 center'>";
					echo "Приймальна комісія щодо вступу на військову кафедру:<br><a href='tel:+30445213557' style='font-weight:700; font-size:18px;'>(044)521-35-57</a>";
				echo "</div>";
			echo "</div>";
			*/

			echo "
						<!-- 
							<a href='tel:".PHONE_TO."'>".PHONE_TO."</a>
							<div class='d-none d-lg-inline  '>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".ADRESS_TO."
							</div> 
						-->
							
							
							<div class='d-none d-lg-inline-block d-xl-none'>
								<div class='pre_head_radio d-inline'>
									<a href='https://www.armyfm.com.ua' class='no_bg' target='_blank' >
										<svg class='navigation-social' viewBox='0 0 17 17' width='17' height='17' aria-hidden='true'>
											<use xlink:href='/img/socials.svg#radio'></use>
										</svg> ".ARMY_FM."
									</a>  
								</div>
								<div class='pre_head_universant d-inline  ' >
									<a href='https://mil.knu.ua/ua/lib/33' class='no_bg' target='_blank' > 
										<svg class='navigation-social' viewBox='0 0 17 17' width='17' height='17' aria-hidden='true'>
											<use xlink:href='/img/socials.svg#newspaper'></use>
										</svg> ".UNIVERSANT." 
									</a> 
								</div>
							</div>  
							
							
						</div>  
					 
						
						
						<div class='pre_head_social  col-sm-4 col-md-3 col-lg-3 col-xl-5 '>"; //d-none d-sm-block
						echo "
							<div class=' d-none  d-xl-inline pre_head_links'  >
								<div class='pre_head_radio d-inline'>
									<a href='https://www.armyfm.com.ua' class='no_bg' target='_blank' >
										<svg class='navigation-social' viewBox='0 0 17 17' width='17' height='17' aria-hidden='true'>
											<use xlink:href='/img/socials.svg#radio'></use>
										</svg> ".ARMY_FM."
									</a>  
								</div>
								<div class='pre_head_universant d-inline  ' >
									<a href='https://mil.knu.ua/ua/lib/33' class='no_bg' target='_blank' > 
										<svg class='navigation-social' viewBox='0 0 17 17' width='17' height='17' aria-hidden='true'>
											<use xlink:href='/img/socials.svg#newspaper'></use>
										</svg> ".UNIVERSANT." 
									</a> 
								</div>
							</div>
						";
							if(SOCIAL_TK_LINK != "")
							{
								echo "<a href='".SOCIAL_TK_LINK."' class='no_bg' target='_blank' aria-label='TikTok'>
									<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
										<use xlink:href='/img/socials.svg?1#tiktok2'></use>
									</svg>
								</a>";
							}
							if(SOCIAL_FB_LINK != "")
							{
								echo "<a href='".SOCIAL_FB_LINK."' class='no_bg' target='_blank' aria-label='Facebook'>
									<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
										<use xlink:href='/img/socials.svg?1#facebook'></use>
									</svg>
								</a>";
							}
							if(SOCIAL_IN_LINK != "")
							{
								echo "<a href='".SOCIAL_IN_LINK."' class='no_bg' target='_blank' aria-label='Instagram'>
									<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
										<use xlink:href='/img/socials.svg?1#instagram2'></use>
									</svg>
								</a>";
							}
							if(SOCIAL_TEL_LINK != "")	
							{															
								echo "<a href='".SOCIAL_TEL_LINK."' class='no_bg' target='_blank' aria-label='Telegram'>
									<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
										<use xlink:href='/img/socials.svg?1#telegram'></use>
									</svg>
								</a> ";
							}															
							if(SOCIAL_YT_LINK != "")
							{
								echo "<a href='".SOCIAL_YT_LINK."' class='no_bg' target='_blank' aria-label='YouTube'>
									<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
										<use xlink:href='/img/socials.svg#youtube'></use>
									</svg>
								</a> ";
							}
						echo "
						</div>
						<!--
						<div class='pre_head_langs col-5  col-sm-4 col-md-3 col-lg-1 col-xl-1'>
							<a href='".change_lang("ua")."'>UKR</a>
							<span>|</span>
							<a href='".change_lang("en")."'>ENG</a>
						</div>
						-->
					 
				</div>
			</div>
		</div>
		</div>
		
		<div class='head'>
			<div class='page'> 
				<div class='menu'>
				

					<div class='mobile_menu_button d-block d-lg-none'>
						<div class='' id='navtoggler' onclick='fancy(\"mob_menu\")' >
							<div class='fancy_fullscreen' id='mob_menu' style='display:none;  width:100%; height:; margin-top:0px;'>
							<div style='overflow-y:scroll;'>
									<div class='mobile_menu_logo'><img src='/img/logo.png?2' ></div>
									<div class='spacer'></div>
									
									<div class='mobile_menu_social'>";
										if(SOCIAL_FB_LINK != "")
										{
											echo "<a href='".SOCIAL_FB_LINK."' class='no_bg' target='_blank' aria-label='Facebook'>
												<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
													<use xlink:href='/img/socials.svg#facebook'></use>
												</svg>
											</a>";
										}
										if(SOCIAL_IN_LINK != "")
										{
											echo "<a href='".SOCIAL_IN_LINK."' class='no_bg' target='_blank' aria-label='Instagram'>
												<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
													<use xlink:href='/img/socials.svg#instagram'></use>
												</svg>
											</a>";
										}
										if(SOCIAL_TEL_LINK != "")	
										{															
											echo "<a href='".SOCIAL_TEL_LINK."' class='no_bg' target='_blank' aria-label='Telegram'>
												<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
													<use xlink:href='/img/socials.svg#telegram'></use>
												</svg>
											</a> ";
										}															
										if(SOCIAL_YT_LINK != "")
										{
											echo "<a href='".SOCIAL_YT_LINK."' class='no_bg' target='_blank' aria-label='YouTube'>
												<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
													<use xlink:href='/img/socials.svg#youtube'></use>
												</svg>
											</a> ";
										}
									echo "
									</div>
									<div class='spacer'></div>
									<div class='page_hr'></div> 
									<div class='spacer'></div>
									<div class='spacer'></div> 
									<div class='  '>
										".PHONE.": <a href='tel:".PHONE_TO."'>".PHONE_TO."</a>
									</div> 
									<div class='spacer'></div> 
									<div class='  '>
										".ADRESS.": ".ADRESS_TO."
									</div> 
									
									
									<div class='spacer'></div> 
									<div class='page_hr'></div>
									<div class='spacer'></div> 
									".create_menu("mobile"); 
									echo "
									<div class='spacer'></div> 
									<div class='page_hr'></div>
									<div class='spacer'></div> 
									<div class='spacer'></div> 
									<div class='slider_button' onclick='window.open(\"https://mil.knu.ua/ua/pages/138\", \"_blank\").focus();'>
										".NOTIFY_CORRUPTION."
									</div>
							</div>
							</div>
						</div>
					</div>
					
					
					<div class='menu_logo'>
						<a href='/".LANG."/'><img src='/img/logo.png?2'></a>
					</div>
					
					<div class='menu_content d-none d-lg-inline-block'>
						".create_menu()."
					</div>
					
					
					<div class='menu_other'>
						<div class='head_search_holder'>
							<div class='head_search'>
								<a href='javascript:;' id='search_btn' onclick='if( $(\"#search_query\").val() != \"\" )	$(\"#search_form\").submit();	else	{ $(\"#search_form\").css(\"width\", \"auto\");		$(\"#search_query\").focus(); } 	' class='no_bg'  aria-label='Search'>
									<svg class='navigation-social'  viewBox='0 0 32 32' width='32' height='32' aria-hidden='true'>
										<use xlink:href='/img/socials.svg#search'></use>
									</svg>
								</a>
								
								<form class='head_search_form' id='search_form' mathod='get' name='search_form' action='/ua/search' style=' width:0px;  '>
									<input type='text' name='search_query' id='search_query' autocomplete='off'> 
								</form>
								
								
							</div> 
						</div> 
							 
						<div class='menu_corruption_btn d-none d-lg-none d-xl-inline-block'  onclick='window.open(\"https://mil.knu.ua/ua/pages/138\", \"_blank\").focus();'>
							".NOTIFY_CORRUPTION."
						</div>
					</div>
				</div> 
			</div>
		</div>
	";	 

if(SYSTEM_FILENAME == "index")	echo get_marque();
	

?>	
