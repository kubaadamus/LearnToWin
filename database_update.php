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

class Base
{
   public $base_id = 0;
   public $base_name = 0;
   public $base_price = 0;
   public $base_defence = 0;
   public $base_thumbnail = 0;
 
   public function __construct($id=0, $name=0,$price=0,$defence=0,$thumbnail=0)
   {
      $this->base_id = $id;
      $this->base_name = $name;
      $this->base_price = $price;
      $this->base_defence = $defence;
      $this->base_thumbnail = $thumbnail;
      $this->wypisz();
   }
   public function wypisz(){
       debug_to_console("Stworzono obiekt typu base.");
       debug_to_console("id:".$this->base_id);
       debug_to_console("name:".$this->base_name);
       debug_to_console("price:".$this->base_price);
       debug_to_console("defence:".$this->base_defence);
       debug_to_console("thumbnail:".$this->base_thumbnail);
       debug_to_console("--------------------------------");
   }
}
class Helmet
{
   public $helmet_id = 0;
   public $helmet_name = 0;
   public $helmet_price = 0;
   public $helmet_defence = 0;
   public $helmet_thumbnail = 0;
 
   public function __construct($id=0, $name=0,$price=0,$defence=0,$thumbnail=0)
   {
      $this->helmet_id = $id;
      $this->helmet_name = $name;
      $this->helmet_price = $price;
      $this->helmet_defence = $defence;
      $this->helmet_thumbnail = $thumbnail;
      $this->wypisz();
   }
   public function wypisz(){
       debug_to_console("Stworzono obiekt typu helmet.");
       debug_to_console("id:".$this->helmet_id);
       debug_to_console("name:".$this->helmet_name);
       debug_to_console("price:".$this->helmet_price);
       debug_to_console("defence:".$this->helmet_defence);
       debug_to_console("thumbnail:".$this->helmet_thumbnail);
       debug_to_console("--------------------------------");
   }
}
class Torso
{
   public $torso_id = 0;
   public $torso_name = 0;
   public $torso_price = 0;
   public $torso_defence = 0;
   public $torso_thumbnail = 0;
 
   public function __construct($id=0, $name=0,$price=0,$defence=0,$thumbnail=0)
   {
      $this->torso_id = $id;
      $this->torso_name = $name;
      $this->torso_price = $price;
      $this->torso_defence = $defence;
      $this->torso_thumbnail = $thumbnail;
      $this->wypisz();
   }
   public function wypisz(){
       debug_to_console("Stworzono obiekt typu torso.");
       debug_to_console("id:".$this->torso_id);
       debug_to_console("name:".$this->torso_name);
       debug_to_console("price:".$this->torso_price);
       debug_to_console("defence:".$this->torso_defence);
       debug_to_console("thumbnail:".$this->torso_thumbnail);
       debug_to_console("--------------------------------");
   }
}




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


        //zapytaj o baze
        $sql = "SELECT * FROM bases WHERE base_ID = '".$baza."'" ;
        $result = mysqli_query($database,$sql);
        while ($row=mysqli_fetch_row($result))
        {
            $current_base = new Base($row[0],$row[1],$row[2],$row[3],$row[4]);

            foreach ($row as $value) { 
                //echo "<td> " . $value . "</td>"; 
                
            }
            echo "<br>";
        }
        //zapytaj o helm
        $sql = "SELECT * FROM helmets WHERE helmet_ID = '".$helm."'" ;
        $result = mysqli_query($database,$sql);
        while ($row=mysqli_fetch_row($result))
        {
            $current_helmet = new Helmet($row[0],$row[1],$row[2],$row[3],$row[4]);
            foreach ($row as $value) { 
                //echo "<td> " . $value . "</td>"; 
                
            }
            echo "<br>";
        }
        //zapytaj o torso
        $sql = "SELECT * FROM torsos WHERE torso_ID = '".$torso."'" ;
        $result = mysqli_query($database,$sql);
        while ($row=mysqli_fetch_row($result))
        {
            $current_torso = new Torso($row[0],$row[1],$row[2],$row[3],$row[4]);
            foreach ($row as $value) { 
                //echo "<td> " . $value . "</td>"; 
                
            }
            echo "<br>";
        }


}
else{
    printRow("NIEPRAWIDŁOWA NAZWA UŻYTKOWNIKA LUB HASŁO, SPRÓBUJ PONOWNIE");
}







function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}




?>