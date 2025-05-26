<? 
echo "<div class='clear'></div>";
	
	if(SYSTEM_FILENAME != "index")	echo "<div class='spacer_5 hidden-xs'></div>";
	  
	  
	  
	  echo "<div class='footer_bg'  id='contacts'  >
				<div class='page'>
					
					<div class='spacer_5 d-none d-md-block'></div> 
					<div class='spacer_3 d-block d-md-none'></div> 
				<div class='row' style=''>
					<div class='col-lg-3 col-md-3  ' style=''>
						<div class='row'>
							<div class='col-sm-6 col-md-8'>
								<a href='/".LANG."/' class='' style='float:left; '><img class='footer_logo' src='/img/logo.png?2'  ></a>
								  
								<div class='clear'></div>  
								<div class='spacer_3 '></div> 
								";
							
								if(SOCIAL_TK_LINK != "-")
									echo "
									<a style='margin:0px 15px 0px 0px; display:inline;' href='".SOCIAL_TK_LINK."' class='no_bg' target='_blank' aria-label='TikTok'>
										<svg class='navigation-social' viewBox='0 0 24 24' width='24' height='24' aria-hidden='true'>
											<use xlink:href='/img/socials.svg?7#tiktok2'></use>
										</svg>
									</a>";
								if(SOCIAL_FB_LINK != "-")
									echo "
									<a style='margin:0px 15px 0px 0px; display:inline;' href='".SOCIAL_FB_LINK."' class='no_bg' target='_blank' aria-label='Facebook'>
										<svg class='navigation-social' viewBox='0 0 24 24' width='24' height='24' aria-hidden='true'>
											<use xlink:href='/img/socials.svg?1#facebook'></use>
										</svg>
									</a>";
								if(SOCIAL_IN_LINK != "-")
									echo "
									<a style='margin:0px 15px 0px 0px; display:inline;' href='".SOCIAL_IN_LINK."' class='no_bg' target='_blank' aria-label='Instagram'>
										<svg class='navigation-social' viewBox='0 0 24 24' width='24' height='24' aria-hidden='true'>
											<use xlink:href='/img/socials.svg?1#instagram2'></use>
										</svg>
									</a>";
								if(SOCIAL_YT_LINK != "-")
									echo "
									<a style='display:inline;' href='".SOCIAL_YT_LINK."' class='no_bg' target='_blank' aria-label='Youtube'>
										<svg class='navigation-social' viewBox='0 0 24 24' width='24' height='24' aria-hidden='true'>
											<use xlink:href='/img/socials.svg?1#youtube'></use>
										</svg>
									</a>";
									 
									 
								echo "
								<div class='spacer_3 '></div> 
							</div>
							 
							  
							<div class='col-sm-6 d-block d-md-none'>
								".create_menu("footer", 0, 5)."
							</div>
						 
						
							<div class='spacer_3  d-block d-sm-block d-md-none d-lg-block'></div>   
							<div class='footer_rights'>
								© ".date("Y", time())." ".FOOTER_TEXT."
							</div>
							
							<div class='spacer'></div> 
							<div class='spacer'></div>  
						</div>
					</div>";
					
					/*
					".create_menu("footer", 0, 1)."
					".create_menu("footer", 1, 1)."
					".create_menu("footer", 2, 1)."
					
					".create_menu("footer", 3, 1)."
					".create_menu("footer", 4, 1)."
					".create_menu("footer", 5, 1)."
					
					".create_menu("footer", 6, 1)."
					".create_menu("footer", 7, 1)."
					".create_menu("footer", 8, 1)."
					*/
			if(LANG == "ua")
			{
					echo "
					<div class='col-lg-9 col-md-9 d-none d-md-block' style=''>
						<div class='row' style=''>
							<div class='col-lg-4 col-md-4 col-sm-4 hidden-xs' style=''>
								<a href='/".LANG."/' class='footer_menu_title'>Головна</a>
								<div class='spacer'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/126-pro-institut'>Завдання інституту</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/pages/134'>Спеціальності</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='/".LANG."/abit/".date("Y", time())."'>Правила прийому</a></div>
								
								
								<div class='clear'></div>
								<div class='spacer_3'></div>
								<a href='/".LANG."/128-osvita' class='footer_menu_title'>Освіта</a>
								<div class='spacer'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/15-navchalna-robota'>Навчальна робота</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/19-vihovna-robota'>Виховна робота</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/20-gromadski-organizacii'>Громадські організації</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/108-biblioteka'>Бібліотека інституту</a></div>
								 	
								 
									
								
							</div>
							<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''>
								
								<a href='/".LANG."/126-pro-institut' class='footer_menu_title'>Про інститут</a>
								<div class='spacer'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/127-struktura'>Структура</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/7-mizhnarodne-spivrobitnictvo-v-voenniy-ta-naukoviy-sferi'>Міжнародне співробітництво</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/74-derzhavna-zakupivlya'>Державна закупівля </a></div>
									
									<div class='spacer'></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/140-fakulteti-institutu'>Факультети інституту:</a></div>
									<div class='footer_menu'> 
										<ul>
											<li class='footer_menu_li'><a href='https://mil.knu.ua/ua/10-viyskoviy-fakultet-socialnih-ta-povedinkovih-nauk'>Військовий факультет соціальних та поведінкових наук</a></li>
											<li class='footer_menu_li'><a href='https://mil.knu.ua/ua/99-viyskoviy-fakultet-mizhnarodnih-vidnosin-ta-prava'>Військовий факультет міжнародних відносин та права</a></li>
											<li class='footer_menu_li'><a href='https://mil.knu.ua/ua/11-viyskoviy-fakultet-sil-pidtrimki-ta--zabezpechennya'>Військовий факультет сил підтримки та забезпечення</a></li>
											<li class='footer_menu_li'><a href='https://mil.knu.ua/ua/12-fakultet-pislyadiplomnoi-osviti'>Факультет післядипломної освіти</a></li>
										</ul>
									</div>
							</div>
							<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''>
								
								<a href='/".LANG."/129-nauka' class='footer_menu_title'>Наука</a>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/21-naukova-robota'>Наукова робота</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/14-naukovo-doslidniy-centr'>Науково-дослідницький центр</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/94-ad%E2%80%99yunktura'>Адʼюнктура</a></div>
									<div class='spacer_half'></div>
									<div class='footer_menu'><a href='https://mil.knu.ua/ua/86-granti-premii-stipendii'>Гранти, премії, стипендії</a></div>
								
								
								<div class='clear'></div>
								<div class='spacer_3'></div> 
								<a href='/".LANG."/news/130' class='footer_menu_title'>Новини</a>
								<div class='spacer'></div>
								<div class='spacer'></div>
								<a href='/".LANG."/143-vstupniku' class='footer_menu_title'>Вступнику</a>
								<div class='spacer'></div>
								<div class='spacer'></div>
								<div class='spacer'></div>
								<div style='color:#a0a0a0;'>Телефон гарячої лінії ВІКНУ</div>
								<div class='footer_menu'><a href='tel:+380932839394'>+38(093)283-93-94</a></div>
							</div>
						</div>
						 
					</div>";
			}
			else
			{
				echo "
				<div class='col-lg-9 col-md-9 d-none d-md-block' style=''>
					<div class='row' style=''>
						<div class='col-lg-4 col-md-4 col-sm-4 hidden-xs' style=''>
							".create_menu("footer", 0, 1)."
						</div>
						<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''>
							".create_menu("footer", 1, 1)."
						</div>
						<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''>
							".create_menu("footer", 2, 1)."
						</div>
					</div>
					
					<div class='clear'></div>
					<div class='spacer_3'></div>
					<div class='row' style=''>
						<div class='col-lg-4 col-md-4 col-sm-4 hidden-xs' style=''>
							".create_menu("footer", 3, 1)."
						</div>
						<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''>
							".create_menu("footer", 4, 1)."
						</div>
						<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''> 
							".create_menu("footer", 5, 1)."
						</div> 
					</div> 
					<div class='clear'></div>
					<div class='spacer_3'></div>
					<div class='row' style=''>
						<div class='col-lg-4 col-md-4 col-sm-4 hidden-xs' style=''>
							".create_menu("footer", 6, 1)."
						</div>
						<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''>
							".create_menu("footer", 7, 1)."
						</div>
						<div class='col-lg-4 col-md-4 col-sm-4  hidden-xs ' style=''> 
							".create_menu("footer", 8, 1)."
						</div> 
					</div> 
				</div> 
				";
			}
					
					
					
					echo "
					
					<div class='clear'></div>
					<div class='spacer'></div>
					<div class='footer_hr'></div> 
					<div class='center'> </div>
					<div class='spacer_3'></div> 
					 
				</div>
			</div>";
	 
	echo "
		<script> 
			$('.popup').fancybox({
				 
			});
		</script>
		</body>
	</html>";

