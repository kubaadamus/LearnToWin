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





?>