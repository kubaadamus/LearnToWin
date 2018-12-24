<?php


//-------------------------------------- Ł Ą C Z E N I E  Z  B A Z Ą  D A N Y C H ------------------------------------------//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$login = ($_GET["login"]);
$password = ($_GET["password"]);

$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());

echo "Status podłączenia do bazy danych: ";
if ($database) {
  echo 'conected';
} else {
  echo 'not conected';
}
echo "<br>";

//-------------------------------------- D E K L A R A C J E  Z M I E N N Y C H ------------------------------------------//

$mat=5;
$fiz=3;
$pl=2;
$coins=0;

//------------------------------------------------ P R Z E D M I O T Y ---------------------------------------------------//
//Date to oś X wykresu a note to wartość Y. _coins to wpływ monet z danego przedmiotu
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


//------------------------------------------------ L O G O W A N I E  U C Z N I A  ---------------------------------------------------//
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

    //RYSOWANIE STATYSTYK
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

    //Po obliczeniu średniej, daj na serwer coinsy które masz

    $sql_updateCoins = "UPDATE uczniowie SET coins = $coins WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
    $helmets = mysqli_query($database, $sql_updateCoins);

    //====================POBIERANIE UZBROJENIA====================//
    $sql_helmets = "SELECT * FROM helmets";
    $helmets = mysqli_query($database,$sql_helmets);
    $sql_torsos = "SELECT * FROM torsos";
    $torsos = mysqli_query($database,$sql_torsos);
    $helmet_array = array();
    $torso_array = array();

    while ($row=mysqli_fetch_row($helmets))
    {
        //debug_to_console("Wypisuję hełm:");
        //printRow("|id: ".$row[0]."| name: ".$row[1]."| price: ".$row[2]."| defence: ".$row[3]."| thumbnail: ".$row[4]);
        array_push($helmet_array, new Helmet($row[0],$row[1],$row[2],$row[3],$row[4]));
        //debug_to_console("Dodano hełm do tablicy");
        //debug_to_console("tablica ma teraz: ".count($helmet_array)." elementów");
        //debug_to_console("------------------------------------");
    }

    while ($row=mysqli_fetch_row($torsos))
    {
        //debug_to_console("Wypisuję torso:");
        //printRow("|id: ".$row[0]."| name: ".$row[1]."| price: ".$row[2]."| defence: ".$row[3]."| thumbnail: ".$row[4]);
        array_push($torso_array, new Torso($row[0],$row[1],$row[2],$row[3],$row[4]));
        //debug_to_console("Dodano torso do tablicy");
        //debug_to_console("tablica ma teraz: ".count($torso_array)." elementów");
        //debug_to_console("------------------------------------");
    }

}
else{
    printRow("NIEPRAWIDŁOWA NAZWA UŻYTKOWNIKA LUB HASŁO, SPRÓBUJ PONOWNIE");
}


//------------------------------------------------ P O B I E R A N I E  E K W I P U N K U  ---------------------------------------------------//
class Helmet
{
   public $helmet_id = null;
   public $helmet_name = null;
   public $helmet_price = null;
   public $helmet_defence = null;
   public $helmet_thumbnail = null;
 
   public function __construct($id, $name,$price,$defence,$thumbnail)
   {
      $this->helmet_id = $id;
      $this->helmet_name = $name;
      $this->helmet_price = $price;
      $this->helmet_defence = $defence;
      $this->helmet_thumbnail = $thumbnail;
      //$this->wypisz();
   }
   public function wypisz(){
       debug_to_console("Stworzono obiekt typu helmet.");
       debug_to_console("id:".$this->helmet_id);
       debug_to_console("name:".$this->helmet_name);
       debug_to_console("price:".$this->helmet_price);
       debug_to_console("defence:".$this->helmet_defence);
       debug_to_console("thumbnail:".$this->helmet_thumbnail);
   }
}
class Torso
{
   public $torso_id = null;
   public $torso_name = null;
   public $torso_price = null;
   public $torso_defence = null;
   public $torso_thumbnail = null;
 
   public function __construct($id, $name,$price,$defence,$thumbnail)
   {
      $this->torso_id = $id;
      $this->torso_name = $name;
      $this->torso_price = $price;
      $this->torso_defence = $defence;
      $this->torso_thumbnail = $thumbnail;
      //$this->wypisz();
   }
   public function wypisz(){
       debug_to_console("Stworzono obiekt typu torso.");
       debug_to_console("id:".$this->torso_id);
       debug_to_console("name:".$this->torso_name);
       debug_to_console("price:".$this->torso_price);
       debug_to_console("defence:".$this->torso_defence);
       debug_to_console("thumbnail:".$this->torso_thumbnail);
   }
}
function printRow($a){
echo $a."<br/>";
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}


?>