/* UTC FOOTER
if(SYSTEM_FILENAME != "index") 
	echo "
		<div class='d-none d-lg-block callback callback_fixed' onclick='fancy(\"callback\");'>	
			<div class='callback_holder'>
				
				<div  class='popup__toggle'>
					<div class='circlephone' style='transform-origin: center;'></div>
					<div class='circle-fill' style='transform-origin: center;'></div>
					<div class='img-circle' style='transform-origin: center;'>
						<div class='img-circleblock' style='transform-origin: center;'></div>
					</div>
				</div>	
				<div class='callback_text d-none d-lg-block'>".ASK_QUESTION."</div>
			</div>	
		</div>	
		"; 
		
		
echo "
		<div class='spacer_5'></div> 
	</div>
	</div>
	</div> 
	</div> 
							
							<div class='footer' style='overflow:hidden;' >
							<div style='"; if(SYSTEM_FILENAME != "index") echo ""; echo "' >
								<div class='row'>
									<div class='col-sm-5 xs_menu_padding_0' style='overflow:hidden;'>
										<iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2379.1308850782957!2d30.49139995366394!3d50.48082063624678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cde2312956bf%3A0xacf1fe8e9dca0985!2sUkrainian%20Transmission%20Centre!5e0!3m2!1sru!2sua!4v1656679587235!5m2!1sru!2sua'  style='border:0; max-width:100%; width:100%; padding:0px; margin:0px; height:430px;' allowfullscreen='' loading='lazy' ></iframe>
									</div>
									<div class='col-sm-7  '>
										<div class='container-fluid'>
											<div class='spacer_2'></div> 
											<div class='footer_logo'>
												<img src='/img/logo_w.png'>
											</div>
											<div class='spacer'></div> 
											<div class='spacer_half'></div> 
											<div class='footer_pre_title'>
												".INTERNET_SHOP_PARTS."
											</div>
											<div class='footer_title'>
												".FOR_AKPP."
											</div>
											
											<div class='spacer_3'></div> 
											<div class='footer_text'>
												".SOCIAL_NETWORKS.": &nbsp;
												<a href='".SOCIAL_FB_LINK."' class='no_bg' target='_blank' aria-label='Facebook'>
													<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
														<use xlink:href='/img/socials.svg#facebook'></use>
													</svg>
												</a>";
												
												if(SOCIAL_IN_LINK != "")
												{
													echo "
													<a href='".SOCIAL_IN_LINK."' class='no_bg' target='_blank' aria-label='Instagram'>
														<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
															<use xlink:href='/img/socials.svg#instagram'></use>
														</svg>
													</a>";
												}
												if(SOCIAL_TEL_LINK != "")
												{
													echo "
													<a href='".SOCIAL_TEL_LINK."' class='no_bg' target='_blank' aria-label='Telegram'>
														<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
															<use xlink:href='/img/socials.svg#telegram'></use>
														</svg>
													</a>";
												}
												
												if(SOCIAL_YT_LINK != "")
												{
													echo "
													<a href='".SOCIAL_YT_LINK."' class='no_bg' target='_blank' aria-label='YuoTube'>
														<svg class='navigation-social' viewBox='0 0 24 24' width='18' height='18' aria-hidden='true'>
															<use xlink:href='/img/socials.svg#youtube'></use>
														</svg>
													</a> ";
												}
												
											echo "
											</div>
											<div class='spacer'></div> 
											<div class='footer_text'>
												<a href='/".LANG."/rules'>".RULES_USAGE_SITE."</a>
											</div>
											<div class='spacer'></div> 
											<div class='footer_text'>
												".ADRESS.": ".SHOP_ADRESS."
											</div>
											<div class='spacer_2'></div> 
											<div class='footer_menu'>
												".create_menu("footer")."
											</div> 
											<div class='spacer_2'></div> 
											<div class='footer_text'>
											".FOOTER_COPYRIGHT."
											</div>
											<div class='spacer_2'></div> 
										</div>
									</div>
								</div> 
							</div>
							</div>
			</div> 
		</div>
	</div>
</div> 				
							
";
echo "<div class='clear'></div>";
 
echo "		
	</body>
</html>";
*/
?>