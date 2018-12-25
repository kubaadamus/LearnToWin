<?php

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

//Współczynniki ocen
$mat=5;
$fiz=3;
$pl=2;
$coins=0;

//Sprawdzenie legitności logującego się ucznia i pobranie rzeczy
$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
    $id = $row[0];
    $ranga = $row[11];
    $baza = $row[13];
    $helm = $row[14];
    $maska = $row[15];
    $rekawice = $row[16];
    $torso = $row[17];
    $spodnie = $row[18];
    $buty = $row[19];
    $bron = $row[20];
    $apteczka = $row[21];
    $granaty = $row[22];
    $secondary = $row[23];
    $spec1 = $row[24];
    $spec2 = $row[25];
    $spec3 = $row[26];
    }
    echo "<h1>Witaj ".$login." ".$password."</h1>";
    $sql = "SELECT * FROM oceny WHERE uczen_ID = '".$id."'" ;
    $result = mysqli_query($database,$sql);
    while ($row=mysqli_fetch_row($result))
    {
        if($row[2]=="mat")
        {
            $coins += $mat*$row[3];
        }
        if($row[2]=="fiz")
        {
            $coins += $fiz*$row[3];
        }
        if($row[2]=="pl")
        {
            $coins += $pl*$row[3];
        }
    }
    $sql_updateCoins = "UPDATE uczniowie SET coins = $coins WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
    mysqli_query($database, $sql_updateCoins); //Tutaj baza danych otrzymuje aktualną wartość coins
}
else{
    printRow("NIEPRAWIDŁOWA NAZWA UŻYTKOWNIKA LUB HASŁO, SPRÓBUJ PONOWNIE");
}
?>