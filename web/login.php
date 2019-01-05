<html>
<head>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js'></script>
<link rel = 'stylesheet' type = 'text/css' href = 'styles.css' />
</head>
<body>
<div class="rows">
    <div class="character_wrapper">
        <div class="character_frame">
            <div class="userdata"></div>
            <div class="character_avatar">
                <img src="assets/character/doll.png" id="character_base_thumbnail" alt="">
            </div>
            <input id="character_helmet_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="helmet" itemid="1" compare="1">
            <input id="character_torso_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="torso" itemid="1" compare="1">
            <input id="character_gloves_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="gloves" itemid="1" compare="1">
            <input id="character_pants_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="pants" itemid="1" compare="1">
            <input id="character_boots_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="boots" itemid="1" compare="1">
            <input id="character_weapon_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="weapon" itemid="1" compare="1">
            <input id="character_weapon2_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="weapon2" itemid="1" compare="1">
            <input id="character_weapon3_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="weapon3" itemid="1" compare="1">
            <input id="character_weapon4_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="weapon4" itemid="1" compare="1">
            <input id="character_weapon5_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="weapon5" itemid="1" compare="1">
            <input id="character_perk1_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="perk1" itemid="1" compare="1">
            <input id="character_perk2_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="perk2" itemid="1" compare="1">
            <input id="character_perk3_thumbnail" style="" canafford="tru" class="itemSelect sellIt" type="button" itemtype="perk3" itemid="1" compare="1">
            <div class="character_bar">
                <div class="character_bar_inside"></div>
            </div>
        </div>
        
    </div>
    <div class="columns">
        <div class="item_container">
        <div class="column">
            <div class="compare_item_thumbnail" ></div>
                <div class="compare_item_properties" ></div>
                <div class="kupowane">posiadane</div>
            </div>
            <div class="column">
                <div class="item_thumbnail" ></div>
                <div class="item_properties" ></div>
                <div class="kupowane">kupowane</div>
            </div>
        </div>
        <input class="buyBtn" id="buyBtn" type='button' value='kup' item_name='name' item_id='id' sellbuy='buy' autoPowrot="0">
        <div class="storage_wrapper">
            <input class="ShopSelectBtn" type="button" value=" bases" select="base">
            <input class="ShopSelectBtn" type="button" value=" torsos" select="torso">
            <input class="ShopSelectBtn" type="button" value=" boots" select="boots">
            <input class="ShopSelectBtn" type="button" value=" helmets" select="helmet">
            <input class="ShopSelectBtn" type="button" value=" gloves" select="gloves">
            <input class="ShopSelectBtn" type="button" value=" pants" select="pants">
            <input class="ShopSelectBtn" type="button" value=" weapons" select="weapon">
            <input class="ShopSelectBtn" type="button" value=" weapons2" select="weapon2">
            <input class="ShopSelectBtn" type="button" value=" weapons3" select="weapon3">
            <input class="ShopSelectBtn" type="button" value=" weapons4" select="weapon4">
            <input class="ShopSelectBtn" type="button" value=" weapons5" select="weapon5">

            <input class="ShopSelectBtn" type="button" value=" perks1" select="perk1">
            <input class="ShopSelectBtn" type="button" value=" perks2" select="perk2">
            <input class="ShopSelectBtn" type="button" value=" perks3" select="perk3">
        </div>
        <div class="shop_container">      
        </div>
    </div>
</div>
</body>
<script>

