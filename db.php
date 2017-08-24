<?php
 // session_start();
	//--------- Baza dom
  /*$dbhost = 'localhost';     
  $dblogin = 'da';
  $dbpass = 'da';
  $dbselect = 'bazapraca';*/
  
  //--------- Baza praca
  $dbhost = 'localhost';     
  $dblogin = 'informatyk';
  $dbpass = 'informatyk';
  $dbselect = 'informatyk';
  mysql_connect($dbhost,$dblogin,$dbpass);
  mysql_select_db($dbselect) or die("Błąd przy wyborze bazy danych");
  mysql_query("SET CHARACTER SET UTF8");
  
?>
