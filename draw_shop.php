<?php

$bar = (($wartosc_postaci*intval(100))/$coins);
echo "<div style='background-color:red;width:20px;height:100px;position:relative'>
<div style='background-color:blue;width:20px;height:".$bar.";position:absolute;bottom:0px'></div>
</div>";


function DrawAllGear($_array,$_name,$_spendable){
    echo "<div class='item_group' itemClass='$_name'>";


    
for($i=0; $i<5; $i++)
{

    foreach ($_array as $value)
    {
        if($_spendable>=$value->price)
        {
            echo "<input style='background-image:url($value->thumbnail);' class='itemSelect' type='button' itemType='$_name' itemID='$value->id'>";;
        }
        else{
            echo "<input style='background-image:url($value->thumbnail);border:2px solid red' class='itemSelect' type='button' itemType='$_name' itemID='$value->id'>";;
        }
        
    }
    
}
echo "</div>";


}
//echo "<input style='background-image:url($value->thumbnail);width:100px;height:100px' class='przycisk' type='submit' value='Buy $_name $value->id' sellbuy='buy' item_name='$_name' item_id='$value->id' >";echo "<br/>";
//echo "<br/><input class='przycisk' type='submit' value='Sell weapon $uczen_pobrany->weapon' sellbuy='sell' item_name='weapon' item_id='1' ><br/>";
?>