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
		
		$login_tel = $_POST['user'];
		$login_tel_query = mysql_query("SELECT id FROM users WHERE login='$login_tel'");
		$id_login = mysql_fetch_array($login_tel_query);
		$id_login = $id_login['id'];
		$adres = $_POST['adres'];
		$telefon = $_POST['telefon'];
		$max = mysql_result(mysql_query("SELECT max(id) FROM users"), 0);
		$max = $max+1;
		
		var_dump($login_tel);
		
		
		var_dump($id_login);
		var_dump($id_pizza);
		
		
		var_dump($adres);
		var_dump($telefon);
		

               

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
		
			if(isset($id_user)) {
				if((isset($id_menu)) && (empty($id_pizza))) {
				$insert = "INSERT INTO zamowienia SET id_users='$id_user', id_menu='$id_menu', data_utworzenia=NOW()";
                mysql_query($insert);
				
				var_dump($insert);
				require_once('navmenu.php');
				echo '<meta http-equiv="refresh" content="10; URL=menu.php">';
                echo '<hr /><h3><center>Zamówienie przekazane do kolejki1.</center></h3>';
				}
				else {
					if($id_login == 0) {
						$add_adres = mysql_query("INSERT INTO dod_dane SET adres='$adres', telefon='$telefon'");
						$sql = mysql_query("SELECT id FROM dod_dane WHERE adres='$adres', telefon='$telefon'");
						$update = "UPDATE users SET id_dod_dane='$sql' WHERE id=0";
						mysql_query($update);
						var_dump($add_adres);
						if($add_adres == 1) {
							$insert1 = "INSERT INTO zamowienia SET id_users='$id_login', id_menu='$id_pizza', data_utworzenia=NOW()";
							mysql_query($insert1);
							require_once('navmenu.php');
							echo '<meta http-equiv="refresh" content="10; URL=zamowienia.php">';
							echo '<hr /><h3><center>Zamówienie przekazane do kolejki2.</center></h3>';
						}
						else {
								require_once('navmenu.php');
								echo '<meta http-equiv="refresh" content="10; URL=zamowienia.php">';
								echo '<hr /><h3><center>Błąd dodania danych kontaktowych.</center></h3>';
								echo ' błąd dodania danych kontaktowych';
						}
					}
					else {
						
					$insert2 = "INSERT INTO zamowienia SET id_users='$id_login', id_menu='$id_pizza', data_utworzenia=NOW()";
					mysql_query($insert2);
					var_dump($insert2);
					require_once('navmenu.php');
					echo '<meta http-equiv="refresh" content="10; URL=zamowienia.php">';
					echo '<hr /><h3><center>Zamówienie przekazane do kolejki.</center></h3>';
					}
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