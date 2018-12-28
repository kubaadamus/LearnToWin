<?php
//=================================================== UPDATE MONET NA PODSTAWIE OCEN =============================================//
$coins=0;

$mat=5;
$fiz=3;
$pl=2;

$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);

if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
    $id =               $row[0];
    $nazwa_szkoly =     $row[1];
    $imie =             $row[2];
    $nazwisko =         $row[3];
    $klasa =            $row[4];
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

    echo "<br>Twoje oceny zostały zaktualizowane. masz ".$coins." monet.";
}
else{
    echo("NIEPRAWIDŁOWA NAZWA UŻYTKOWNIKA LUB HASŁO, SPRÓBUJ PONOWNIE");
    exit();
}

?>