<?php
	require_once __DIR__ . '/vendor/autoload.php';
	require_once __DIR__ . '/Logger.php';

	/**
	 * 
	 */
	 class FacebookHelp extends Logger
	 {
	 	
	 	function __construct()
	 	{
	 		parent::__construct1('NewsFeed-1.1/');
	 	}


	 	public function generateSession($app_id, $app_secret, $graph_version, $access_token)
	 	{
	 		$session = new Facebook\Facebook([
		  			'app_id' => $app_id,
		  			'app_secret' => $app_secret,
		  			'default_graph_version' => $graph_version,
				]);

	 		$session->setDefaultAccessToken($access_token);

	 		return $session;
	 	}

	 	public function generateGraphNode($request, $session)
	 	{
	 		try
	 		{
		 		$response = $session->get($request);
			  	$graphNode = $response->getGraphNode();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) 
			{
				parent::writelog("ErrorLog.txt", "Error in function generateGraphNode(): " . $e->getMessage(), "a+");
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
				// if something went wrong the reason is going to be written into an error log file
				parent::writelog("ErrorLog.txt", "Error in function generateGraphNode(): " . $e->getMessage(), "a+");
				return NULL;
			}

			return $graphNode;
	 	}

	 	public function generateGraphUser($request, $session)
	 	{
	 		try
	 		{
		 		$response = $session->get($request);
			  	$graphUser = $response->getGraphUser();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) 
			{
				parent::writelog("ErrorLog.txt", "Error in function generateGraphUser(): " . $e->getMessage(), "a+");
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
				// if something went wrong the reason is going to be written into an error log file
				parent::writelog("ErrorLog.txt", "Error in function generateGraphUser(): " . $e->getMessage(), "a+");
				return NULL;
			}

			return $graphUser;
	 	}

	 	public function generateGraphEdge($request, $session)
	 	{
	 		try
	 		{
		 		$response = $session->get($request);
			  	$graphEdge = $response->getGraphEdge();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) 
			{
				parent::writelog("ErrorLog.txt", "Error in function generateGraphEdge(): " . $e->getMessage(), "a+");
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
				// if something went wrong the reason is going to be written into an error log file
				parent::writelog("ErrorLog.txt", "Error in function generateGraphEdge(): " . $e->getMessage(), "a+");
				return NULL;
			}

			return $graphEdge;
	 	}

	 	public function generateGraphPicture($request, $session)
	 	{
	 		try
	 		{
		 		$response = $session->get($request);
			  	$graphPicture = $response->getGraphPicture();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) 
			{
				parent::writelog("ErrorLog.txt", "Error in function generateGraphPicture(): " . $e->getMessage(), "a+");
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
				// if something went wrong the reason is going to be written into an error log file
				parent::writelog("ErrorLog.txt", "Error in function generateGraphPicture(): " . $e->getMessage(), "a+");
				return NULL;
			}

			return $graphPicture;
	 	}
	 } 
 ?>