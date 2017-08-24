<?php   
        
        require_once('db.php');
        session_start();
        
        $page_title = 'zmiana zdjecia';
        require_once('header.php');

        // error_reporting(E_ALL ^ E_NOTICE);
        $login = $_SESSION['user'];
        $zdjecie = addslashes(file_get_contents($_FILES['zdjecie']['tmp_name']));
		
        
?>

<html lang="pl_PL">
<head>
    <meta http-equiv="Content-type" CONTENT="text/html; charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skrypt rejestracji z wykorzystaniem PHP i bazy MySQL</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        
<?php
		if((empty($login)) || (empty($zdjecie))) {
			require_once('navmenu.php');
			echo '<center>Zdjecie nie zostało zmienione</center>';
			echo '<meta http-equiv="refresh" content="1; URL=hide4.php">';
		}
		else{
        $query = "UPDATE users SET zdjecie='$zdjecie' WHERE login='$login'";
        mysql_query($query);
		require_once('navmenu.php');
        echo '<hr /><center>Zdjęcie zmienione</center>';
        echo '<meta http-equiv="refresh" content="1; URL=hide4.php">';
		}
    
?>
<?php
    require_once('footer.php');
?>