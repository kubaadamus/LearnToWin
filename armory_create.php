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
$elements = array("base","helmet", "torso","gloves","pants","boots","weapon");
$base_array = array();
$helmet_array = array();
$torso_array = array();
$gloves_array = array();
$pants_array = array();
$boots_array = array();
$weapon_array = array();
class armory{
    public $base_array = array();
    public $helmet_array = array();
    public $torso_array = array();
    public $gloves_array = array();
    public $pants_array = array();
    public $boots_array = array();
    public $weapon_array = array();

    function __construct($_bases,$_helmets,$_torsos,$_gloves,$_pants,$_boots,$_weapons) {
        $this->base_array = $_bases;
        $this->helmet_array = $_helmets;
        $this->torso_array = $_torsos;
        $this->gloves_array = $_gloves;
        $this->pants_array = $_pants;
        $this->boots_array = $_boots;
        $this->weapon_array = $_weapons;
    }
}
class item_object{
    function __construct($_id=0, $_name=0, $_price=0, $_defence=0, $_attack=0, $_thumbnail=0)
    {
       $this->id = $_id;
       $this->name = $_name;
       $this->price = $_price;
       $this->defence = $_defence;
       $this->attack = $_attack;
       $this->thumbnail = $_thumbnail;
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
            if($value=='base')
            {
                array_push($base_array, new item_object($row[0],$row[1],$row[2],$row[3],null,$row[4]));
            }
            if($value=='helmet')
            {
                array_push($helmet_array, new item_object($row[0],$row[1],$row[2],$row[3],null,$row[4]));
            }
            if($value=='torso')
            {
                array_push($torso_array, new item_object($row[0],$row[1],$row[2],$row[3],null,$row[4]));
            }
            if($value=='gloves')
            {
                array_push($gloves_array, new item_object($row[0],$row[1],$row[2],$row[3],null,$row[4]));
            }
            if($value=='pants')
            {
                array_push($pants_array, new item_object($row[0],$row[1],$row[2],$row[3],null,$row[4]));
            }
            if($value=='boots')
            {
                array_push($boots_array, new item_object($row[0],$row[1],$row[2],$row[3],null,$row[4]));
            }
            if($value=='weapon')
            {
                array_push($weapon_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }
        }
    }
    else{
    }
}
$obj = new armory($base_array,$helmet_array,$torso_array,$gloves_array,$pants_array,$boots_array,$weapon_array);
echo json_encode($obj);
?>