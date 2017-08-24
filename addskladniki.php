<?php
        require_once('db.php');
        session_start();
        
        $page_title = 'Dodawanie';
        require_once('header.php');

       // error_reporting(E_ALL ^ E_NOTICE);
        
        $login = $_POST["login"];
		$nazwa = $_POST["nazwa"];
		$id = $_POST["id"];
		$stan = $_POST["stan"];
		$zdjecie = addslashes(file_get_contents($_FILES['zdjecie']['tmp_name']));
			
		
               

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
            $update = "INSERT INTO skladniki SET nazwa='$nazwa', stan='$stan', zdjecie='$zdjecie', data_utworzenia=NOW()";
                mysql_query($update);
				
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="1; URL=skladniki.php">';
                echo '<hr /><h3><center>Rekord zaktualizowany.</center></h3>';
			}
				else {
					$update1 = "INSERT INTO skladniki SET nazwa='$nazwa', stan='$stan', data_utworzenia=NOW()";
					mysql_query($update1);
					
					require_once('navmenu.php');
					echo '<meta http-equiv="refresh" content="1; URL=skladniki.php">';
					echo '<hr /><h3><center>Rekord zaktualizowany.</center></h3>';
					
				}
				
				
        

        ?>
        <?php
        require_once('footer.php');
        ?>
    </body>
</html>