<?php

//=================================================== PODŁĄCZENIE DO BAZY DANYCH =============================================//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

$login = ($_POST["value"]);
$password = ($_POST["value2"]);

echo "Status podłączenia do bazy danych: ";

if ($database) {
  echo 'conected';
} else {
  echo 'not conected';
}
echo "<br> qfaaaaaa";

echo $login;

$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);

if($success>0)
{
    echo "UDALOSIE QFFAAAAA";
}

?>