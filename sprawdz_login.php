<?php
require_once('db.php');
session_start();



//czy login istnieje w systemie
if(!empty($_POST["login"])) {
	$login = $_POST["login"];
	$old_login = $_SESSION['user'];
    $result = mysql_query("SELECT count(*) FROM users WHERE login='" . $login . "'");
    $row = mysql_fetch_row($result);
    $user_count = $row[0];
    if(($user_count>0) && ($old_login != $login)) echo "<span class='status-not-available'> Login zajęty.</span>";
	elseif($old_login == $login) echo "<span class='status-available'>To jest Twój login.</span>";
    else echo "<span class='status-available'> Login wolny.</span>";
}
if(!empty($_POST["login1"])) {
    $result = mysql_query("SELECT count(*) FROM users WHERE login='" . $_POST["login1"] . "'");
    $row = mysql_fetch_row($result);
    $user_count = $row[0];
    if($user_count>0) echo "<span class='status-not-available'> Login istnieje w systemie.</span>";
    else echo "<span class='status-available'> Brak konta o takim loginie.</span>";
}

//czy email istnieje
if(!empty($_POST["email"])) {
	$email = $_POST["email"];
	$old_login = $_SESSION['user'];
	$old = mysql_query("SELECT * FROM users WHERE login='". $old_login ."'");
	if(mysql_num_rows($old) > 0 ) {
	  
            while($r = mysql_fetch_assoc($old)) {
              
				$old_email = $r['email'];   }
	}
    $result1 = mysql_query("SELECT count(*) FROM users WHERE email='" . $_POST["email"] . "'");
    $row1 = mysql_fetch_row($result1);
    $email_count = $row1[0];
    if(($email_count>0) && ($old_email != $email)) echo "<span class='status-not-available'> Email zajęty.</span>";
	elseif($old_email == $email) echo "<span class='status-not-available'>To jest Twój login.</span>";
    else echo "<span class='status-available'> Email wolny.</span>";
}

//czy haslo jest dobrze wpisane
if(!empty($_POST["haslo"])) {
    $haslo3 = $_POST["haslo"];
    $haslo3 = md5($haslo3);
    $result2 = mysql_query("SELECT count(*) FROM users WHERE haslo='" . $haslo3 . "'");
    $row2 = mysql_fetch_row($result2);
    $haslo_count = $row2[0];
    if($haslo_count>0) echo "<span class='status-not-available'> Hasło poprawne.</span>";
    else echo "<span class='status-available'> Hasło niepoprawne</span>";
}

?>