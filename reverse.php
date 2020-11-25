<?php
	//error_reporting(0);
	define('red',"\e[31m");
	define("green","\e[32m");
	define('yellow',"\e[33m");
	class ReverseDomain{
		public $list;
		public function Domain(){
			$site = $this->list;
			$exp = explode("\n", $site);
			$array = array_unique($exp);
			foreach ($array as $http) {
				if(!preg_match('#^http(s)?://#',$http)){
					$a = "http://".$http;
				}
				else {
					$a = $http;
				}
				$parse = parse_url($a);
				$domain = preg_replace('/^www\./', '', $parse['host']);
				$www = "www.".$domain;
      			$host = gethostbyname($www);
      			for ($i=0; $i < $host; $i++) {
       				echo green."[+] $host <== [Success]\n";
         			$open = fopen("result.txt",'a+');
        			fwrite($open,"$host\n");
        			fclose($open);
        			break;
      			}
			}
		}
		public function headerr(){
			echo red."\n
			             #################################
			             #   Mass Reverse Domain To Ip   #
			             #################################";
			echo yellow."
			             #################################
			             #[!] Coded By ./EcchiExploit [!]#
			             #################################\n\n";
		}
	}
	$reverse = new ReverseDomain();
	$reverse->headerr();
	if(!isset($argv[1])){
		echo "USE : php reverse.php list.txt";
		exit(1);
	}
	else {
		$link = $argv[1];
	}
	if(!file_exists($link)) die("File List ".$link." Not Found");
	$domain =  explode("\n", file_get_contents($link));
	echo "[!] Total Reverse Domain To Ip    : " .count($domain)." [!]\n\n";
	foreach ($domain as $env) {
		$reverse->list = trim($env);
		$reverse->Domain();
	}
?>
