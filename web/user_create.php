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
$login = "Jakub";
$password = "Adamus";
//=================================================== STWORZENIE OBIEKTU UCZNIA =============================================//
$sql = "SELECT * FROM uczniowie WHERE imie = '".$login."' AND nazwisko = '".$password."'" ;
$result = mysqli_query($database,$sql);
$success = mysqli_num_rows($result);
if($success>0)
{
    while ($row=mysqli_fetch_row($result))
    {
        $uczen_pobrany = new Uczen($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11]);
    }
}
class Uczen{
    function __construct($_id=0, $_school=0, $_name1=0, $_name2=0,$_class=0, $_coins=0, $_primary=0, $_secondary=0, $_throwable=0, $_med=0, $_armor=0, $_perk=0)
    {
       $this->id = $_id;
       $this->school = $_school;
       $this->name1 = $_name1;
       $this->name2 = $_name2;
       $this->class = $_class;
       $this->coins = $_coins;
       $this->primary = $_primary;
       $this->secondary = $_secondary;
       $this->throwable = $_throwable;
       $this->med = $_med;
       $this->armor = $_armor;
       $this->perk = $_perk;
    }
}
echo json_encode($uczen_pobrany);
?>