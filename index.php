<!DOCTYPE HTML>
<html lang="de">
	<head>
		<title>mode am oberen tor</title>
		<meta name="author" content="Ernst Marquart" >
		<meta name="keywords" content="Mode, Kleidungsgeschäft, Kleidung, Bekleidungsgeschäft, Aichach, Jeans, Hosen">
		<meta name="description" content="Auf Hosen spezialisiertes Modegeschäft in Aichach">
		<meta name="ROBOTS" content="INDEX, FOLLOW">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		
		<link rel="stylesheet" media="all" type="text/css" href="fonts.css">
		<link rel="stylesheet" media="all" type="text/css" href="index.css">
		<link href="ExtSrc/lightbox/src/css/lightbox.css" rel="stylesheet">
		<link rel="shortcut icon" href="img/logos/Mode_am_oberen_Tor_Logo_quadratisch.ico" />

		<script src="js/jquery.mobile.custom.min.js"></script>
		<script src="js/jquery.scrollTo.min.js"></script>
		<script src="js/jquery.localScroll.min.js"></script>
		<script src="ExtSrc/jquery.fadethis.js"></script>
		<script src="ExtSrc/jquery.reject.min.js"></script>
		<script src="ExtSrc/pace-1.0.2/pace.min.js"></script>
		<script src="ExtSrc/jInvertScroll/dist/js/jquery.jInvertScroll.min.js"></script>

		<link rel="stylesheet" type="text/css" href="ExtSrc/pace-1.0.2/themes/red/pace-theme-center-circle.css">
		<link rel="stylesheet" type="text/css" href="ExtSrc/jInvertScroll/dist/css/jInvertScroll.css">

		<script type="text/javascript">
			$(document).ready(function() {
				$(window).fadeThis();
				//$.jInvertScroll(['.allNews']);
			});
		</script>

		<script>
			Pace.on('done', function()
			{
				$("body").css("overflow", "auto");
				$("main").css("opacity", "1");
				$("header").css("opacity", "1");
				$(".mainbackground article").css("opacity", "1");
				$(".topnav").css("opacity", "1");
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function() {
				$.reject(
				{
					reject: {  
            		msie: 7, 
        			}  
    			});

    			$(window).bind('beforeunload',function(){
				    $.ajax({
					  url: 'restoreNewsFeed.php',
					  success: function(data) {
					  }
					});

				});
    				
			});

			$(window).unload(function()
			{
				$.ajax(
				{
					  url: 'restoreNewsFeed.php',
					  success: function(data) 
					  {
					  }
				});

			});
		</script>

		<script type="text/javascript">
			$(window).load(function()
			{
				$.get("Opened.html", function(data, status) {
						$(".frontSide tbody").append(data);
					});
				setInterval(function() {
						$(".frontSide tbody tr:last-child").remove();
						$.get("Opened.html", function(data, status) {
						$(".frontSide tbody").append(data);
					});
				}, 60 * 1000);
			});
		</script>

		<script type="text/javascript">
			$(window).load(function()
			{ 
				/*$(".bottomheader").load(function() $("section h1").height()/3
				{*/
					var abstand = $("section h1").height() - $(".bottomheader").height() - $(".bottomheader").height()/2;
					if ($(".topnav").css("display") != "none")
						abstand = -$(".topnav li").height() + 20;
				//});

				jQuery(function( $ )
					{
						$.localScroll.defaults.axis = 'y';
						
						/**
						 * NOTE: I use $.localScroll instead of $('#navigation').localScroll() so I
						 * also affect the >> and << links. I want every link in the page to scroll.
						 */
						$.localScroll(
						{
							queue:true,
							axis:'y',
							duration:1000,
							hash:true,
							offset: abstand,
							onBefore: function(anchor, $target )
							{
							},
							onAfter:function( anchor, settings )
							{
								// The 'this' contains the scrolled element (#content)
							}
						});
					});
			});
		</script>
		
		<script type="text/javascript">
		$(window).load(function()
		{

					var browserHeight = $(window).innerHeight();
					var browserWidth = $(window).innerWidth();
					var rightPictures = $(".post-picture-right").find("img").toArray();
					var leftPictures = $(".post-picture-left").find("li").toArray();
					var Posts = $(".news").find("figure").toArray();
					var amountOfListElements = rightPictures.length/Posts.length;
					var triggerPos1;

					$(".jeansmode, .frauenmode, .maennermode, .about, .mainbackground").css("height", browserHeight);

					update();

				function update()
				{
					rightPictures = $(".post-picture-right").find("img").toArray();
					leftPictures = $(".post-picture-left").find("li").toArray();
					Posts = $(".news").find("figure").toArray();
					amountOfListElements = rightPictures.length/Posts.length;

					for (var i = 0; i < Posts.length; i++)
					{
						/*if (($(leftPictures[i]).innerWidth() / $(leftPictures[i]).innerHeight()) < 1)
							$(Posts[i]).find("#post-picture").css("height", $(leftPictures[i]).innerHeight());*/

						$(Posts[i]).find(".post-picture-right").find("li").each(function(j){
							if (($(leftPictures[i]).innerWidth() / $(leftPictures[i]).innerHeight()) < 1) 
							{
								$(this).css("height", ($(leftPictures[i]).innerHeight()) / $(this).parent().find("li").toArray().length);
								if ($(this).parent().find("li").toArray().length > 3)

									$(this).css("height", $(leftPictures[i]).innerHeight() / 3);
							}
								
							else
							{
								$(this).css("height", $(leftPictures[i]).innerHeight() / 2);
							}
				
						});
					}

					

					for(var i = 0; i < rightPictures.length; i++) 
					{
						if (($(rightPictures[i]).innerWidth() / $(rightPictures[i]).innerHeight()) >= 1) 
						{
							$(rightPictures[i]).css("top", "0px");
							$(rightPictures[i]).css("height", "100%");
						}
						
					}

					var newsBlocks = $(".news").find("figure").find(".newsblock").toArray();
					var counter = 0, erg = 0;
					triggerPos1 = $(".about").offset().top - $(".bottomheader").height();
					/*newsBlocks.each(function(i)
					{
						$(this).css("margin-left", Math.floor((Math.random() * (browserWidth - $(Posts[0]).children().width())) + 1));
					});*/

					/*while((erg = 2 * counter) < newsBlocks.length)
					{
						$(newsBlocks[erg]).css("margin-left", "3%");
						$(newsBlocks[erg + 1]).css("margin-left", "45%");
						counter++;
					}*/
				}

					$('button').click(function()
    				{
    					$.get("furtherNews.php", function(data, status){
				            //alert("Data: " + data + "\nStatus: " + status);
				            $(".news .allNews").append(data);
				            
				            setTimeout(function()
				            	{
				            		update();
				            		triggerPos1 = $('.about').offset().top - 60;
				            	}, 500);
				        });
    				});

					var triggerPos = $(".jeansmode").offset().top - 60;		// gibt an ab welchem y-Wert die Animation gestartet werden soll (in Pixel)
					
					var isIE10 = !!navigator.userAgent.match(/MSIE 10/);
					var isIE11 = !!navigator.userAgent.match(/Trident.*rv[ :]*11\./);

					var sections = $("main").find("section").toArray();
					var sectionsyPos = [];
					var captions = [];
					var menueLinks = $(".bottomheader").find("a").toArray();


					var distance = $(".bottomheader").height();

					for (var i = 0; i < sections.length; i++) 
					{
						sectionsyPos[i] = $(sections[i]).offset().top;
					}

					$(window).on('scroll', function()
					{
						for (var i=0; i<sections.length; i++)
							if ($(window).scrollTop() + distance >= sectionsyPos[i] && $(window).scrollTop() <= sectionsyPos[i] + $(sections[i]).innerHeight() - distance) 
							{
								for (var j = 0; j < menueLinks.length; j++) 
								{
									/*if (sectionsyPos[i+1] <= sectionsyPos[i] + $(sections[i]).height() - 50) 
										{*/
									for (var k = 0; k < sections.length; k++) 
									{
										sectionsyPos[k] = $(sections[k]).offset().top;
									}
										//}
									if($(sections[i]).find("h1").attr("id") === $(menueLinks[j]).attr("href").replace("#", ""))
									{
										$(menueLinks[j]).parent().css("border-bottom", "4px solid #DD3700"); // that's the effect in the menue bar
										// window.location.hash = $(menueLinks[j]).attr("href");
									}
								};
							}
							else
							{
								for (var j = 0; j < menueLinks.length; j++) 
								{
									if($(sections[i]).find("h1").attr("id") === $(menueLinks[j]).attr("href").replace("#", ""))
									{
										if ($(document).outerWidth(true) <= 605)
											$(menueLinks[j]).parent().css("border-bottom", "1px solid white"); // that's the effect in the menue bar
										else
											$(menueLinks[j]).parent().css("border-bottom", "none");
									}
								};
							}

					});

					if (isIE10 || isIE11) 
					{
						
						$(window).on('scroll', function () 
						{
							if ($(window).scrollTop() > triggerPos) 
							{
								$(".frontheader").addClass("smaller-header");
								$(".bottomheader").addClass("bottomheader-rotate");
								$(".frontheaderMobile").addClass("smaller-header");
								$("footer").css("display", "block");
								
							}
							if ($(window).scrollTop() < triggerPos) 
							{
								
								$(".bottomheader").removeClass("bottomheader-rotate");
								$("footer").css("display", "none");
								$(".frontheader").removeClass("smaller-header");
								$(".frontheaderMobile").removeClass("smaller-header");
							}
						});
					}
					else
					{	
					
						$(window).scroll(function () 
						{
							if ($(window).scrollTop() > triggerPos) 
							{
								$(".header").addClass("smaller-header");
								$("footer").css("display", "block");
								
							}
							if ($(window).scrollTop() < triggerPos) 
							{
								$("footer").css("display", "none");
								$(".header").removeClass("smaller-header");
							}

							if ($(window).scrollTop() > triggerPos1) 
							{

								$(".header").addClass("side-header");
							}
							else
								$(".header").removeClass("side-header");


						});
					}

			});
		</script>

		<script type="text/javascript">
			$(document).ready(function()
			{
				var imgs = $("nav").find("img").toArray();
				var article_items = $("nav").find(".info").toArray();

				var picture_articles = $(".brands").find(".pictures").toArray();

				$.each(imgs, function(i, value)
				{
					$(this).hover(function()
					{
						$(article_items[i]).toggleClass("activeOnHover");
						$(picture_articles[i]).toggleClass("picturesOnHover");
					});
				});

				$(".icon a").click(function(){
					$(".topnav").toggleClass("responsive");
				});

				$(".topnav li:not(:last-child)").click(function(){
					$(".topnav").removeClass("responsive");
				});
			});
		</script>		
		
	</head>
	
	<body id="home">
	
	<div class="wrapper">
		<header class="">
			<div class="header">
			<div class="frontheader">	
			
				<ul id="navL">

						<li>
							<a href="#jeansmode" title="Modeangebot an Jeans und Hosen">
								<img src="img/logos/Jeans_Hosen.png" alt="Jeans- und Hosenmode">
								Hosen
							</a>
						</li>

						
						<li>
							<a href="#damenmode" title="Modeangebot für Frauen">
								<img id="womensymbol" src="img/logos/Frauenmode.png" alt="Frauenmode">
								Frauen
							</a>
						</li>
						
						<li>
							<a href="#maennermode" title="Modeangebot für Männer">
								<img id="mensymbol" src="img/logos/Maennermode.png" alt="Männermode">
								Männer
							</a>
						</li>
						
				</ul>
				
				<!-- altes Logo
					<a href="#" id="home">
						<img id="logo" src="img/home_logo.JPG" alt="logo">
					</a>
				-->

				<table id="mainlogo">
        				<tbody>
          					<tr>
            						<th> mode </th>
            						<th> am <br>
              							oberen </th>
            						<th> tor </th>
          					</tr>
          					<tr>
            						<td colspan="3"> Jeans und Hosen Fachgeschäft.</td>
          					</tr>
        				</tbody>
      			</table>		
				
				<ul id="navR">
					<li>
						<a href="#news" title="Neuigkeiten und Aktuelles">
							<img id="newsIMG" src="img/logos/News.png" alt="Aktuelles">
							Aktuelles
						</a>
					</li>
					
					<li>
						<a href="#brands" title="Angebotene Marken">
							<img id="brandsLogo" src="img/logos/fuehrende_Marken.png" alt="führende Marken">
							Marken
						</a>
					</li>
					
					<li>
						<a href="#about" title="Kontakt und Anfahrt">
							<img id="uhr" src="img/logos/Oeffnungszeiten.png" alt="Kontakt und Anfahrt">
							Kontakt
						</a>
					</li>
				</ul>					
				
			</div>
			
						
				
				
				<div class="bottomheader">
					
						<ul id="bottomnavL">							
							<li>
								<a href="#jeansmode" title="">
									Hosen
								</a>
							</li>
							
							<li>
								<a href="#damenmode" title="">
								Frauen
								</a>
							</li>
							
							

							<li>
								<a href="#maennermode" title="">
								Männer
								</a>
							</li>
						</ul>
					
						<!--<h2 id="top">
							M
							<span id="middle">ao</span>
							T
						</h2>-->
						<table class="bottomlogo">
							<tbody>
								<tr>
            						<th> mode </th>
            						<th> am <br>
              							oberen </th>
            						<th> tor </th>
  								</tr>
							</tbody>
						</table>
						
						<ul id="bottomnavR">
						
							<li>
								<a href="#news" title="">
								Aktuelles
								</a>
							</li>
							
							<li>
								<a href="#brands" title="">
								Marken
								</a>
							</li>
							
							<li>
								<a href="#about" title="">
									Kontakt
								</a>
							</li>
							
						</ul>
						<div class="clear"></div>
				</div>	
				<div class="clear"></div>

					<div class="contactheader">
						<div class="impressum">
							<a href="Impressum/Impressum.html" target="_blank">Impressum</a>
						</div>
					</div>
				</div>

			</header>

			<ul class="topnav" id="myTopnav">
  				    <li><a class="active" href="#home">
  				    		<table class="bottomlogo">
								<tbody>
									<tr>
	            						<th> mode </th>
	            						<th> am <br>
	              							oberen </th>
	            						<th> tor </th>
	  								</tr>
								</tbody>
							</table>
  				    	</a>
  				    </li>
  				    <!--<li class="icon">
  				    	<a class="active" href="#home">
	  				    	<table class="bottomlogo">
								<tbody>
									<tr>
	            						<th> mode </th>
	            						<th> am <br>
	              							oberen </th>
	            						<th> tor </th>
	  								</tr>
								</tbody>
							</table>
						</a>
  				    </li>-->
					<li><a href="#jeansmode">Hosen</a></li>
					<li><a href="#damenmode">Frauen</a></li>
					<li><a href="#maennermode">Männer</a></li>
					<li><a href="#news">Aktuelles</a></li>
					<li><a href="#brands">Marken</a></li>
					<li><a href="#about">Kontakt</a></li>
					<li><a href="Impressum/Impressum.html" target="_blank">Impressum</a></li>
					<li class="icon">
					    <a>☰</a>
					</li>
				</ul>
		
		<footer>
			<a href="#home" title="">
				<img src="svg/Top.svg" alt="Button zum Hochscrollen">
			</a>
			
		</footer>	
		
		<main>
		
			<section class="mainbackground">
				<h1 style="display: none">bla</h1>
				<article>
					<h3 style="display: none;">bla</h3>
					<p class="slide-bottom text abouttext">
						<?php
							$file = fopen("Texte/Eintraege/About.txt", "r");
							$inhalt = fgets($file);

							echo $inhalt;
						?>
					</p>
				</article>
			</section>

			<section class="jeansmode">
				<h1 id="jeansmode">Hosen</h1>
				
				<article class="jeansarticle">
					
					<figure class="left-pictures">
						<img src="img/Jeans/jeans1.1.png" alt="">
						<img src="img/Jeans/jeans2.1.png" alt="">
					</figure>

					<p class="slide-left text jeanstext">
						<?php
							$file = fopen("Texte/Eintraege/JeansHosen.txt", "r");
							$inhalt = fgets($file);

							echo $inhalt;
						?>
					</p>

					<figure class="right-pictures">
						<img src="img/Jeans/jeans3.1.png" alt="">
						<img src="img/Jeans/jeans4.1.png" alt="">
					</figure>

					<div style="clear: both"></div>
				</article>

			</section>
			
			<section class="frauenmode">
				<article class="frauenmodearticle">
					<h1 id="damenmode">Frauen</h1>
					<p class="slide-right text frauentext">
						<?php
							$file = fopen("Texte/Eintraege/Frauenmode.txt", "r");
							$inhalt = fgets($file);

							echo $inhalt;
						?>
					</p>

					<figure class="frauen-pictures float_right">
						<img src="img/Frauen/frauen1.1.png" alt="">
						<img src="img/Frauen/frauen2.1.png" alt="">
						
					</figure>
					<figure class="frauen-pictures">
						<img src="img/Frauen/frauen3.1.png" alt="">
						<img src="img/Frauen/frauen4.1.png" alt="">
					</figure>
				</article>
				
			</section>

			<section class="maennermode">
				<h1 id="maennermode">Männer</h1>
				<article class="frauenmodearticle">

					<figure class="frauen-pictures">
						<img src="img/Maenner/maenner1.1.png" alt="">
						<img src="img/Maenner/maenner2.1.png" alt="">
					</figure>

					<figure class="frauen-pictures float-left">
						<img src="img/Maenner/maenner3.png" alt="">
						<img src="img/Maenner/maenner5.1.png" alt="">
					</figure>

					
					<p class="slide-left maennertext text">
						<?php
							$file = fopen("Texte/Eintraege/Maennermode.txt", "r");
							$inhalt = fgets($file);

							echo $inhalt;
						?>
					</p>
				</article>
			</section>
			
			<section class="news">
			
				<h1 id="news">Aktuelles</h1>
					<div class="allNews" style="margin=0px; width=100%">
						<?php
							$file = file_get_contents('NewsFeed-1.1/NewsFeed-1.1.html');
							
							echo $file;
						 ?>
					</div>

				 <button>Ältere Posts laden?</button>
				
			</section>

			<section class="brands">
				<h1 id="brands">
					Marken
				</h1>
				
				<nav id="brandlogos">
				
					<ul id="brandsLeft">
					
						<li>
							<article class="info" style="">
								<h3 style="margin: 0px;">Levi's</h3>
								<p class="infotext" style="margin: 0px; white-space: pre-line;">
									<?php
										$file = file_get_contents("Texte/Marken/Levis.txt");
										echo $file; 
									 ?>
								</p>
							</article>

							<a href="http://www.levi.com/" title="Levis Website" target="_blank">
								<img src="img/brands/levis_small.png" alt="Levi Logo">
							</a>
						</li>	

						<li>
							<article class="info">
								<h3 style="margin: 0px;">Paddocks</h3>
								<p class="infotext" style="margin: 0px; white-space: pre-line;">
									<?php 
										$file = file_get_contents("Texte/Marken/Paddocks.txt");
										echo $file;
									 ?>
								</p>
							</article>

							<a href="http://www.paddocks.de/" target="_blank" title="Paddocks Website">
								<img src="img/Marken/Paddocks/paddocks_logo.jpg" id="paddockspic" alt="Paddocks Logo">
							</a>
						</li>	
						
						<li>
							<article class="info">
								<h3 style="margin: 0px;">Broadway</h3>
								<p class="infotext" style="margin: 0px; white-space: pre-line;">
									<?php
										$file = file_get_contents("Texte/Marken/Broadway.txt");
										echo $file; 
									 ?>
								</p>
							</article>

							<a href="http://www.broadway-fashion.com/" title="Broadway Website" target="_blank" >
								<img src="img/brands/broadway-logo.png" alt="Broadway Logo" style="border: 2px solid #000;">
							</a>
						</li>	
					
						<li>
							<article class="info">
								<h3 style="margin: 0px;">Horsy</h3>
								<p class="infotext" style="margin: 0px; white-space: pre-line;">
									<?php
										$file = file_get_contents("Texte/Marken/Horsy.txt");
										echo $file; 
									 ?>
								</p>
							</article>

							<a href="http://www.horsy-jeans.de/" title="Horsy Website" target="_blank">
								<img src="img/Marken/Horsy/horsy_logo.png" id="opposepic" alt="Horsy Logo">
							</a>
						</li>						
						
						<li>
							<article class="info">
								<h3 style="margin: 0px;">Poolman</h3>
								<p class="infotext" style="margin: 0px; white-space: pre-line;">
									<?php
										$file = file_get_contents("Texte/Marken/Poolman.txt");
										echo $file; 
									 ?>
								</p>
							</article>

							<a href="http://www.poolman.de" target="_blank" title="Poolman Website">
								<img src="img/Marken/Poolman/poolman_logo.png" alt="Poolman Logo">
							</a>
						</li>	
						
						<li>
							<article class="info">
								<h3 style="margin: 0px;">Jórli</h3>
								<p class="infotext" style="margin: 0px; white-space: pre-line;">
									<?php
										$file = file_get_contents("Texte/Marken/Jorli.txt");
										echo $file; 
									 ?>
								</p>
							</article>

							<a href="http://www.godske.com/de/marken/jorli" target="_blank" title="Jorli Website">
								<img src="img/Marken/Jorli/jorli_logo.png" alt="Jorli Logo">
							</a>
						</li>

						<li>
							<article class="info">
								<h3 style="margin: 0px;">Robell</h3>
								<p class="infotext" style="margin: 0px; white-space: pre-line;">
									<?php
										$file = file_get_contents("Texte/Marken/Robell.txt");
										echo $file; 
									 ?>
								</p>
							</article>

							<a href="http://www.godske.com/de/marken/robell" target="_blank" title="Robell Website">
								<img src="img/Marken/Robell/robell_logo.png" alt="Robell Logo">
							</a>
						</li>
					</ul>
					
					<div class="clear"></div>
				</nav>

				<article class="pictures">

					<figure class="pictures_big">
							<img alt="" style="width: 100%;" src="img/Marken/Levis/levis3.png">
					</figure>
					
					<figure class="pictures_small pictures_left">
						<img alt="" style="width: 100%;" src="img/Marken/Levis/levis1.1.png">
					</figure>

					<figure class="pictures_small pictures_right">
						<img alt="" style="width: 100%;" src="img/Marken/Levis/levis1.2.png">
					</figure>

					<figure class="pictures_small pictures_left">
						<img alt="" style="width: 100%;" src="img/Marken/Levis/levis3.1.png">
					</figure>

					<figure class="clear pictures_small pictures_right">
							<img alt="" style="width: 100%;" src="img/Marken/Levis/levis3.2.png">
					</figure>

				</article>

				<article class="pictures">

					<figure class="pictures_big">
						<img alt="" style="width: 100%;" src="img/Marken/Paddocks/paddocks3.png">
					</figure>
					
					<figure class="pictures_small pictures_left">
						<img alt="" style="width: 100%" src="img/Marken/Paddocks/paddocks1.1.png">
					</figure>

					<figure class="clear pictures_small pictures_right">
						<img alt="" style="width: 100%;" src="img/Marken/Paddocks/paddocks1.2.png">
					</figure>

					<div style="clear: both"></div>

					<figure class="pictures_big" style="margin-top: 4%">
						<img alt="" style="width: 100%;" src="img/Marken/Paddocks/paddocks2.png">
					</figure>

				</article>

				<article class="pictures">

					<figure class="pictures_small pictures_left" style="margin-top: 0px">
							<img alt="" style="width: 100%;" src="img/Marken/Broadway/broadway1.1.png">
					</figure>
					
					<figure class="clear pictures_small pictures_right" style="margin-top: 0px">
						<img alt="" style="width: 100%;" src="img/Marken/Broadway/broadway1.2.png">
					</figure>

					<div style="clear: both"></div>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Broadway/broadway2.png">
					</figure>

					<figure class="pictures_small pictures_left">
							<img alt="" style="width: 100%;" src="img/Marken/Broadway/broadway3.1.png">
					</figure>
					
					<figure class="clear pictures_small pictures_right">
						<img alt="" style="width: 100%;" src="img/Marken/Broadway/broadway3.2.png">
					</figure>

					<div style="clear: both"></div>

				</article>

				<article class="pictures">

					<figure class="pictures_small pictures_left" style="margin-top: 0px">
							<img alt="" style="width: 100%;" src="img/Marken/Horsy/horsy1.1.png">
					</figure>
					
					<figure class="clear pictures_small pictures_right" style="margin-top: 0px">
						<img alt="" style="width: 100%;" src="img/Marken/Horsy/horsy1.2.png">
					</figure>

					<div style="clear: both"></div>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Horsy/horsy2.png">
					</figure>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Horsy/horsy3.png">
					</figure>

				</article>

				<article class="pictures">

					<figure class="pictures_small pictures_left" style="margin-top: 0px">
							<img alt="" style="width: 100%;" src="img/Marken/Poolman/poolman3.2.png">
					</figure>
					
					<figure class="clear pictures_small pictures_right" style="margin-top: 0px">
						<img alt="" style="width: 100%;" src="img/Marken/Poolman/poolman1.2.png">
					</figure>

					<div style="clear: both"></div>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Poolman/poolman3.png">
					</figure>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Poolman/poolman2.png">
					</figure>

				</article>

				<article class="pictures">

					<figure class="pictures_small pictures_left" style="margin-top: 0px">
							<img alt="" style="width: 100%;" src="img/Marken/Jorli/jorli1.1.png">
					</figure>
					
					<figure class="clear pictures_small pictures_right" style="margin-top: 0px">
						<img alt="" style="width: 100%;" src="img/Marken/Jorli/jorli1.2.png">
					</figure>

					<div style="clear: both"></div>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Jorli/jorli2.png">
					</figure>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Jorli/jorli3.png">
					</figure>

				</article>
				
				<article class="pictures">

					<figure class="pictures_small pictures_left" style="margin-top: 0px">
							<img alt="" style="width: 100%;" src="img/Marken/Robell/robell1.1.png">
					</figure>
					
					<figure class="clear pictures_small pictures_right" style="margin-top: 0px">
						<img alt="" style="width: 100%;" src="img/Marken/Robell/robell1.2.png">
					</figure>

					<div style="clear: both"></div>

					<figure class="pictures_big" style="margin-top:4%">
						<img alt="" style="width: 100%;" src="img/Marken/Robell/robell2.png">
					</figure>

					<figure class="pictures_small pictures_left">
							<img alt="" style="width: 100%;" src="img/Marken/Robell/robell3.1.png">
					</figure>
					
					<figure class="clear pictures_small pictures_right">
						<img alt="" style="width: 100%;" src="img/Marken/Robell/robell3.2.png">
					</figure>

					<div style="clear: both"></div>

				</article>
				
			</section>

			<section class="about">
				<div style="width: 100%;">
				<h1 id="about">Kontakt und Öffnungszeiten</h1>
				
				<div id="contact" style="">
				
					<table class="frontSide">
						<thead>
							<tr>
								<th>
									Öffnungszeiten:
								</th>
							</tr>
						</thead>
				
						<tbody>
					
							<tr>
								<td>Montag - <br>Donnerstag: </td>
								<td>9:30 - 12:00 Uhr & <br> 14:00 - 18:00 Uhr</td>
							</tr>
					
							<tr>
								<td>Freitag: </td>
								<td>09:30 - 18:00 Uhr</td>
							</tr>
					
							<tr>
								<td>Samstag: </td>
								<td>10:00 - 13:00 Uhr</td>
							</tr>
						</tbody>
					</table>
					<table>
						<thead>
							<tr>
								<th>
									Kontaktdaten
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Anfahrt:</td>
								<td>Werlberger Straße 4, Aichach</td>
							</tr>				
					
							<tr>
								<td>Telefon:</td>
								<td><a href="tel:+49825153777">08251/53777</a></td>
							</tr>
					
							<tr>
								<td>E-Mail:</td>
								<td><a style="font-size: 15px;" href="mailto:e.marquart@mode-am-oberen-tor.de">e.marquart@mode-am-oberen-tor.de</a></td>
							</tr>
						
						</tbody>
					</table>
				</div>

				<div id="map">
					<iframe src="https://umap.openstreetmap.fr/de/map/mode-am-oberen-tor_103070?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=null&onLoadPanel=undefined&captionBar=false"></iframe>
					<div class="extra">
					<p class="vollbild"><a target="_blank" href="https://umap.openstreetmap.fr/de/map/mode-am-oberen-tor_103070">Vollbildanzeige</a></p>

					<p class="route"><a style="" target="_blank" href="https://openrouteservice.org/directions?n1=48.458158&n2=11.130773&n3=18&a=null,null,48.45769,11.129467&b=0&c=0&k1=en-US&k2=km">
					Route berechnen?
					</a>
					</p>
					</div>
				</div>

				</div>
			</section>
		</main>
	</div>
		<script src="ExtSrc/lightbox/src/js/lightbox.js"></script>
		<script>
    		lightbox.option({
      			'alwaysShowNavOnTouchDevices': true
    		})
		</script>

		<!--<script>
			$("#post-picture1").justifiedGallery()({
				rowHeight : 139,
				margins : 3,
			});
		</script>-->

		<!--<script>
			$('.photoset-grid-custom').photosetGrid({
			  // Set the gutter between columns and rows
			  gutter: '5px',
			  // Manually set the grid layout
			  layout: '13',
			  // Wrap the images in links
			  highresLinks: false,
			  // Asign a common rel attribute
			  rel: 'print-gallery',

			  onInit: function(){},
			  onComplete: function(){
			    // Show the grid after it renders
			    $('.photoset-grid-custom').attr('style', '');
			  }
			});
		</script>-->
        <script src="https://code.jquery.com/jquery-latest.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        
	</body>
</html>