//=================================================================== Z M I E N N E ==========================================================================//
//hajsy
var monety = 0 ;
var wartosc_postaci = 0;
var mozesz_wydac=0;
//obiekt postaci
var uczen_pobrany;
//ekwipunek
var armory ;
var base_array;
var torso_array;
var helmet_array;
var gloves_array;
var pants_array;
var weapon_array;
var weapon2_array;
var weapon3_array;
var weapon4_array;
var weapon5_array;
var perk1_array;
var perk2_array;
var perk3_array;
var boots_array;
//login i hasło
var login = <?php echo "'".($_GET["login"])."'" ?>;
var password = <?php echo "'".($_GET["password"])."'" ?>;
//ostatnio wybrane menu - zeby po kupnie czegoś nie wracało zawsze do sklepiku z bazami tylko do ostatnio otwartego
var lastOpenedShop = $( "input[select=base]");
var lastOpenedItem = $( "input[itemtype=base][itemid=1]");
//klasy
class uczen_object
{
   constructor(_base=0, _helmet=0, _torso=0, _gloves=0, _pants=0, _boots=0, _weapon=0, _weapon2=0, _weapon3=0, _weapon4=0, _weapon5=0, _perk1=0, _perk2=0, _perk3=0)
   {
      //Ekwipunek
      this.base = _base;
      this.helmet = _helmet;
      this.torso = _torso;
      this.gloves = _gloves;
      this.pants = _pants;
      this.boots = _boots;
      this.weapon = _weapon;
      this.weapon2 = _weapon2;
      this.weapon3 = _weapon3;
      this.weapon4 = _weapon4;
      this.weapon5 = _weapon5;

      this.perk1 = _perk1;
      this.perk2 = _perk2;
      this.perk3 = _perk3;
      //this.wypisz();
   }
   wypisz(){
       //Ekwipunek
       debug_to_console("base:".this.base);
       debug_to_console("helmet:".this.helmet);
       debug_to_console("torso:".this.torso);
       debug_to_console("gloves:".this.gloves);
       debug_to_console("pants:".this.pants);
       debug_to_console("boots:".this.boots);
       debug_to_console("weapon:".this.weapon);
       debug_to_console("--------------------------------");
   }
}
//=================================================================== F U N K C J E ==========================================================================//
$( document ).ready(function() {
    coins_update();
    user_create();
    $('#buyBtn').attr("disabled","true");
    $('#buyBtn').css( "visibility", "hidden" );

});
function coins_update() { // Atktualizuje bazę danych i zwraca nam coinsy które możemy wydać
    $.get('coins_update.php',{login:login,password:password}, function(data){
        //console.log(data);
    monety = (data);
    });
    return false;
};
function user_create() {  // Pobiera nam ucznia z bazy danych jako Json i parsuje. Zwraca nam ekwipunek ucznia
    $.get('user_create.php',{login:login,password:password}, function(data){
    uczen_value(data);
    uczen_pobrany = JSON.parse(data);

    });
    return false;
};
function uczen_value(uczen_pobrany) {  // Zwraca aktualną wartość ucznia, żeby obliczyć na jej podstawie spendable coins
    $.get('uczen_value.php',{login:login,password:password,uczen_pobrany:uczen_pobrany}, function(data){
        //console.log(data);
    wartosc_postaci = (data);
    mozesz_wydac = parseFloat(monety)-parseFloat(wartosc_postaci);
    armory = armory_create();
    //console.log("monety " + monety +" wartosc postaci "+ wartosc_postaci + " Możesz wydać: " + mozesz_wydac);
    });
    return false;
};
function armory_create() {  // Pobiera ekwipunek z bazy danych
    $.get('armory_create.php',{login:login,password:password}, function(data){
        //console.log(data);
    armory = JSON.parse(data);
    armory_draw(armory);
    //console.log(armory);
    PostUpdatesCallback();
    return armory;
    });
    return false;
};
function armory_draw(_armory){
    $( ".shop_container" ).children().remove();

    $( ".shop_container" ).append( "<div class='item_group' itemClass='base'> " );
    for(var i=0; i<_armory.base_array.length; i++){$( "div[itemClass=base]" ).append( "<input style='background-image:url("+_armory.base_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.base_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='base' itemID='"+_armory.base_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='torso'> " );
    for(var i=0; i<_armory.torso_array.length; i++){$( "div[itemClass=torso]" ).append( "<input style='background-image:url("+_armory.torso_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.torso_array[i].price)>0? 'tru':'nope')+"'  class='itemSelect' type='button' itemType='torso' itemID='"+_armory.torso_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='boots'> " );
    for(var i=0; i<_armory.boots_array.length; i++){$( "div[itemClass=boots]" ).append( "<input style='background-image:url("+_armory.boots_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.boots_array[i].price)>0? 'tru':'nope')+"'  class='itemSelect' type='button' itemType='boots' itemID='"+_armory.boots_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='helmet'> " );
    for(var i=0; i<_armory.helmet_array.length; i++){$( "div[itemClass=helmet]" ).append( "<input style='background-image:url("+_armory.helmet_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.helmet_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='helmet' itemID='"+_armory.helmet_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='gloves'> " );
    for(var i=0; i<_armory.gloves_array.length; i++){$( "div[itemClass=gloves]" ).append( "<input style='background-image:url("+_armory.gloves_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.gloves_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='gloves' itemID='"+_armory.gloves_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='pants'> " );
    for(var i=0; i<_armory.pants_array.length; i++){$( "div[itemClass=pants]" ).append( "<input style='background-image:url("+_armory.pants_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.pants_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='pants' itemID='"+_armory.pants_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='weapon'> " );
    for(var i=0; i<_armory.weapon_array.length; i++){$( "div[itemClass=weapon]" ).append( "<input style='background-image:url("+_armory.weapon_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.weapon_array[i].price)>0? 'tru':'nope')+"'  class='itemSelect' type='button' itemType='weapon' itemID='"+_armory.weapon_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='weapon2'> " );
    for(var i=0; i<_armory.weapon2_array.length; i++){$( "div[itemClass=weapon2]" ).append( "<input style='background-image:url("+_armory.weapon2_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.weapon2_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='weapon2' itemID='"+_armory.weapon2_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='weapon3'> " );
    for(var i=0; i<_armory.weapon3_array.length; i++){$( "div[itemClass=weapon3]" ).append( "<input style='background-image:url("+_armory.weapon3_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.weapon3_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='weapon3' itemID='"+_armory.weapon3_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='weapon4'> " );
    for(var i=0; i<_armory.weapon4_array.length; i++){$( "div[itemClass=weapon4]" ).append( "<input style='background-image:url("+_armory.weapon4_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.weapon4_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='weapon4' itemID='"+_armory.weapon4_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='weapon5'> " );
    for(var i=0; i<_armory.weapon5_array.length; i++){$( "div[itemClass=weapon5]" ).append( "<input style='background-image:url("+_armory.weapon5_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.weapon5_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='weapon5' itemID='"+_armory.weapon5_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='perk1'> " );
    for(var i=0; i<_armory.perk1_array.length; i++){$( "div[itemClass=perk1]" ).append( "<input style='background-image:url("+_armory.perk1_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.perk1_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='perk1' itemID='"+_armory.perk1_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='perk2'> " );
    for(var i=0; i<_armory.perk2_array.length; i++){$( "div[itemClass=perk2]" ).append( "<input style='background-image:url("+_armory.perk2_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.perk2_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='perk2' itemID='"+_armory.perk2_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='perk3'> " );
    for(var i=0; i<_armory.perk3_array.length; i++){$( "div[itemClass=perk3]" ).append( "<input style='background-image:url("+_armory.perk3_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.perk3_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='perk3' itemID='"+_armory.perk3_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");
    lastOpenedShop.click();
    //lastOpenedItem.click();
}
$(document).on('click', '.ShopSelectBtn', function(event){ //Shop Items Select
  $( "div[itemClass]" ).hide();
  $( "div[itemClass='"+$(event.target).attr('select')+"']" ).show();
  lastOpenedShop = event.target;

});
$(document).on('click', 'input[itemid]', function(event){ //Select Specific Item

        lastOpenedItem = event.target;
        var object;
            if($(event.target).attr('itemType')=='base'){
                object =armory.base_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='helmet'){
                object =armory.helmet_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='torso'){
                object =armory.torso_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='gloves'){
                object =armory.gloves_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='pants'){
                object =armory.pants_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='boots'){
                object =armory.boots_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='weapon'){
                object =armory.weapon_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='weapon2'){
                object =armory.weapon2_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='weapon3'){
                object =armory.weapon3_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='weapon4'){
                object =armory.weapon4_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='weapon5'){
                object =armory.weapon5_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='perk1'){
                object =armory.perk1_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='perk2'){
                object =armory.perk2_array[$(event.target).attr('itemID')-1];
            }
            if($(event.target).attr('itemType')=='perk3'){
                object =armory.perk3_array[$(event.target).attr('itemID')-1];
            }

            if($(event.target).attr('style')=="null"){
                $( "div[itemClass]" ).hide();
                $( "div[itemClass='"+$(event.target).attr('itemtype')+"']" ).show();
            }



    if($(event.target).attr("compare")=="1")
    {
        if(object)
        {
            $('.compare_item_thumbnail').css("background-image", "url("+object.thumbnail+")");
            $('.compare_item_properties').html( object.id+" "+object.name+" "+object.price+" "+object.defence+" "+object.attack );
            $('#buyBtn').attr("value","kup "+object.name+"");
            $('#buyBtn').attr("item_name",$(event.target).attr('itemType'));
            $('#buyBtn').attr("item_id",$(event.target).attr('itemID'));
            $('#buyBtn').attr("sellbuy",'buy');
            $('#buyBtn').attr("autoPowrot",'1');
            $('#buyBtn').css( "visibility", "visible" );
            $('#buyBtn').removeAttr("disabled");
        }
    }
    else
    {
      $('.item_thumbnail').css("background-image", "url("+object.thumbnail+")");
      $('.item_properties').html( object.id+" "+object.name+" "+object.price+" "+object.defence+" "+object.attack );
      $('#buyBtn').attr("value","kup "+object.name+"");
      $('#buyBtn').attr("item_name",$(event.target).attr('itemType'));
      $('#buyBtn').attr("item_id",$(event.target).attr('itemID'));
      $('#buyBtn').attr("sellbuy",'buy');
      $('#buyBtn').attr("autoPowrot",'1');
      $('#buyBtn').css( "visibility", "visible" );
      $('#buyBtn').removeAttr("disabled");
    }

    
   
});
$(document).on('click', '.sellIt', function(event){ 
    if($(event.target).attr("style")!="null")
    {
        $('#buyBtn').attr("value","sprzedaj "+$(event.target).attr('itemtype')+" "+$(event.target).attr('itemid'));
    }
});
$(document).on('click', '#buyBtn', function(event){ 
CheckBuyAvailibility('base', uczen_pobrany.base);
CheckBuyAvailibility('helmet',uczen_pobrany.helmet);
CheckBuyAvailibility('torso',uczen_pobrany.torso);
CheckBuyAvailibility('gloves',uczen_pobrany.gloves);
CheckBuyAvailibility('boots',uczen_pobrany.boots);
CheckBuyAvailibility('pants',uczen_pobrany.pants);
CheckBuyAvailibility('weapon',uczen_pobrany.weapon);
CheckBuyAvailibility('weapon2',uczen_pobrany.weapon2);
CheckBuyAvailibility('weapon3',uczen_pobrany.weapon3);
CheckBuyAvailibility('weapon4',uczen_pobrany.weapon4);
CheckBuyAvailibility('weapon5',uczen_pobrany.weapon5);

CheckBuyAvailibility('perk1',uczen_pobrany.perk1);
CheckBuyAvailibility('perk2',uczen_pobrany.perk2);
CheckBuyAvailibility('perk3',uczen_pobrany.perk3);
});
function CheckBuyAvailibility($_item,$_object){
    if($('#buyBtn').attr("item_name")==$_item) 
    {
        if($_object==0) // jeśli nie masz to możesz kupić
        {
        sell_buy();
        }
        else
        {
            SellPopup($_item,$_object); // w przeciwnym razie odłóż
        }
    }
}
function SellPopup($_item,$_id) {
   if(confirm("Ten slot jest już zajęty. Sprzedajemy "+$_item+" aby kupić nowy na jego miejsce?"))
   {
    $('#buyBtn').attr("item_name",$_item);
    $('#buyBtn').attr("item_id",$_id);
    $('#buyBtn').attr("sellbuy",'sell');
    $('#buyBtn').attr("autoPowrot",'1');
    sell_buy();
   }
   else
   {
       alert("Operacja anulowana.");
   }

};
function sell_buy() { //Skrypt kupująco/sprzedający
var item = $('#buyBtn').attr("item_name");
var id = $('#buyBtn').attr("item_id");
var sellbuy = $('#buyBtn').attr("sellbuy");
var autoPowrot = $('#buyBtn').attr("autoPowrot");
$.get('buy.php',{login:login,password:password,sellbuy:sellbuy,item:item,id:id,autoPowrot:autoPowrot}, function(data){
    //console.log(data);
    if(data.indexOf("true") >= 0)
        {
            console.log("Zakup się udał");
        }
        if(data.indexOf('false') >= 0)
        {
            console.log("Zakup się nie udał");
        }
        if(data.indexOf('Odkładamy') >= 0)
        {
            console.log("Odłożenie się udało");
        }
    coins_update();
    user_create();
    armory = armory_create();
    $('#buyBtn').attr("disabled","true");
    $('#buyBtn').css( "visibility", "hidden" );
 });
 return false;
};
function characterBarUpdate() {
    $('.character_bar_inside').attr("style","width:"+((wartosc_postaci/monety)*100)+"px");
    $('.character_bar_inside').html(((wartosc_postaci/monety)*100).toPrecision(3));
    //console.log(wartosc_postaci);
    userDataUpdate();
}
function PostUpdatesCallback(){ // Funkcja która odpali się dopiero po zakonczeniu wszystkich asynchronicznych rzeczy
    thumbnailsUpdate();
    characterBarUpdate();
    
}
function thumbnailsUpdate(){
    if((uczen_pobrany.helmet)>0){
        $('#character_helmet_thumbnail').attr("style","background-image:url("+armory.helmet_array[uczen_pobrany.helmet-1].thumbnail+")");
        $('#character_helmet_thumbnail').attr("itemid",armory.helmet_array[uczen_pobrany.helmet-1].id);
        $('#character_helmet_thumbnail').attr("itemtype","helmet");
        $('#character_helmet_thumbnail').removeAttr("disabled");
    }else{
        $('#character_helmet_thumbnail').attr("style","null");
        //$('#character_helmet_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.torso)>0){
        $('#character_torso_thumbnail').attr("style","background-image:url("+armory.torso_array[uczen_pobrany.torso-1].thumbnail+")");
        $('#character_torso_thumbnail').attr("itemid",armory.torso_array[uczen_pobrany.torso-1].id);
        $('#character_torso_thumbnail').attr("itemtype","torso");
        $('#character_torso_thumbnail').removeAttr("disabled");
    }else{
        $('#character_torso_thumbnail').attr("style","null");
        //$('#character_torso_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.gloves)>0){
        $('#character_gloves_thumbnail').attr("style","background-image:url("+armory.gloves_array[uczen_pobrany.gloves-1].thumbnail+")");
        $('#character_gloves_thumbnail').attr("itemid",armory.gloves_array[uczen_pobrany.gloves-1].id);
        $('#character_gloves_thumbnail').attr("itemtype","gloves");
        $('#character_gloves_thumbnail').removeAttr("disabled");
    }else{
        $('#character_gloves_thumbnail').attr("style","null");
        //$('#character_gloves_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.pants)>0){
        $('#character_pants_thumbnail').attr("style","background-image:url("+armory.pants_array[uczen_pobrany.pants-1].thumbnail+")");
        $('#character_pants_thumbnail').attr("itemid",armory.pants_array[uczen_pobrany.pants-1].id);
        $('#character_pants_thumbnail').attr("itemtype","pants");
        $('#character_pants_thumbnail').removeAttr("disabled");
    }else{
        $('#character_pants_thumbnail').attr("style","null");
        //$('#character_pants_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.boots)>0){
        $('#character_boots_thumbnail').attr("style","background-image:url("+armory.boots_array[uczen_pobrany.boots-1].thumbnail+")");
        $('#character_boots_thumbnail').attr("itemid",armory.boots_array[uczen_pobrany.boots-1].id);
        $('#character_boots_thumbnail').attr("itemtype","boots");
        $('#character_boots_thumbnail').removeAttr("disabled");
    }else{
        $('#character_boots_thumbnail').attr("style","null");
        //$('#character_boots_thumbnail').attr("disabled","true");
    }
        if((uczen_pobrany.weapon)>0){
        $('#character_weapon_thumbnail').attr("style","background-image:url("+armory.weapon_array[uczen_pobrany.weapon-1].thumbnail+")");
        $('#character_weapon_thumbnail').attr("itemid",armory.weapon_array[uczen_pobrany.weapon-1].id);
        $('#character_weapon_thumbnail').attr("itemtype","weapon");
        $('#character_weapon_thumbnail').removeAttr("disabled");
    }else{
        $('#character_weapon_thumbnail').attr("style","null");
        //$('#character_weapon_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.weapon2)>0){
        $('#character_weapon2_thumbnail').attr("style","background-image:url("+armory.weapon2_array[uczen_pobrany.weapon2-1].thumbnail+")");
        $('#character_weapon2_thumbnail').attr("itemid",armory.weapon2_array[uczen_pobrany.weapon2-1].id);
        $('#character_weapon2_thumbnail').attr("itemtype","weapon2");
        $('#character_weapon2_thumbnail').removeAttr("disabled");
    }else{
        $('#character_weapon2_thumbnail').attr("style","null");
        //$('#character_weapon2_thumbnail').attr("disabled","true");
    }

    if((uczen_pobrany.weapon3)>0){
        $('#character_weapon3_thumbnail').attr("style","background-image:url("+armory.weapon3_array[uczen_pobrany.weapon3-1].thumbnail+")");
        $('#character_weapon3_thumbnail').attr("itemid",armory.weapon3_array[uczen_pobrany.weapon3-1].id);
        $('#character_weapon3_thumbnail').attr("itemtype","weapon3");
        $('#character_weapon3_thumbnail').removeAttr("disabled");
    }else{
        $('#character_weapon3_thumbnail').attr("style","null");
        //$('#character_weapon3_thumbnail').attr("disabled","true");
    }

    if((uczen_pobrany.weapon4)>0){
        $('#character_weapon4_thumbnail').attr("style","background-image:url("+armory.weapon4_array[uczen_pobrany.weapon4-1].thumbnail+")");
        $('#character_weapon4_thumbnail').attr("itemid",armory.weapon4_array[uczen_pobrany.weapon4-1].id);
        $('#character_weapon4_thumbnail').attr("itemtype","weapon4");
        $('#character_weapon4_thumbnail').removeAttr("disabled");
    }else{
        $('#character_weapon4_thumbnail').attr("style","null");
        //$('#character_weapon4_thumbnail').attr("disabled","true");
    }

    if((uczen_pobrany.weapon5)>0){
        $('#character_weapon5_thumbnail').attr("style","background-image:url("+armory.weapon5_array[uczen_pobrany.weapon5-1].thumbnail+")");
        $('#character_weapon5_thumbnail').attr("itemid",armory.weapon5_array[uczen_pobrany.weapon5-1].id);
        $('#character_weapon5_thumbnail').attr("itemtype","weapon5");
        $('#character_weapon5_thumbnail').removeAttr("disabled");
    }else{
        $('#character_weapon5_thumbnail').attr("style","null");
        //$('#character_weapon5_thumbnail').attr("disabled","true");
    }

    if((uczen_pobrany.perk1)>0){
        $('#character_perk1_thumbnail').attr("style","background-image:url("+armory.perk1_array[uczen_pobrany.perk1-1].thumbnail+")");
        $('#character_perk1_thumbnail').attr("itemid",armory.perk1_array[uczen_pobrany.perk1-1].id);
        $('#character_perk1_thumbnail').attr("itemtype","perk1");
        $('#character_perk1_thumbnail').removeAttr("disabled");
    }else{
        $('#character_perk1_thumbnail').attr("style","null");
        //$('#character_perk1_thumbnail').attr("disabled","true");
    }

    if((uczen_pobrany.perk2)>0){
        $('#character_perk2_thumbnail').attr("style","background-image:url("+armory.perk2_array[uczen_pobrany.perk2-1].thumbnail+")");
        $('#character_perk2_thumbnail').attr("itemid",armory.perk2_array[uczen_pobrany.perk2-1].id);
        $('#character_perk2_thumbnail').attr("itemtype","perk2");
        $('#character_perk2_thumbnail').removeAttr("disabled");
    }else{
        $('#character_perk2_thumbnail').attr("style","null");
        //$('#character_perk2_thumbnail').attr("disabled","true");
    }

    if((uczen_pobrany.perk3)>0){
        $('#character_perk3_thumbnail').attr("style","background-image:url("+armory.perk3_array[uczen_pobrany.perk3-1].thumbnail+")");
        $('#character_perk3_thumbnail').attr("itemid",armory.perk3_array[uczen_pobrany.perk3-1].id);
        $('#character_perk3_thumbnail').attr("itemtype","perk3");
        $('#character_perk3_thumbnail').removeAttr("disabled");
    }else{
        $('#character_perk3_thumbnail').attr("style","null");
        //$('#character_perk3_thumbnail').attr("disabled","true");
    }
}
function userDataUpdate(){
    $('.userdata').html("<center>Witaj "+login+" "+password+"!</center><br> Dysponujesz "+monety+" monetami. <br> Wartość postaci: "+wartosc_postaci+"<br> Możesz wydać: "+mozesz_wydac+" monet. <br> Wykorzystanie budżetu: "+((wartosc_postaci/monety)*100).toPrecision(3)+"%" );

    //console.log("REDI");
}
</script>

</html>