<?php
//=================================================== PODŁĄCZENIE DO BAZY DANYCH =============================================//
$user = 'jakubadamus';
$DBpassword = 'Kubaadamus1991';
$db = 'jakubadamus';
$host = 'mysql.cba.pl';
$port = 3360;
$database = mysqli_connect($host,$user,$DBpassword,$db) OR die('Niedaradyyy' . mysqli_connect_error());
$login = ($_POST["login"]);
$password = ($_POST["password"]);
//======================================== POBRANIE CAŁEGO UZBROJENIA Z BAZY DANYCH ===========================================//
$elements = array("helmet","pistol","rifle"); // po prostu dopisz table które ma przeszukać PHP :D
$ItemArray = array();
class Item{
    function __construct($_id=0, $_type=0, $_price=0, $_name, $_obiekt)
    {
       $this->id = $_id;
       $this->type = $_type;
       $this->price = $_price;
       $this->name = $_name;
       $this->obiekt = $_obiekt;
    }
}
foreach ($elements as $value)
{
    $sql = "SELECT * FROM $value";
    $result = mysqli_query($database,$sql);
    $success = mysqli_num_rows($result);
    if($success>0)
    {
        while ($row=mysqli_fetch_row($result)) //row to tabela komórek danego rekordu. rekordy pobierane są kolejno
        {
        array_push($ItemArray,new Item($row[0],$row[1],$row[2],$row[3],$row[4]));
        }
    }
    else{
    }
}



echo json_encode($ItemArray);
?>