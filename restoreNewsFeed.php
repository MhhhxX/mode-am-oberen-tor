<?php
	require_once __DIR__ . "/Logger.php";

	session_start();
	/**
	*  
	*/
	class Restorer extends Logger
	{

		function __construct()
		{
			$servername = 'localhost';
			$username = 'www-data';
			$password = 'Leck meine Eier!';
			parent::__construct1("NewsFeed-1.1/");

			exec("rm furtherNews/" . session_id() . "currentPage.graphedge");
			exec("rm furtherNews/" . session_id() . "ammountOfPosts.txt");

			try
			{
				$conn = new PDO("mysql:host=$servername;dbname=FURTHERNEWSUSERS", $username, $password);
				$sql = "delete from Benutzer where session_id='" . session_id() . "';";

				$conn->exec($sql);

			}
			catch(PDOExeption $e)
			{
				parent::writelog("Log.txt", "Error while trying to restore " . session_id(), "a+");
				die("Fehler beim Loeschen aus der Datenbank: " . $e->getMessage());
			}

			echo session_regenerate_id(true);
			// unset($_SESSION);
			$_SESSION["zaehler"]=-1;

			parent::writelog("Log.txt", "Restoring was succesfully. new SessionID: " . session_id() . " " . $_SESSION["zaehler"], "a+");
		}
	}

	new Restorer();
	
?>
