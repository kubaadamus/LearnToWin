<?php
//-------------------------------------- Ł Ą C Z E N I E  Z  B A Z Ą  D A N Y C H ------------------------------------------//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$login = ($_GET["login"]);
$password = ($_GET["password"]);
$sell_buy = ($_GET["sellbuy"]);
$item = ($_GET["item"]);
$id = ($_GET["id"]);
$autoPowrot = ($_GET["autoPowrot"]);

$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());
$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
//============================================= Pobieranie ilości monet przyznanych uczniowi za oceny =================================//
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
        $coins = $row[5];
    }
}
//===========================================================KLASY================================================//
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
   public $weapon2 = 0;
   public $weapon3 = 0;
   public $weapon4 = 0;
   public $weapon5 = 0;

   public $perk1 = 0;
   public $perk2 = 0;
   public $perk3 = 0;

   public function __construct($_base=0, $_helmet=0, $_torso=0, $_gloves=0, $_pants=0, $_boots=0, $_weapon=0, $_weapon2=0, $_weapon3=0, $_weapon4=0, $_weapon5=0, $_perk1=0, $_perk2=0, $_perk3=0)
   {
      //Ekwipunek
      $this->base = $_base;
      $this->helmet = $_helmet;
      $this->torso = $_torso;
      $this->gloves = $_gloves;
      $this->pants = $_pants;
      $this->boots = $_boots;
      $this->weapon = $_weapon;
      $this->weapon2 = $_weapon2;
      $this->weapon3 = $_weapon3;
      $this->weapon4 = $_weapon4;
      $this->weapon5 = $_weapon5;

      $this->perk1 = $_perk1;
      $this->perk2 = $_perk2;
      $this->perk3 = $_perk3;
      //$this->wypisz();
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
//===================================================POBRANIE UCZNIA JAKO JSON============================================//
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
//============================================= OBLICZENIE AKTUALNEJ WARTOŚCI UCZNIA =======================================//
$wartosc_postaci=0;
$elements = array("base","helmet","torso","gloves","pants","boots","weapon", "weapon2", "weapon3", "weapon4", "weapon5", "perk1", "perk2", "perk3"); // te tabele w bazie danych będą przeszukane 
foreach($elements as $value)
{
    $sql = "SELECT * FROM $value WHERE ID =".$uczen_pobrany->$value; // zapytaj tabelę helmets (a potem inne) o helmet  o ID = 1 
    $result = mysqli_query($database,$sql);
    $success = mysqli_num_rows($result);
    if($success>0) // jeśli wartość helmeta ucznia jest inna niż zero to znaczy że uczeń ma jakiś helmet
    {
        while ($row=mysqli_fetch_row($result)) 
        {
            $wartosc_postaci += $row[2]; // pobiera cenę przedmiotu np helmeta 1 i dodaje ją do wartości postaci
        }
    }
    else{
        ////echo "<br> $value nie kupione.";
    }
}
//echo "<br> wartość postaci: ".$wartosc_postaci;
$spendable_coins = $coins-$wartosc_postaci;
//echo "<br> Możesz wydać: ".($spendable_coins);
if($sell_buy=='sell')
{
    echo "Odkładamy: ".$item."<br/>";
    $uczen_pobrany->$item = 0;
}
if($sell_buy=='buy') // czy kupujemy czy sprzedajemy
{
    //echo "Kupujemy: ".$item."<br/>";
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
                //echo "cena kupowanego $item to ".$row[2]."<br>";
                $current_item_price=$row[2];
            }
        }
        //echo "Po zakupie zostanie ".($spendable_coins-$current_item_price)."<br>";
        if(($spendable_coins-$current_item_price)>=0) // to tylko sprawdza czy uczeń ma jakiś hajs.. a nie czy ten hajs starczy na zakup lol
        {   
            $uczen_pobrany->$item = $id;
            echo"true";
        }
        else{
            echo"false";
        }
    }
    else{
        //echo " Najpierw sprzedaj poprzedni item<br>";
    }
}
//echo "<br> Uczeń po modyfikacjach".json_encode($uczen_pobrany)."</br>";
$sql_updateUczen = "UPDATE uczniowie SET uczen_object = '".json_encode($uczen_pobrany)."' WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
   mysqli_query($database, $sql_updateUczen); 

   $sql_updateUczen = "UPDATE uczniowie SET wartosc_postaci = $wartosc_postaci WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
   mysqli_query($database, $sql_updateUczen); 

   $sql_updateUczen = "UPDATE uczniowie SET spendable_coins = $spendable_coins WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
   mysqli_query($database, $sql_updateUczen); 

?>