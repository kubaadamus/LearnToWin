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

$coins=0;


//=================================================== UPDATE MONET NA PODSTAWIE OCEN =============================================//
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

//=================================================== STWORZENIE OBIEKTU UCZNIA =============================================//

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
$elements = array("base","helmet", "torso","gloves","pants","boots","weapon");
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

echo "<br>aktualna wartosc postaci to: ".$wartosc_postaci;

echo "<br> Możesz wydać: ".($coins-$wartosc_postaci)."<br>";






function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

class item_object{

   public $id = 0;
   public $name = 0;
   public $price = 0;
   public $defence = 0;
   public $attack = 0;
   public $thumbnail = 0;

 
   public function __construct($_id=0, $_name=0, $_price=0, $_defence=0, $_attack=0, $_thumbnail=0)
   {

      $this->id = $_id;
      $this->name = $_name;
      $this->price = $_price;
      $this->defence = $_defence;
      $this->attack = $_attack;
      $this->thumbnail = $_thumbnail;

   }
}

//======================================== POBRANIE CAŁEGO UZBROJENIA Z BAZY DANYCH ===========================================//
$elements = array("base","helmet", "torso","gloves","pants","boots","weapon");
$base_array = array();
$helmet_array = array();
$torso_array = array();
$gloves_array = array();
$pants_array = array();
$boots_array = array();
$weapon_array = array();

$oldValue = '0';

foreach ($elements as $value)
{

    $sql = "SELECT * FROM $value";
    $result = mysqli_query($database,$sql);
    $success = mysqli_num_rows($result);
    if($success>0)
    {
        while ($row=mysqli_fetch_row($result)) //row to tabela komórek danego rekordu. rekordy pobierane są kolejno
        {
            //echo json_encode(new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]))."<br/>";
            if($value=='base')
            {
                array_push($base_array, new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
            }
            if($value=='helmet')
            {
                array_push($helmet_array, new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
            }
            if($value=='torso')
            {
                array_push($torso_array, new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
            }
            if($value=='gloves')
            {
                array_push($gloves_array, new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
            }
            if($value=='pants')
            {
                array_push($pants_array, new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
            }
            if($value=='boots')
            {
                array_push($boots_array, new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
            }
            if($value=='weapon')
            {
                array_push($weapon_array, new item_object($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]));
            }
            if($oldValue!=$value)
            {
                
                $oldValue=$value;
                echo "<br>";
            }
            echo"<input style='background-color:red;width:100px;height:100px;display:block;position:relative;' class='przycisk' type='submit' value='Buy $value $row[0]' sellbuy='buy' item_name='$value' item_id='$row[0]' >";

        }
    }
    else{

    }
}


?>