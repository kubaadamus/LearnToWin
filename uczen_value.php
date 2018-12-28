<?php
//============================================= OBLICZENIE AKTUALNEJ WARTOŚCI UCZNIA =======================================//
$wartosc_postaci=0;
$elements = array("base","helmet","torso","gloves","pants","boots","weapon");
foreach ($elements as $value)
{

    $sql = "SELECT * FROM $value WHERE ID =".$uczen_pobrany->$value;
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
$spendable_coins = $coins-$wartosc_postaci;


echo "<br>aktualna wartosc postaci to: ".$wartosc_postaci;
echo "<br> Możesz wydać: ".($spendable_coins)."<br>";
?>