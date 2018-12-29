<?php
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
            if($oldValue!=$value)
            {
                
                $oldValue=$value;
                echo "<br>";
            }
            //echo"<input style='background-color:red;width:100px;height:100px;display:block;position:relative;' class='przycisk' type='submit' value='Buy $value $row[0]' sellbuy='buy' item_name='$value' item_id='$row[0]' >";

        }
    }
    else{

    }
}
?>