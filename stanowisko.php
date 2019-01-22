<?php
session_start();
function clear($text) {
   // jeśli serwer automatycznie dodaje slashe to je usuwamy
    if(get_magic_quotes_gpc()) {
        $text = stripslashes($text);
    }
    $conn = mysqli_connect("localhost", "root", "", "database") or die('<h2>ERROR</h2> MySQL Server is not responding');
    $text = trim($text); // usuwamy białe znaki na początku i na końcu
    $text = mysqli_real_escape_string($conn, $text); // filtrujemy tekst aby zabezpieczyć się przed sql injection
    $text = htmlspecialchars($text); // dezaktywujemy kod html
    return $text;
}

$conn = mysqli_connect("localhost", "root", "", "database") or die('<h2>ERROR</h2> MySQL Server is not responding');


 
    // wyświetlamy komunikat na zalogowanie się
    include 'formularz.php';
	if(@!$_SESSION['logged']) {
    // jeśli zostanie naciśnięty przycisk "Zaloguj"
    if(isset($_POST['login'])) {
        // filtrujemy dane...
        $_POST['login'] = clear($_POST['login']);
        $_POST['haslo'] = clear($_POST['haslo']);
        // i kodujemy hasło
       
 
        // sprawdzamy prostym zapytaniem sql czy podane dane są prawidłowe
        $result = mysqli_query($conn, "SELECT * FROM pracownik WHERE login = '{$_POST['login']}' AND haslo = '{$_POST['haslo']}' LIMIT 1");
        if(mysqli_num_rows($result) > 0) {
            // jeśli tak to ustawiamy sesje "logged" na true oraz do sesji "user_id" wstawiamy id usera
			   $row = mysqli_fetch_assoc($result);
            $_SESSION['logged'] = true;
            //$_SESSION['user_id'] = $row['ID'];
			$_SESSION['Identyfikator'] = $row['idPrac'];
			$Nazwa = $row['login'];
			$Nazwisko = $row['nazwisko'];
			$Imie = $row['imie'];

			
			header('Location: indexPersonel.php');
			
			
        } else {
            echo '<p>Podany login i/lub hasło jest nieprawidłowe.</p>';
        }
    }
} else { 
	header('Location: indexPersonel.php');
}


?>