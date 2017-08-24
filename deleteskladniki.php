<?php
        require_once('db.php');
        session_start();
        
        $page_title = 'Edycja';
        require_once('header.php');

       // error_reporting(E_ALL ^ E_NOTICE);
        
        $login = $_POST["login"];
		$nazwa = $_POST["nazwa"];
		$id = $_POST["id"];
		
		
			
		
               

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
		
			if(isset($id)){
            $delete = "DELETE FROM skladniki WHERE id='$id'";
                mysql_query($delete);
				
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="1; URL=skladniki.php">';
                echo '<hr /><h3><center>Rekord usunięty.</center></h3>';
			}
			else{
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="1; URL=skladniki.php">';
                echo '<hr /><h3><center>Nie udało się usunąć pozycji.</center></h3>';
			}
				
        

        ?>
        <?php
        require_once('footer.php');
        ?>
    </body>
</html>