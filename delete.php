<?php
        require_once('db.php');
        session_start();
        
        $page_title = 'Usunięcie';
        require_once('header.php');

       // error_reporting(E_ALL ^ E_NOTICE);
        
        $login = $_POST["login"];
		$id = $_POST["id"];
		var_dump($id);
		var_dump($login);
		
               

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
		
        if((!empty($id)) && (!empty($login)))  {
			
			
            $delete = "DELETE FROM users WHERE login='$login' and id='$id'";
                mysql_query($delete);
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="3; URL=users.php">';
                echo '<hr /><h3><center>Użytkownik usunięty.</center></h3>';
				
				}
						
				else{
					require_once('navmenu.php');
					echo '<p style="padding-top:10px;"><hr /><h3><center>Nie udalo sie usunąć konta.</center></h3>';
				}
        

        ?>
        <?php
        require_once('footer.php');
        ?>
    </body>
</html>