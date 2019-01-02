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
$uczen_pobrany = ($_GET["uczen_pobrany"]);
$obj = (json_decode($uczen_pobrany));
//============================================= OBLICZENIE AKTUALNEJ WARTOŚCI UCZNIA =======================================//
$wartosc_postaci=0;
$elements = array("base","helmet","torso","gloves","pants","boots","weapon");
foreach ($elements as $value)
{
    $sql = "SELECT * FROM $value WHERE ID =".$obj->$value;
    //echo $sql;
    $result = mysqli_query($database,$sql);
    $success = mysqli_num_rows($result);
    if($success>0)
    {
        while ($row=mysqli_fetch_row($result))
        {
            //echo "<br>cena $value: ".$row[2];
            $wartosc_postaci += $row[2];
        }
    }
    else{
        //echo "<br> $value nie kupione.";
    }
}
echo $wartosc_postaci;
?>