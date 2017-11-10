<?php
	require_once __DIR__ . '/vendor/autoload.php';

	/**
	 * 
	 */
	class FacebookHelp {
	 	private static $fbHelp;
	 	private $app_id, $app_secret, $graph_version, $access_token;
	 	private $session;
	 	
	 	private function __construct($app_id, $app_secret, $graph_version, $access_token) {
	 		$this->app_id = $app_id;
	 		$this->app_secret = $app_secret;
	 		$this->graph_version = $graph_version;
	 		$this->access_token = $access_token;
	 	}

	 	public static function newInstance($app_id, $app_secret, $graph_version, $access_token) {
	 		if (self::$fbHelp == null) 
	 			return (self::$fbHelp = new FacebookHelp($app_id, $app_secret, $graph_version, $access_token));
	 		return self::$fbHelp;
	 	}

	 	public function generateSession() {
	 		if ($this->app_id == NULL || $this->app_secret == NULL || 
	 			$this->graph_version == NULL || $this->access_token == NULL)
	 			return false;
	 		if ($this->session == NULL) {
		 		$this->session = new Facebook\Facebook([
			  			'app_id' => $this->app_id,
			  			'app_secret' => $this->app_secret,
			  			'default_graph_version' => $this->graph_version,
					]);

		 		$this->session->setDefaultAccessToken($this->access_token);
		 	}

	 		return $this->session;
	 	}

	 	public function requestGraphNode($request) {
	 		try {
		 		$response = $this->session->get($request);
			  	$graphNode = $response->getGraphNode();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) {
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				return NULL;
			}

			return $graphNode;
	 	}

	 	public function requestGraphUser($request) {
	 		try {
		 		$response = $this->$session->get($request);
			  	$graphUser = $response->getGraphUser();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) {
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				return NULL;
			}

			return $graphUser;
	 	}

	 	public function requestGraphEdge($request) {
	 		try {
		 		$response = $this->session->get($request);
			  	$graphEdge = $response->getGraphEdge();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) {
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				return NULL;
			}

			return $graphEdge;
	 	}

	 	public function requestGraphPicture($request) {
	 		try {
		 		$response = $this->$session->get($request);
			  	$graphPicture = $response->getGraphPicture();
			}
			catch (Facebook\Exceptions\FacebookResponseException $e) {
				return NULL;

			} catch (Facebook\Exceptions\FacebookSDKException $e) {
				return NULL;
			}

			return $graphPicture;
	 	}

	 } 
 ?>