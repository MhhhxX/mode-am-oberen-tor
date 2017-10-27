<?php

	class Logger
	{
		private $path;

		public function __construct()
		{}

		// Construtor to define defaultpath
		public function __construct1($path)
		{
			$this->path = $path;
		}

		protected function writelog($File, $text, $mode)
		{
			$time = self::getCurrentTimeStamp();

			if(isset($this->path))
				$Log = fopen($this->path . $File, $mode);
			else 
				$Log = fopen($File, $mode);
			if($Log == FALSE)
				return -1;
			if(fwrite($Log, $time . " " . $text . "\n") == FALSE)
				return 0;
			if(fclose($Log) == FALSE)
				return -2; 

			return 1;
		}

		protected function writehtml($File, $text, $mode)
		{
			if(isset($this->path))
				$Log = fopen($this->path . $File, $mode);
			else 
				$Log = fopen($File, $mode);
			if($Log == FALSE)
				return -1;
			if(fwrite($Log, $text . "\n") == FALSE)
				return 0;
			if(fclose($Log) == FALSE)
				return -2; 

			return 1;
		}

		protected function getCurrentTimeStamp()
		{
			$timeStamp = time();
			$date = date("d.m.Y", $timeStamp);
			$time = date("H:i:s",$timeStamp);
			$currentTime = $date . " " . $time;

			return $currentTime;
		}
	}

	$bla = new Logger();
?>