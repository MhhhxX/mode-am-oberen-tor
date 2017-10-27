<?php	

	require_once __DIR__ . '/vendor/autoload.php';
	require_once __DIR__ . '/Logger.php';
	require_once __DIR__ . '/FacebookHelp.php';

	class NewsFeed extends Logger
	{
		public function __construct()
		{

				parent::__construct1('NewsFeed-1.1/');
				$fbHelp = new FacebookHelp();

				$app_id = '1741599822726232';
				$app_secret = 'MyAppSecret';
				$graph_version = 'v2.5';
				$access_token = 'MyAccessToken';

				$session = $fbHelp->generateSession($app_id, $app_secret, $graph_version, $access_token);

				$id = '/337336379785052';
				$limitofposts = 3;
				$message;
				$ammountOfPosts = 0;
				$amountOfAttachments = 0;
				$linksForGalery;
				$firstLinkForGalery;
				$pictureLink;
				// 337336379785052

				// db login datas
				$servername = 'localhost';
				$username = 'www-data';
				$password = 'MySecretPassword';
				
				// time when the script is called
				$timeStamp = time();
				$date = date("d.m.Y", $timeStamp);
				$time = date("H:i:s",$timeStamp);

				// general information about the facebook page
				if(!($personalinformation = $fbHelp->generateGraphUser($id, $session)))
					die("Fehler bitte ins Log schauen!");

				// request for the profile picture
				if(!($profile_picture = $fbHelp->generateGraphPicture($id . "/picture?type=large&redirect=false", $session))) 
					die("Fehler bitte Log lesen!");
				
				// request for the facebook posts
				if(!($graphEdge = $fbHelp->generateGraphEdge($id . '/posts?limit=' . $limitofposts, $session)))
					die("Fehler Bitte Log lesen!");

				$currentPage = serialize($graphEdge);
				file_put_contents("furtherNews/currentPage.graphedge", $currentPage);

				// Before writing new data into the HTML-file it has to be cleared
				parent::writehtml("NewsFeed-1.1.html", " " ,"w");

				// The foreach loop parses through every post from the response array
		  		foreach($graphEdge as $key => $value)
		  		{

		  			$ammountOfPosts++;
		  		
					if(!($attachmentsNode = $fbHelp->generateGraphNode('/' . $value->getField('id') . '?fields=attachments', $session)))
						echo "Fehler bitte Log lesen!";

		  			$medias = $attachmentsNode->getField('attachments');
		  			
		  			$medias1 = $medias->getField('subattachments');

		  			if ($medias[0]->getField('subattachments') == true) // if the "medias" Array contains the child "subattachments", the post contains more pictures
		            {
						$medias = $medias[0]->getField('subattachments');
						echo "\n" . count($medias);

						foreach ($medias as $key1 => $value1) 
						{
							$pictureLink[$key1] = $value1->getField('media')->getField('image')->getField('src'); // contains all links to the pictures of the post
							echo $pictureLink[0];
							$facebookPictureURLs[$key1] = $value1->getField('target')->getField('url'); // contains all links to the Facebook page of the pictures
							$amountOfAttachments++; // amount of pictures
							
						}
					}
					else // if the "medias" Array doesn't contain subattachments the post only have one picture
					{
						$pictureLink[0] = $medias[0]->getField('media')->getField('image')->getField('src'); // contains the link to the picture
						$facebookPictureURLs[0] = $medias[0]->getField('target')->getField('url'); // contains the link to the picture's related Facebook page
						$amountOfAttachments = 1; // it's only one picture so the value must be one
					}
		  			$createdtime = $value->getField('created_time');

		  			$message = $value->getField('story');
		  			$message = str_replace($personalinformation->getName(), "", $message);

		  			$imageDimension = getimagesize($pictureLink[0]);

		  			echo "\n" . $imageDimension[0] . " " . $imageDimension[1] . "\n";

		  			// creates links for the galery

		  			if($imageDimension[0]/$imageDimension[1] > 1)
		  			{
		  				$firstLinkForGalery .= '
		  				<ul class="post-picture-left-wide post-picture-left">
		  						<li>
									<a style="color: black;" href="' . $pictureLink[0] . '" data-lightbox="attachmentGalery' .  $ammountOfPosts . '">
		  								<img src="' . $pictureLink[0] . '" alt="">
		  							</a>
		  						</li>
		  				</ul>';
		  				$linksForGalery = '<ul class="post-picture-right-wide post-picture-right">';

		  				for ($i = 1; $i<count($pictureLink); $i++)
		  				{
			  				if ($i > 3)
			  				{
			  					$linksForGalery .= '<li style="display: none;"><a style="color: black;" href="' . $pictureLink[$i] . '" data-lightbox="attachmentGalery' .  $ammountOfPosts . '">
													</a></li>';
			  				}
			  				else
			  				{
			  					$linksForGalery .= ' <li>
										<a style="color: black;" href="' . $pictureLink[$i] . '" data-lightbox="attachmentGalery' .  $ammountOfPosts . '">
											<img src="' . $pictureLink[$i] . '" alt="">
										</a>
										</li> ';
								$counter++;
		  					}
		  				
		  				}
		  				/*$linksForGalery .= '<p class="li-count" style="display: none;">' . $counter . '</p></ul>';*/
		  				$linksForGalery .= '</ul>';
		  			}
		  			else
		  			{
			  			$firstLinkForGalery .= '
			  				<ul class="post-picture-left">
			  						<li>
										<a style="color: black;" href="' . $pictureLink[0] . '" data-lightbox="attachmentGalery' .  $ammountOfPosts . '">
			  								<img src="' . $pictureLink[0] . '" alt="">
			  							</a>
			  						</li>
			  				</ul>';
			  			$linksForGalery = '<ul class="post-picture-right">';

			  			for ($i = 1; $i<count($pictureLink); $i++)
			  			{
			  				if ($i > 3)
			  				{
			  					$linksForGalery .= '<li style="display: none"><a style="color: black;" href="' . $pictureLink[$i] . '" data-lightbox="attachmentGalery' .  $ammountOfPosts . '">
													</a></li>';
			  				}
			  				else
			  				{
			  					$linksForGalery .= ' <li>
										<a style="color: black;" href="' . $pictureLink[$i] . '" data-lightbox="attachmentGalery' .  $ammountOfPosts . '">
											<img src="' . $pictureLink[$i] . '" alt="">
										</a>
										</li> ';
			  				}
			  				
			  			}
			  			$linksForGalery .= '</ul>';
			  		}
		  			echo $count = count($pictureLink) . "\n";

					// this is the String for the HTML page which contains all the information for the feed
					$meineHtmlSeite1 = '<figure>
		  		<div class="newsblock" style="">
		  		<div class="newsHeader" style="">
		  			
		  			<div class="header-left" style="">
		  				<a href=http://facebook.com/' . $personalinformation->getId() . ' target="_blank">
		  					<img style="" src="' . $profile_picture->getUrl() . '" alt="">
		  				</a>
		  			</div>
		  		
		  			<div class="header-right" style="">
		  			
						<a style="" href="http://facebook.com/' . $personalinformation->getId() . '" target="_blank">
			  				<div class="name" style="">
		  						<strong>
		  							'
		  								. $personalinformation->getName() .
		  							'
			  					</strong>
			  				</div>
			  			</a> 
					
						<div class="story">
								<p>'
									. $message .
								'</p>
						</div> 
						
					</div>
					
					<div style="clear: right;"></div>
					
					<div class="created-time">
						<p style="">'
		  					. $createdtime->format("d. F") . ' um ' . $createdtime->format("H:i:s") . ' Uhr
		  				</p>			
					</div>  			
		  			
					<div style="clear: both;"></div>  			
		  			
		  		</div>
		  		
				<article style="position: relative;">
				
					<p style="">' . $value->getField("message") . '</p>

				</article>
				
					<div class="post-picture" style="">
						
								' . $firstLinkForGalery . '
							
							

								' . $linksForGalery . '
						
							<p>' . $value->getField("name") . '</p>
						
							<p>' . $value->getField("description") . '</p>
					
				</div>
		  		
		  				</figure>';

		  			
		  			// restore variables for next iteration	
		  			$linksForGalery = '';
		  			$firstLinkForGalery = '';
		  			unset($pictureLink);
		  			unset($imageDimension);

					parent::writehtml("NewsFeed-1.1.html", $meineHtmlSeite1, "a+");

				}

				/*$anzahlPosts = fopen("furtherNews/ammountOfPosts.txt", "a");
				echo fwrite($anzahlPosts, $ammountOfPosts);
				fclose($anzahlPosts);*/

				try
				{
					$conn = new PDO("mysql:host=$servername;dbname=FURTHERNEWSUSERS", $username, $password);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$url = $profile_picture->getUrl();
					echo $url;

					$sql_update = "update Benutzer set  amountOfPosts='" . $ammountOfPosts . "', currentPost=?, timeStamp='" . time() . "',facebook_id='" . $personalinformation->getId() . "', profilepicturelink='" . $url . "', facebook_name='" . $personalinformation->getName() . "' where session_id='master'";
					$update = $conn->prepare($sql_update);
					$update->execute(array($currentPage));
					parent::writelog("Log.txt", "update success. query: " . $sql_update, "a+");
				}
				catch(PDOException $e)
				{
					parent::writelog("ErrorLog.txt", parent::getCurrentTimeStamp() . " Fehler bei Datenbankupdate in NewsFeed-1.1.php: " . $e->getMessage(), "a");
					die();
				}

				parent::writelog("TimeStampFile.txt", "Die Facebook News wurden am " . parent::getCurrentTimeStamp() . " aktualisiert", "a+");

		}
	}

	new NewsFeed();
?>
