<?php

//=================================================== PODŁĄCZENIE DO BAZY DANYCH =============================================//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

$login = ($_GET["login"]);
$password = ($_GET["password"]);

echo "Status podłączenia do bazy danych: ";

if ($database) {
  echo 'conected';
} else {
  echo 'not conected';
}
echo "<br>";

include 'coins_update.php'; // Skrypt pobierający oceny ucznia z bazy danych i na ich podstawie aktualizujący maksymalną zasobność punktową ucznia w bazie.
include 'classes.php';      // Zbiór klas 
include 'user_create.php';  // Pobranie jsona ucznia z bazy danych i dekodowanie go na objekt PHP o nazwie $uczen_pobrany
include 'uczen_value.php';  // Sprawdzenie ile wolnych monet zostaje do dyspozycji ucznia, biorąc pod uwagę obecny stan uzbrojenia brany z bazy danych
include 'armory_create.php';       // Pobranie wszystkich rodzajów uzbrojenia z bazy danych i wepchnięcie ich do odpowiednich tablic



?>