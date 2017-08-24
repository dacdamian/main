<?php
        require_once('db.php');
        session_start();
        
        $page_title = 'Edycja';
        require_once('header.php');

       // error_reporting(E_ALL ^ E_NOTICE);
        
        $login = $_POST["login"];
		$nazwa = $_POST["nazwa"];
		$id = $_POST["id"];
		$stan = $_POST["stan"];
		$zdjecie = addslashes(file_get_contents($_FILES['zdjecie']['tmp_name']));
		$cena = $_POST["cena"];
		$s1 = $_POST['skladnik1'];
		$s2 = $_POST['skladnik2'];
		$s3 = $_POST['skladnik3'];
		$s4 = $_POST['skladnik4'];
		$skladniki = array($s1, $s2, $s3, $s4);
		$separator = implode(",", $skladniki);
			
		echo $separator;
		
		
               

?>

<html lang="pl_PL">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skrypt edycji z wykorzystaniem PHP i bazy MySQL</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        
        <?php
		
			if(!empty($zdjecie)) {
            $update = "UPDATE menu SET nazwa='$nazwa', zdjecie='$zdjecie', data_utworzenia=NOW(), cena='$cena', skladniki='$separator' WHERE id='$id'";
                mysql_query($update);
				echo $update;
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="1; URL=menu.php">';
                echo '<hr /><h3><center>Rekord zaktualizowany.</center></h3>';
			}
				else {
					$update1 = "UPDATE menu SET nazwa='$nazwa', data_utworzenia=NOW(), cena='$cena', skladniki='$separator' WHERE id='$id'";
					mysql_query($update1);
					echo $update1;
					require_once('navmenu.php');
					echo '<meta http-equiv="refresh" content="1; URL=menu.php">';
					echo '<hr /><h3><center>Rekord zaktualizowany.</center></h3>';
					
				}
				
				
        

        ?>
        <?php
        require_once('footer.php');
        ?>
    </body>
</html>