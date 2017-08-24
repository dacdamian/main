<?php

        session_start();
        require_once('db.php');
		$foto_size = 300;

        
		  		  
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
</head>
<body>
      
<?php

	$user = $_SESSION['user'];
    $sql = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `login` = '$user' AND aktywne='2'"));
	 
    if (($_SESSION['auth'] == TRUE) && ($sql != 0 )) {
		$page_title = 'Dane uzytkownika';
        require_once('header.php');
		require_once('navmenu.php');
         
           
?>
<div class="container">
Legenda 0 - konto nieaktywne 1 - konto aktywne 2 - admin
<table class="table table-striped" border="0"  width="100%" cellspacing="20" cellpading="10" bgcolor="silver" align="center">
	<thead>
		<tr>
			<th>Zdjęcie</th> <th>ID</th> <th title="0 - konto nieaktywne 1 - konto aktywne 2 - admin">Status</th>	<th>Data utworzenia</th> <th>Login</th> <th>Imie</th> <th>Nazwisko</th> <th>E-mail</th> <th>Data urodzenia</th> <th>Opcje</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$user = "SELECT * FROM users ORDER BY id";
	$result = mysql_query($user) or die("Błąd zapytania:" .mysql_error());
		while ($r = mysql_fetch_array($result)) {
	?>
	<tr align="center">
		<td bgcolor="white">
			<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($r['zdjecie']).'"width="'.$rozmiar_obrazu.'"/>';?>
		</td>
		
		<td bgcolor="white" width="5%">
			<?php echo $r['id']; ?>
		</td>
		<td bgcolor="white" width="5%" title="<?php if($r['aktywne'] > 0) { 
		if($r['aktywne'] == 2) {echo 'konto z uprawneniami administratora'; } else{ echo 'konto aktywne';}}
			else{ echo 'konto nieaktywne';}?>">
			<?php echo $r['aktywne']; ?>
		</td>
		<td bgcolor="white" >
			<?php echo $r['data_utworzenia']; ?>
		</td>
		<td bgcolor="white" >
			<?php echo $r['login']; ?>
		</td>
		<td bgcolor="white" >
			<?php echo $r['imie']; ?>
		</td>
		<td bgcolor="white" >
			<?php echo $r['nazwisko']; ?>
		</td>
		<td bgcolor="white" >
			<?php echo $r['email']; ?>
		</td>
		<td bgcolor="white">
			<?php echo $r['data_urodzenia']; ?>
		</td>
		
		<td bgcolor="white" witdth="10%" alignt="right">
			<a href="?action=edit&id=<?php
			echo $r['id']; ?>">Edytuj</a>
			<a href="?action=delete&id=<?php
			echo $r['id']; ?>&login=<?php
			echo $r['login']; ?>">Usuń</a>
		</td>
	</tr>
	
	<?php
		}?>
		</tbody>
			</table>

<?
		if ($_GET["action"] == "edit") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form class="form-horizontal" method="POST" action="edytuj1.php">
			<fieldset>

			<legend><center><h4><hr />Edycja danych użytkownikao loginie: '.$dane['login'].'</h4></center></legend>
			<form>
			<div class="form-group">
			<label class="col-md-8 control-label">0 - konto nieaktywne 1 - konto aktywne 2 - admin</label>
			</div>
			<div class="form-group">
			  <label class="col-md-5 control-label" for="status">Status</label>  
			  <div class="col-md-3">
			  <input id="status" name="status" type="text" placeholder="status" class="form-control input-md" required="" title="0-niekatywne 1-aktywne 2-admin" value="'.$dane['aktywne'].'">
			  </div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="login">Login</label>  
				<div class="col-md-3">
				<input id="login" name="login" type="text" placeholder="login" class="form-control input-md" required="" value="'.$dane['login'].'">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="haslo">Nowe hasło</label>  
				<div class="col-md-3">
				<input id="haslo" name="haslo" type="password" placeholder="haslo" class="form-control input-md">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="imie">Imie</label>  
				<div class="col-md-3">
				<input id="imie" name="imie" type="text" placeholder="imie" class="form-control input-md" required="" value="'.$dane['imie'].'">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="nazwisko">Nazwisko</label>  
				<div class="col-md-3">
				<input id="nazwisko" name="nazwisko" type="text" placeholder="nazwisko" class="form-control input-md" required="" value="'.$dane['nazwisko'].'">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="nazwisko">E-mail</label>  
				<div class="col-md-3">
				<input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="" value="'.$dane['email'].'">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="data_urodzenia">Data urodzenia</label>  
				<div class="col-md-3">
				<input id="data_urodzenia" name="data_urodzenia" type="date" placeholder="email" class="form-control input-md" required="" value="'.$dane['data_urodzenia'].'">
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
			$login = $_GET['login'];
			
			$result = mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			echo '
			<form class="form-horizontal" method="POST" action="delete.php">
			<fieldset>

			<legend><center><h4><hr />Usunięcie użytkownika o loginie: '.$dane['login'].'</h4></center></legend>
			<form>
			<div class="form-group">
			<label class="col-md-9 control-label"><h3>Czy napewno chcesz usunąć konto o loginie '.$login.'?</h3></label>
			</div>
			
			<div class="form-group">
			  <label class="col-md-8 control-label" for="submit"></label>
			  <div class="col-md-4">
				<input type="hidden" id="login" name="login" value="'.$dane['login'].'">
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
		if ($_SESSION['auth'] == TRUE)  {
		$page_title = 'Strona startowa';
		require_once('header.php');
		require_once('navmenu.php');
        echo '<meta http-equiv="refresh" content="5; URL=index.php">';
        echo '<div class="container"><h3><p style="padding-top:10px;"><center><strong>Próba nieautoryzowanego dostępu...</strong><br>
		trwa przenoszenie do strony głównej</center></p></h3></div>';}
		
		else{
		$page_title = 'Strona startowa';
		require_once('header.php');
		require_once('navmenulogout.php');
        echo '<meta http-equiv="refresh" content="5; URL=index.php">';
        echo '<div class="container"><h3><p style="padding-top:10px;"><center><strong>Próba nieautoryzowanego dostępu...</strong><br>
		trwa przenoszenie do formularza logowania</center></p></h3></div>';
    }}
?>
 
<?php

  require_once('footer.php');
  
?>
	 
</body>
</html>
<?
/*$wynik = "SELECT login, imie, nazwisko, email, data_urodznia, zdjecie FROM users";
 
echo ".$wynik.";
?>*/