<?php
		$rozmiar_obrazu = '60';
        session_start();
        require_once('db.php');
		

        
		  		  
?>
<html lang="pl_PL">
<head>
    <meta http-equiv="Content-type" CONTENT="text/html; charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formularz rejestracyjny html</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.js" language="javascript" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<style>
	td { font-size: 13px; }
	</style>
</head>
<body>
      
<?php

	$user = $_SESSION['user'];
    $sql = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `login` = '$user' AND aktywne='2'"));
	 
    if ($_SESSION['auth'] == TRUE) {
		$page_title = 'Edycja menu';
        require_once('header.php');
		require_once('navmenu.php');
		if($sql != 0 ) {
        
           
?>
<div class="container">
<a href="?action=addzamowienie">Dodaj zamówienie</a>

<table class="table table-striped" border="0"  width="100%" cellspacing="20" cellpading="10" bgcolor="silver" align="center">
	<thead>
		<tr>
			<th>ID</th> <th>Data utworzenia</th> <th>Nazwa (składniki)</th> <th>Cena</th> <th>Status</th> <th>Dane Klienta</th> <th>E-mail</th> <th>Telefon</th> <th>Opcje</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$menu = "SELECT z.id, z.data_utworzenia, m.nazwa, m.skladniki, m.cena, z.status, s.imie, s.nazwisko, s.email, dd.adres, dd.telefon
	FROM zamowienia z INNER JOIN menu m ON z.id_menu = m.id
	INNER JOIN users s ON z.id_users = s.id
	INNER JOIN dod_dane dd ON dd.id = z.id_dod_dane 
	ORDER BY z.id";
	$result = mysql_query($menu) or die("Błąd zapytania:" .mysql_error());
		while ($r = mysql_fetch_array($result)) {
			$adres = $r['s.adres'];
			$adres1 = $r['dd.adres'];
			$telefon = $r['s.telefon'];
			$telefon1 = $r['dd.telefon'];
	?>
	<tr align="left">
		
		<td bgcolor="white" width="5%">
			<?php echo $r['id']; ?>
		</td>
		
		<td bgcolor="white" >
			<?php echo $r['data_utworzenia']; ?>
		</td>
		
		<td bgcolor="white" >
			
			<b><?php echo $r['nazwa']; ?></b><br>
		
			<font size="1">(<?php echo $r['skladniki']; ?>)</font>
		</td>
		
		<td bgcolor="white">
			<?php echo $r['cena']; ?> zł
		</td>
		
		<td bgcolor="white">
			<?php echo $r['status']; ?>
		</td>
		
		<td bgcolor="white">
			<?php echo $r['imie']; ?>
			
			<?php echo $r['nazwisko']; ?><br>
			(<?php echo $r['adres']; ?>)
		</td>
		
		<td bgcolor="white">
			<?php echo $r['email']; ?>
		</td>
		
		<td bgcolor="white">
			<?php echo $r['telefon']; ?>
		</td>
		
		<td bgcolor="white" witdth="5%" alignt="right">
			<a href="?action=edit&id=<?php
			echo $r['id']; ?>">Edytuj</a>
			<a href="?action=delete&id=<?php
			echo $r['id']; ?>&nazwa=<?php
			echo $r['nazwa']; ?>">Usuń</a>
		</td>
	</tr>
	
	<?php
		}?>
		</tbody>
			</table>

<?
		if ($_GET["action"] == "addzamowienie") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="addzamowienie.php">
			<fieldset>

			<legend><center><h4><hr />Zamów pizze '. $dane['nazwa'].' za '.$dane['cena'].' zł'.$dane['id'].'</h4></center></legend>
			<form>
			
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="pizza">Pizza</label>  
				<div class="col-md-3">
					<select name="pizza">
						';
	$result1 = mysql_query("SELECT * FROM menu") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="user">Użytkownik</label>  
				<div class="col-md-3">
					<select name="user">
						';
	$result1 = mysql_query("SELECT * FROM users") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['login'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="adres">Adres</label>  
				<div class="col-md-3">
				<input id="adres" name="adres" type="text" placeholder="adres" class="form-control input-md">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="telefon">Telefon</label>  
				<div class="col-md-3">
				<input id="telefon" name="telefon" type="text" placeholder="telefon" class="form-control input-md">
				</div>
			</div>
				
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="submit"></label>
			  <div class="col-md-3">
				<input type="hidden" id="id" name="id">
				<button id="submit" name="submit" class="btn btn-success">Zamów</button>
				</div>
			</div>
			</fieldset>
			</form>';
			
			
		}	
		
		if ($_GET["action"] == "edit") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="editmenu.php">
			<fieldset>

			<legend><center><h4><hr />Edycja pizzy: '.$dane['nazwa'].'</h4></center></legend>
			<form>
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="zdjecie">Zdjęcie</label>  
			  <div class="col-md-3">
			  <input id="zdjecie" name="zdjecie" type="file" placeholder="zdjecie" class="form-control input-md">  
			  </div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="nazwa">Nazwa</label>  
				<div class="col-md-3">
				<input id="nazwa" name="nazwa" type="text" placeholder="nazwa" class="form-control input-md" required="" value="'.$dane['nazwa'].'">
				</div>
			</div>
			
			<<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 1</label>  
				<div class="col-md-3">
					<select name="skladnik1">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 2</label>  
				<div class="col-md-3">
					<select name="skladnik2">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 3</label>  
				<div class="col-md-3">
					<select name="skladnik3">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 4</label>  
				<div class="col-md-3">
					<select name="skladnik4">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="cena">Cena</label>  
				<div class="col-md-3">
				<input id="cena" name="cena" type="text" placeholder="cena" class="form-control input-md" required="" value="'. $dane['cena']. '">
				</div>
			</div>
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="submit"></label>
			  <div class="col-md-3">
				<input type="hidden" id="id" name="id" value="'.$dane['id'].'">
				<button id="submit" name="submit" class="btn btn-success">Edytuj</button>
				</div>
			</div>
			</fieldset>
			</form>';
			
			
		}
		if($_GET['action']  == "delete") {
			$id = $_GET['id'];
			$nazwa = $_GET['nazwa'];
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			echo '
			<form class="form-horizontal" method="POST" action="deletemenu.php">
			<fieldset>

			<legend><center><h4><hr />Usunięcie pizzy: '.$dane['nazwa'].'</h4></center></legend>
			<form>
			<div class="form-group">
			<label class="col-md-9 control-label"><h3>Czy napewno chcesz usunąć pizzę '.$nazwa.'?</h3></label>
			</div>
			
			<div class="form-group">
			  <label class="col-md-8 control-label" for="submit"></label>
			  <div class="col-md-4">
				<input type="hidden" id="login" name="login" value="'.$dane['nazwa'].'">
				<input type="hidden" id="id" name="id" value="'.$dane['id'].'">
				<button id="submit" name="submit" class="btn btn-success"> TAK </button>
				</div>
			</div>
			</fieldset>
		</form>
		</div>';}
			
			
	?>

			
<?php
    }
    else {
		
		$page_title = 'Menu';
		require_once('header.php');
		require_once('navmenu.php');
		
	?>
		
		<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							Pizza
						</th>
						<th>
							Składniki
						</th>
						<th>
							Cena
						</th>
						<th>
							Status zamówienia
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
	$menu = "SELECT z.id, m.nazwa, m.skladniki, m.cena, z.status 
	FROM menu m INNER JOIN zamowienia z ON m.id = z.id_menu 
	INNER JOIN users s ON s.id = z.id_users 
	WHERE s.login='$user'
	ORDER BY z.id";
	$result = mysql_query($menu) or die("Błąd zapytania:" .mysql_error());
		while ($r = mysql_fetch_array($result)) {
	?>
					<tr>
						<td>
							<?php echo $r['id']; ?>
						<td>
							<?php echo $r['nazwa']; ?>
						</td>
						<td>
							<?php echo $r['skladniki']; ?>
						</td>
						<td>
							<?php echo $r['cena']; ?> PLN
						</td>
						<td>
							<?php echo $r['status']; ?> 
						</td>
						
						<?php if ($aktywne > 0){ ?>
						<td bgcolor="white" witdth="5%" alignt="right">
							<a href="?action=deletezamowienie&id=<?php
							echo $r['id']; ?>">Dodaj</a>
						</td>
						<?php } ?>
					</tr>
					
	<?php
		}?>
				</tbody>
			</table>
			<?
		if ($_GET["action"] == "addzamowienie") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="addzamowienie.php">
			<fieldset>

			<legend><center><h4><hr />Zamów pizze '. $dane['nazwa'].' za '.$dane['cena'].' zł'.$dane['id'].'</h4></center></legend>
			<form>
			
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="submit"></label>
			  <div class="col-md-3">
				<input type="hidden" id="id" name="id" value="'.$dane['id'].'">
				<button id="submit" name="submit" class="btn btn-success">Zamów</button>
				</div>
			</div>
			</fieldset>
			</form>';
			
			
		}?>
		</div>
	</div>
</div>
 <?php  
 
	}}
 else {
          echo '<meta http-equiv="refresh" content="5; URL=index.php">';
          echo '<p style="padding-top:10px;"><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
    }
		
    

 


  require_once('footer.php');
  
?>
	 
</body>
</html>