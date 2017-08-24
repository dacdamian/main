<?php

    require_once('db.php');
    $page_title = 'aktywacja konta';
    require_once('header.php');
	require_once('navmenulogout.php');
?>

<?php        
        
$txt ='<hr /><h3><center>Aktywacja nie powiodła się, skontaktuj się z administratorem';
$select = mysql_query("SELECT * FROM `users` WHERE 
    `login`='".mysql_real_escape_string($_GET['login'])."' AND 
    `kod`='".mysql_real_escape_string($_GET['kod'])."'");
if(mysql_num_rows($select) == 1){
    $query = mysql_query("UPDATE `users` SET `aktywne`='1' WHERE 
        `login`='".mysql_real_escape_string($_GET['login'])."' AND 
        `kod`='".mysql_real_escape_string($_GET['kod'])."'"); 
if($query){
    $txt = '<h3><center>Twoje konto zostalo aktywowane';
    }   
}
echo $txt;
echo '<meta http-equiv="refresh" content="5; URL=index.php">';
echo '<p style="padding-top:10px;"><strong>Proszę czekać...</strong><br>trwa wczytywanie danych</center></h3></p>';

?>
<?php
    require_once('footer.php');
?>
