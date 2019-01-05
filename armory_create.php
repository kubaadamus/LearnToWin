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
$elements = array("base","helmet", "torso","gloves","pants","boots","weapon","weapon2","weapon3","weapon4","weapon5","perk1","perk2","perk3");
$base_array = array();
$helmet_array = array();
$torso_array = array();
$gloves_array = array();
$pants_array = array();
$boots_array = array();
$weapon_array = array();
$weapon2_array = array();
$weapon3_array = array();
$weapon4_array = array();
$weapon5_array = array();
$perk1_array = array();
$perk2_array = array();
$perk3_array = array();
class armory{
    public $base_array = array();
    public $helmet_array = array();
    public $torso_array = array();
    public $gloves_array = array();
    public $pants_array = array();
    public $boots_array = array();
    public $weapon_array = array();
    public $weapon2_array = array();
    public $weapon3_array = array();
    public $weapon4_array = array();
    public $weapon5_array = array();

    public $perk1_array = array();
    public $perk2_array = array();
    public $perk3_array = array();

    function __construct($_bases,$_helmets,$_torsos,$_gloves,$_pants,$_boots,$_weapons,$_weapons2,$_weapons3,$_weapons4,$_weapons5,$_perk1,$_perk2,$_perk3) {
        $this->base_array = $_bases;
        $this->helmet_array = $_helmets;
        $this->torso_array = $_torsos;
        $this->gloves_array = $_gloves;
        $this->pants_array = $_pants;
        $this->boots_array = $_boots;
        $this->weapon_array = $_weapons;
        $this->weapon2_array = $_weapons2;
        $this->weapon3_array = $_weapons3;
        $this->weapon4_array = $_weapons4;
        $this->weapon5_array = $_weapons5;

        $this->perk1_array = $_perk1;
        $this->perk2_array = $_perk2;
        $this->perk3_array = $_perk3;
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
            if($value=='weapon2')
            {
                array_push($weapon2_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }
            if($value=='weapon3')
            {
                array_push($weapon3_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }
            if($value=='weapon4')
            {
                array_push($weapon4_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }
            if($value=='weapon5')
            {
                array_push($weapon5_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }

            if($value=='perk1')
            {
                array_push($perk1_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }
            if($value=='perk2')
            {
                array_push($perk2_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }
            if($value=='perk3')
            {
                array_push($perk3_array, new item_object($row[0],$row[1],$row[2],null,$row[3],$row[4]));
            }
        }
    }
    else{
    }
}
$obj = new armory($base_array,$helmet_array,$torso_array,$gloves_array,$pants_array,$boots_array,$weapon_array,$weapon2_array,$weapon3_array,$weapon4_array,$weapon5_array,$perk1_array,$perk2_array,$perk3_array);
echo json_encode($obj);
?>