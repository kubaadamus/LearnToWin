<?php
//=================================================== PODŁĄCZENIE DO BAZY DANYCH =============================================//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());
$login = ($_GET["name1"]);
$password = ($_GET["name2"]);
$coinsOrNotes = ($_GET["coinsOrNotes"]);
//=================================================== UPDATE MONET NA PODSTAWIE OCEN =============================================//
$coins=0;
$mat=5;
$fiz=3;
$pl=2;
$sql = "SELECT * FROM uczniowie WHERE name1 = '".$login."' AND name2 = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
$OcenaArray = array();
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
    $id =               $row[0];
    }
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
        array_push($OcenaArray,new Ocena($row[2],$row[3],$row[5]));
    }
    $coins = intval($coins);
    $sql_updateCoins = "UPDATE uczniowie SET coins = $coins WHERE name1 = '".$login."' AND name2 = '".$password."'" ;
    mysqli_query($database, $sql_updateCoins); //Tutaj baza danych otrzymuje aktualną wartość coins

    if($coinsOrNotes=="coins")
    {
        echo intval($coins);
    }
    else
    {
        echo(json_encode($OcenaArray));
    }

    

}
else{
    echo("NIEPRAWIDŁOWA NAZWA UŻYTKOWNIKA LUB HASŁO, SPRÓBUJ PONOWNIE");
    exit();
}

class Ocena{

    function __construct($type,$value,$date)
    {
        $this->type=$type;
        $this->value=$value;
        $this->date=$date;
    }
}

?>