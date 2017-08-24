<?php
        require_once('db.php');
        session_start();
        
        $page_title = 'Dodawanie';
        require_once('header.php');

       // error_reporting(E_ALL ^ E_NOTICE);
		//$id = $_POST["id"];
		$id_menu = $_POST["id"];
        $login = $_SESSION['user'];
		$user = mysql_query("SELECT id FROM users WHERE login='$login'");
		$id_user = mysql_fetch_array($user);
		$id_user = $id_user['id'];
		$nazwa = $_POST["nazwa"];
		$pizza = $_POST["pizza"];
		$pizza_id = mysql_query("SELECT id FROM menu WHERE nazwa='$pizza'");
		$id_pizza = mysql_fetch_array($pizza_id);
		$id_pizza = $id_pizza['id'];
		$adres = $_POST['adres'];
		$telefon = $_POST['telefon'];
		$max = mysql_result(mysql_query("SELECT max(id) FROM users"), 0);
		$max = $max+1;
		echo $max;
		var_dump($max);
		var_dump($max_id);
		
		
		var_dump($adres);
		var_dump($telefon);
		var_dump($id_menu);
		var_dump($id_user);

               

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
		
			if(!empty($id_user)) {
				if(!empty($id_menu)) {
				$insert = "INSERT INTO zamowienia SET id_users='$id_user', id_menu='$id_menu', data_utworzenia=NOW()";
                mysql_query($insert);
				var_dump($insert);
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="10; URL=menu.php">';
                echo '<hr /><h3><center>Zamówienie przekazane do kolejki.</center></h3>';
				}
				if(!empty($id_pizza)) {
					$insertuser = "INSERT INTO users id='$max'";
				$insertdane = "INSERT INTO dod_dane SET telefon='$telefon', adres='$adres', id_user='$max'";
				mysql_query($insertdane);
				$dane = mysql_query("SELECT id_users FROM dod_dane WHERE telefon='$telefon and adres='$adres'");
				$insert1 = "INSERT INTO zamowienia SET id_users='$max', id_menu='$id_pizza', data_utworzenia=NOW()";
                mysql_query($insert1);
				var_dump($insert1);
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="10; URL=menu.php">';
                echo '<hr /><h3><center>Zamówienie przekazane do kolejki.</center></h3>';
				}
			}
				else {
					require_once('navmenu.php');
					echo '<meta http-equiv="refresh" content="10; URL=menu.php">';
					echo '<hr /><h3><center>Dodanie nie powiodło się.</center></h3>';
					
				}
				
				
        

        ?>
        <?php
        require_once('footer.php');
        ?>
    </body>
</html>