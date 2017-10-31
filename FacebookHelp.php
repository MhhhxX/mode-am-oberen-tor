<?php
	require_once __DIR__ . '/vendor/autoload.php';

	/**
	 * 
	 */
	 class FacebookHelp
	 {
	 	private $app_id, $app_secret, $graph_version, $access_token;
	 	
	 	public function __construct($app_id, $app_secret, $graph_version, $access_token)
	 	{
	 		$this->app_id = $app_id;
	 		$this->app_secret = $app_secret;
	 		$this->graph_version = $graph_version;
	 		$this->access_token = $access_token;
	 	}


	 	public function generateSession()
	 	{
	 		$session = new Facebook\Facebook([
		  			'app_id' => $this->app_id,
		  			'app_secret' => $this->app_secret,
		  			'default_graph_version' => $this->graph_version,
				]);

	 		$session->setDefaultAccessToken($this->access_token);

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
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
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
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
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
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
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
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) 
			{
				return NULL;
			}

			return $graphPicture;
	 	}
	 } 
 ?>