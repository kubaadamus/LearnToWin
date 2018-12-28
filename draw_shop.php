<?php
echo "<div class='shop_container'>";
if($uczen_pobrany->helmet!=0){
    echo "<br/><input class='przycisk' type='submit' value='Sell helmet $uczen_pobrany->helmet' sellbuy='sell' item_name='helmet' item_id='1' ><br/>";
}
else{
    echo "<div class='item_group'>";
    foreach ($helmet_array as $value){echo "<input class='przycisk' type='submit' value='Buy helmet $value->id' sellbuy='buy' item_name='helmet' item_id='$value->id' >";echo "<br/>";}
    echo "</div>";
}
if($uczen_pobrany->torso!=0)
{

    echo "<br/><input class='przycisk' type='submit' value='Sell torso $uczen_pobrany->torso' sellbuy='sell' item_name='torso' item_id='1' ><br/>";

}
else{
    echo "<div class='item_group'>";
    foreach ($torso_array as $value){echo "<input class='przycisk' type='submit' value='Buy torso $value->id' sellbuy='buy' item_name='torso' item_id='$value->id' >";echo "<br/>";}
    echo "</div>";
}
if($uczen_pobrany->base!=0)
{

    echo "<br/><input class='przycisk' type='submit' value='Sell base $uczen_pobrany->base' sellbuy='sell' item_name='base' item_id='1' ><br/>";

}
else{
    echo "<div class='item_group'>";
    foreach ($base_array as $value){echo "<input class='przycisk' type='submit' value='Buy base $value->id' sellbuy='buy' item_name='base' item_id='$value->id' >";echo "<br/>";}
    echo "</div>";
}
if($uczen_pobrany->gloves!=0)
{

    echo "<br/><input class='przycisk' type='submit' value='Sell gloves $uczen_pobrany->gloves' sellbuy='sell' item_name='gloves' item_id='1' ><br/>";

}
else{
    echo "<div class='item_group'>";
    foreach ($gloves_array as $value){echo "<input class='przycisk' type='submit' value='Buy gloves $value->id' sellbuy='buy' item_name='gloves' item_id='$value->id' >";echo "<br/>";}
    echo "</div>";
}
if($uczen_pobrany->pants!=0)
{

    echo "<br/><input class='przycisk' type='submit' value='Sell pants $uczen_pobrany->pants' sellbuy='sell' item_name='pants' item_id='1' ><br/>";

}
else{
    echo "<div class='item_group'>";
    foreach ($pants_array as $value){echo "<input class='przycisk' type='submit' value='Buy pants $value->id' sellbuy='buy' item_name='pants' item_id='$value->id' >";echo "<br/>";}
    echo "</div>";
}
if($uczen_pobrany->boots!=0)
{

    echo "<br/><input class='przycisk' type='submit' value='Sell boots $uczen_pobrany->boots' sellbuy='sell' item_name='boots' item_id='1' ><br/>";

}
else{
    echo "<div class='item_group'>";
    foreach ($boots_array as $value){echo "<input class='przycisk' type='submit' value='Buy boots $value->id' sellbuy='buy' item_name='boots' item_id='$value->id' >";echo "<br/>";}
    echo "</div>";
}

if($uczen_pobrany->weapon!=0)
{

    echo "<br/><input class='przycisk' type='submit' value='Sell weapon $uczen_pobrany->weapon' sellbuy='sell' item_name='weapon' item_id='1' ><br/>";

}
else{
    echo "<div class='item_group'>";
    foreach ($weapon_array as $value){echo "<input class='przycisk' type='submit' value='Buy weapon $value->id' sellbuy='buy' item_name='weapon' item_id='$value->id' >";echo "<br/>";}
    echo "</div>";
}
echo "</div>";
$bar = (($wartosc_postaci*intval(100))/$coins);
echo "<div style='background-color:red;width:20px;height:100px;position:relative'>
<div style='background-color:blue;width:20px;height:".$bar.";position:absolute;bottom:0px'></div>
</div>";

?>