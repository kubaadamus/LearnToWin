<?php
echo "<div class='shop_container'>";
if($uczen_pobrany->helmet!=0){
    echo "<br/><input class='przycisk' type='submit' value='Sell helmet $uczen_pobrany->helmet' sellbuy='sell' item_name='helmet' item_id='1' ><br/>";
}
else{
    DrawAllGear($helmet_array,'helmet');
}
if($uczen_pobrany->torso!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell torso $uczen_pobrany->torso' sellbuy='sell' item_name='torso' item_id='1' ><br/>";
}
else{
    DrawAllGear($torso_array,'torso');
}
if($uczen_pobrany->base!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell base $uczen_pobrany->base' sellbuy='sell' item_name='base' item_id='1' ><br/>";
}
else{
    DrawAllGear($base_array,'base');
}
if($uczen_pobrany->gloves!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell gloves $uczen_pobrany->gloves' sellbuy='sell' item_name='gloves' item_id='1' ><br/>";
}
else{
    DrawAllGear($gloves_array,'gloves');
}
if($uczen_pobrany->pants!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell pants $uczen_pobrany->pants' sellbuy='sell' item_name='pants' item_id='1' ><br/>";
}
else{
    DrawAllGear($pants_array,'pants');
}
if($uczen_pobrany->boots!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell boots $uczen_pobrany->boots' sellbuy='sell' item_name='boots' item_id='1' ><br/>";
}
else{
    DrawAllGear($boots_array,'boots');
}

if($uczen_pobrany->weapon!=0)
{
    echo "<br/><input class='przycisk' type='submit' value='Sell weapon $uczen_pobrany->weapon' sellbuy='sell' item_name='weapon' item_id='1' ><br/>";
}
else{
    DrawAllGear($weapon_array,'weapon');
}
echo "</div>";
$bar = (($wartosc_postaci*intval(100))/$coins);
echo "<div style='background-color:red;width:20px;height:100px;position:relative'>
<div style='background-color:blue;width:20px;height:".$bar.";position:absolute;bottom:0px'></div>
</div>";



function DrawAllGear($_array,$_name){
    echo "<div class='item_group'>";
    foreach ($_array as $value)
    {
        echo "<input class='przycisk' type='submit' value='Buy $_name $value->id' sellbuy='buy' item_name='$_name' item_id='$value->id' >";echo "<br/>";
        echo $value->thumbnail;
    }
    echo "</div>";
}

?>