<html>
<head>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js'></script>
</head>
</html>



<?php
//-------------------------------------- Ł Ą C Z E N I E  Z  B A Z Ą  D A N Y C H ------------------------------------------//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$login = ($_GET["login"]);
$sell_buy = ($_GET["sellbuy"]);
$password = ($_GET["password"]);
$item = ($_GET["item"]);
$id = ($_GET["id"]);

$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

echo "Status podłączenia do bazy danych: ";
if ($database) {
  echo 'conected';
} else {
  echo 'not conected';
}
echo "<br>";




$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
        $coins = $row[5];
    }
}

class uczen_object
{

   //Ekwipunek
   public $base = 0;
   public $helmet = 0;
   public $torso = 0;
   public $gloves = 0;
   public $pants = 0;
   public $boots = 0;
   public $weapon = 0;

 
   public function __construct($_base=0, $_helmet=0, $_torso=0, $_gloves=0, $_pants=0, $_boots=0, $_weapon=0)
   {
      //Ekwipunek
      $this->base = $_base;
      $this->helmet = $_helmet;
      $this->torso = $_torso;
      $this->gloves = $_gloves;
      $this->pants = $_pants;
      $this->boots = $_boots;
      $this->weapon = $_weapon;
      $this->wypisz();
   }
   public function wypisz(){
       //Ekwipunek
       debug_to_console("base:".$this->base);
       debug_to_console("helmet:".$this->helmet);
       debug_to_console("torso:".$this->torso);
       debug_to_console("gloves:".$this->gloves);
       debug_to_console("pants:".$this->pants);
       debug_to_console("boots:".$this->boots);
       debug_to_console("weapon:".$this->weapon);
       debug_to_console("--------------------------------");
   }
}


    $sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
    $result = mysqli_query($database,$sql);
    $success = mysqli_num_rows($result);
    if($success>0)
    {
        while ($row=mysqli_fetch_row($result))
        {
            $uczen_pobrany = json_decode($row[6]);
        }
    }

echo "<br>".json_encode($uczen_pobrany);


//============================================= OBLICZENIE AKTUALNEJ WARTOŚCI UCZNIA =======================================//
$wartosc_postaci=0;
$elements = array("base","helmet", "torso","gloves",);
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

//echo "<br>wartosc postaci: ".$wartosc_postaci;

//echo "<br> Możesz wydać: ".($coins-$wartosc_postaci);








if($sell_buy=='sell')
{
    echo "Odkładamy: ".$item;
    $uczen_pobrany->$item = 0;
}
if($sell_buy=='buy') // czy kupujemy czy sprzedajemy
{
    echo "Kupujemy: ";
    if($uczen_pobrany->$item ==0) // czy uczeń ma TEN item czy nie ma
    {

        $sql = "SELECT * FROM $item WHERE ID =".$id;
        //echo "<br>".$sql."<br>";
        $result = mysqli_query($database,$sql);
        $success = mysqli_num_rows($result);
        if($success>0)
        {
            while ($row=mysqli_fetch_row($result))
            {
                echo "<br>cena kupowanego $item to ".$row[2]."<br>";
                $hui=$row[2];
            }
        }

        echo "Po zakupie zostanie ".($coins-$wartosc_postaci-$hui);

        if(($coins-$wartosc_postaci-$hui)>=0) // to tylko sprawdza czy uczeń ma jakiś hajs.. a nie czy ten hajs starczy na zakup lol
        {
            
            $uczen_pobrany->$item = $id;
            echo "<br> Zakup udany";
        }
        else{
            echo "<br> Za malo środków!";
        }

    }
    else{
        echo "<br> Najpierw sprzedaj poprzedni item";
    }

}


echo "<br>".json_encode($uczen_pobrany);

$sql_updateUczen = "UPDATE uczniowie SET uczen_object = '".json_encode($uczen_pobrany)."' WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
   mysqli_query($database, $sql_updateUczen); 

    echo "wykonano";


    echo "
    <form id='myForm' action='login.php'>
<input type='text' id='login' name='login' value='$login'><br><br>
  <input type='text' id='password' name='password' value='$password'><br><br>
  <input type='submit' value='Powrót'>
</form>
";





?>

<script>

//document.getElementById("myForm").submit();

</script>