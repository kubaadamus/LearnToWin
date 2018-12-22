<?php

$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;

$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

echo "Status podłączenia do bazy danych: ";
if ($database) {
  echo 'conected';
} else {
  echo 'not conected';
}
echo "<br>";

$login = ($_GET["login"]);
$password = ($_GET["password"]);
$ranga;
$srednia;

$mat=5;
$fiz=3;
$pl=2;
$coins=0;


//Złap tutaj wszystkie wiersze odppwiadające uczniowi o indeksie 1 i wyłącznie z matematyki.

//Iterując przez wiersze, pobieraj datę i ocenę. Tworz z tego dwie tabele - date i note. date będą do labeli a note będą do data.
//Przedmioty//
$mat_date = array();
$mat_note = array();
$mat_coins = 0.0;

$fiz_date = array();
$fiz_note = array();
$fiz_coins = 0.0;

$inf_date = array();
$inf_note = array();
$inf_coins = 0.0;

$pl_date = array();
$pl_note = array();
$pl_coins = 0.0;
//==============//

$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);

$success = mysqli_num_rows($result);

if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
    $id = $row[0];
    $ranga = $row[11];
    }

    echo "<h1>Witaj ".$login." ".$password."</h1>";

    printRow("Twoja ranga: ".$ranga);

    $sql = "SELECT * FROM oceny WHERE uczen_ID = '".$id."'" ;
    $result = mysqli_query($database,$sql);

    while ($row=mysqli_fetch_row($result))
    {
    //printRow($row[0]."\t".$row[1]."\t".$row[2]."\t".$row[3]."\t".$row[4]."\t".$row[5]."\t");
    $average += $row[3];

        if($row[2]=="mat")
    {
        $coins += $mat*$row[3];
        $mat_coins += $mat*$row[3];
        //dodawaj do date i note//
        array_push($mat_date, $row[5]);
        array_push($mat_note, $row[3]);
    }
    if($row[2]=="fiz")
    {
        $coins += $fiz*$row[3];
        $fiz_coins += $fiz*$row[3];
        array_push($fiz_date, $row[5]);
        array_push($fiz_note, $row[3]);
    }
    if($row[2]=="pl")
    {
        $coins += $pl*$row[3];
        $pl_coins += $pl*$row[3];
        array_push($pl_date, $row[5]);
        array_push($pl_note, $row[3]);
    }

    }

    echo "Punkty: ".$coins;

}
else{
    printRow("NIEPRAWIDŁOWA NAZWA UŻYTKOWNIKA LUB HASŁO, SPRÓBUJ PONOWNIE");
}

function printRow($a){
echo $a."<br/>";
}
?>