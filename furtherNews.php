<?php
	require_once __DIR__ . '/vendor/autoload.php';
	require_once __DIR__ . '/Logger.php';

	session_start();


		class FurtherNews extends Logger
		{
			public function __construct()
			{
			$session = new Facebook\Facebook([
		  			'app_id' => '1741599822726232',
		  			'app_secret' => 'c19965d4c49e0efde8cf07757de0d755',
		  			'default_graph_version' => 'v2.5',
				]);

			$session->setDefaultAccessToken('1741599822726232|r4sro6hHwRsur-vMlbFDCT0CBFE');

			// time when the script is called
			$timeStamp = time();
			$date = date("d.m.Y", $timeStamp);
			$time = date("H:i:s",$timeStamp);

			$servername = 'localhost';
			$username = 'www-data';
			$password = 'Leck meine Eier!';

			$message;
			$linksForGalery;
			$firstLinkForGalery;
			$pictureLink;
			$nextpage1;

			parent::__construct1("NewsFeed-1.1/");
			parent::writelog("Log.txt", "new SessionID: " . session_id() . " " . $_SESSION["zaehler"], "a+");

			if (!isset($_SESSION['zaehler'])) {
		  		$_SESSION['zaehler'] = 0;
			} else {
		  		$_SESSION['zaehler']++;
			}

			// echo session_id() . " " . $_SESSION['zaehler'] . "<br>";

			try
			{
				$conn = new PDO("mysql:host=$servername;dbname=FURTHERNEWSUSERS", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql_select = "select * from Benutzer where session_id='master';";
				$answer = $conn->prepare($sql_select);
				$answer->execute();
				$master = $answer->fetchAll(); 

				parent::writelog("Log.txt", "select from database success! Sql query: " . $sql_select, "a+");
			}
			catch (PDOException $e)
			{
				parent::writelog("Log.txt", "Error while trying to connect to Database: " . $e->getMessage(), "a+");
				die("Mysql error: " . $e->getMessage());
			}

			if ($_SESSION['zaehler'] == 0)
			{
				exec("cp furtherNews/currentPage.graphedge furtherNews/" . session_id() . "currentPage.graphedge");
				exec("cp furtherNews/ammountOfPosts.txt furtherNews/" . session_id() . "ammountOfPosts.txt");

				try
				{

					$sql_insert = "insert into Benutzer (session_id, amountOfPosts, currentPost) values ('" . session_id() . "', '" . $master[0]['amountOfPosts'] . "', ?);";

					$insert = $conn->prepare($sql_insert);
					$insert->execute(array($master[0]['currentPost']));

					parent::writelog("Log.txt", "insert into database success! Sql query: " . $sql_insert, "a+");

				}
				catch (PDOException $e)
				{
					parent::writelog("Log.txt", "Error while trying to insert into the database: " . $e->getMessage(), "a+");
					die("Mysql error: " . $e->getMessage());
				}
			}

			try
			{
				$sql_select = "select * from Benutzer where session_id='" . session_id() . "';";
				$result = $conn->prepare($sql_select);
				$result->execute(); // the dataArray variable contains the response from the mysql query
				$dataArray = $result->fetchAll();
				parent::writelog("Log.txt", "select from database success! Sql query: " . $sql_select, "a+");
			}
			catch (PDOException $e)
			{
				parent::writelog("Log.txt", "Error while trying to select from the database. mysql query: " . $sql_select . " Error: " . $e->getMessage(), "a+");
				die("Mysql error: " . $e->getMessage());
			}

			if (!$dataArray) 
			{
				session_regenerate_id(true);
				//unset($_SESSION);
				//echo session_regenerate_id(true);
				parent::writelog("Log.txt", "No data in dataArray: " . $dataArray, "a+");
				die("Keine Daten erhalten! Setze session_id zurück. Inhalt der variable dataArray: " . $dataArray);
			}

			// $ammountOfPosts = file_get_contents("furtherNews/" . session_id() . "ammountOfPosts.txt");
			$currentPage = file_get_contents("furtherNews/" . session_id() . "currentPage.graphedge");
			//$currentPage = file_get_contents("furtherNews/currentPage.graphedge");
			$edge = unserialize($currentPage);


			$edge1 = unserialize($dataArray[0]['currentPost']);
			// $nextPage = $session->next($edge);
			$nextPage1 = $session->next($edge1);

			$ammountOfPosts = $dataArray[0]['amountOfPosts'];

			parent::writelog("Log.txt", "currentpage contains: " . $edge1, "a+");
			parent::writelog("Log.txt", "nextpage contains: " . $nextpage1, "a+");

			if(!$nextPage1)
			{
				parent::writelog("Log.txt", "No Further Posts!: " . $nextPage1, "a+");
				die("Keine weiteren Posts");
			}

			// The foreach loop parses through every post from the response array
		  		foreach($nextPage1 as $key => $value)
		  		{
		  			$ammountOfPosts++;
		  			try{
		  				$attachments = $session->get('/' . $value->getField('id') . '?fields=attachments');
		  			} catch (Facebook\Exceptions\FacebookResponseException $ex4) 
					{
						echo 'Graph returned an error: ' . $ex4->getMessage();

					} catch (Facebook\Exceptions\FacebookSDKException $ex4) 
					{
					// if something went wrong the reason is going to be written into an error log file
						$ErrorLog = fopen("/var/www/html/NewsFeed-1.1/ErrorLog(Kopie).txt", "a");
						fwrite($ErrorLog, $ex4->getMessage() . $ex4->getCode() . " am " . $date . " um " . $time . "\r\n");
						fclose($ErrorLog);
					
					exit($ex4->getMessage() . $ex4->getCode());
					}
		  			$attachmentsNode = $attachments->getGraphNode();



		  			//var_dump($attachmentsEdge->getField('subattachments')->getGraphEdge() . "\n\n");

		  			$medias = $attachmentsNode->getField('attachments');
		  			//var_dump($medias->asArray());
		  			$medias1 = $medias->getField('subattachments');

		  			if ($medias[0]->getField('subattachments') == true) // if the "medias" Array contains the child "subattachments", the post contains more pictures
		            {
						$medias = $medias[0]->getField('subattachments');

						foreach ($medias as $key1 => $value1) 
						{
							$pictureLink[$key1] = $value1->getField('media')->getField('image')->getField('src'); // contains all links to the pictures of the post
						
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
		  			$message = str_replace($master[0]['facebook_name'], "", $message);

		  			$imageDimension = getimagesize($pictureLink[0]);

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
			  				}
			  				
			  			}
			  			$linksForGalery .= '</ul>';
			  		}

					// this is the String for the HTML page which contains all the information for the feed
					$meineHtmlSeite1 .= '<figure>
		  		<div class="newsblock" style="">
		  		<div class="newsHeader" style="">
		  			
		  			<div class="header-left" style="">
		  				<a href=http://facebook.com/' . $master[0]['facebook_id'] . ' target="_blank">
		  					<img style="" src="' . $master[0]['profilepicturelink'] . '" alt="">
		  				</a>
		  			</div>
		  		
		  			<div class="header-right" style="">
		  			
						<a style="" href="http://facebook.com/' . $master[0]['facebook_id'] . '" target="_blank">
			  				<div class="name" style="">
		  						<strong>
		  							'
		  								. $master[0]['facebook_name'] .
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

		  		}

		  		echo $meineHtmlSeite1;
		  		$html = $meineHtmlSeite1;

				file_put_contents("furtherNews/" . session_id() . "currentPage.graphedge", serialize($nextPage));

				//file_put_contents("furtherNews/" . session_id() . "ammountOfPosts.txt", $ammountOfPosts);


				try
				{
					$updatePage = serialize($nextPage1);
					$sql = "update Benutzer set amountOfPosts='" . $ammountOfPosts . "', currentPost=? where session_id='" . session_id() . "';";

					$stmt = $conn->prepare($sql);

					$stmt->execute(array($updatePage));
					parent::writelog("Log.txt", "database success! Sql query: " . $sql, "a+");
				}
				catch(PDOException $e)
				{
					parent::writelog("Log.txt", "Error while trying to update the database. sql query: " . $sql . " Error Message " . $e->getMessage(), "a+");
					die("Fehler bei Datenbackupdate " . $e->getMessage());
				}
			}
		}

		new FurtherNews();
?>

