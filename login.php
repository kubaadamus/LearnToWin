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
            <div class="character_avatar">
                <img src="assets/character/doll.png" id="character_base_thumbnail" alt="">
            </div>
            <input id="character_helmet_thumbnail" style="" canafford="tru" class="itemSelect" type="button" itemtype="base" itemid="1">
            <input id="character_torso_thumbnail" style="" canafford="tru" class="itemSelect" type="button" itemtype="base" itemid="1">
            <input id="character_gloves_thumbnail" style="" canafford="tru" class="itemSelect" type="button" itemtype="base" itemid="1">
            <input id="character_pants_thumbnail" style="" canafford="tru" class="itemSelect" type="button" itemtype="base" itemid="1">
            <input id="character_boots_thumbnail" style="" canafford="tru" class="itemSelect" type="button" itemtype="base" itemid="1">
            <input id="character_weapon_thumbnail" style="" canafford="tru" class="itemSelect" type="button" itemtype="base" itemid="1">


        </div>
    </div>
    <div class="columns">
        <div class="item_container">
            <div class="item_thumbnail" ></div>
            <div class="item_properties" ></div>
            <input class="buyBtn" id="buyBtn" type='button' value='kup' item_name='name' item_id='id' sellbuy='buy' autoPowrot="0">
        </div>
        <div class="storage_wrapper">
            <input class="ShopSelectBtn" type="button" value=" bases" select="base">
            <input class="ShopSelectBtn" type="button" value=" torsos" select="torso">
            <input class="ShopSelectBtn" type="button" value=" weapons" select="weapon">
            <input class="ShopSelectBtn" type="button" value=" boots" select="boots">
            <input class="ShopSelectBtn" type="button" value=" helmets" select="helmet">
            <input class="ShopSelectBtn" type="button" value=" gloves" select="gloves">
            <input class="ShopSelectBtn" type="button" value=" pants" select="pants">
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
   constructor(_base=0, _helmet=0, _torso=0, _gloves=0, _pants=0, _boots=0, _weapon=0)
   {
      //Ekwipunek
      this.base = _base;
      this.helmet = _helmet;
      this.torso = _torso;
      this.gloves = _gloves;
      this.pants = _pants;
      this.boots = _boots;
      this.weapon = _weapon;
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
        console.log(data);
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
    PostUpdatesCallback();
    return armory;
    });
    return false;
};
function armory_draw(_armory){
    $( ".shop_container" ).children().remove();

    $( ".shop_container" ).append( "<div class='item_group' itemClass='base'> " );
    for(var i=0; i<_armory.base_array.length; i++){$( "div[itemClass=base]" ).append( "<input style='background-image:url("+_armory.base_array[i].thumbnail+");' canAfford='"+((mozesz_wydac-_armory.base_array[i].price)>0? 'tru':'nope')+"' class='itemSelect' type='button' itemType='base' itemID='"+_armory.base_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='torso'> " );
    for(var i=0; i<_armory.torso_array.length; i++){$( "div[itemClass=torso]" ).append( "<input style='background-image:url("+_armory.torso_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.torso_array[i].price)>0? 'tru':'nope')+"'  class='itemSelect' type='button' itemType='torso' itemID='"+_armory.torso_array[i].id+"'>");}
    $( ".shop_container" ).append( "</div>");

    $( ".shop_container" ).append( "<div class='item_group' itemClass='weapon'> " );
    for(var i=0; i<_armory.weapon_array.length; i++){$( "div[itemClass=weapon]" ).append( "<input style='background-image:url("+_armory.weapon_array[i].thumbnail+");'canAfford='"+((mozesz_wydac-_armory.weapon_array[i].price)>0? 'tru':'nope')+"'  class='itemSelect' type='button' itemType='weapon' itemID='"+_armory.weapon_array[i].id+"'>");
    }
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

    lastOpenedShop.click();
    lastOpenedItem.click();
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
            
      $('.item_thumbnail').css("background-image", "url("+object.thumbnail+")");
      $('.item_properties').html( object.id+" "+object.name+" "+object.price+" "+object.defence+" "+object.attack );
      $('#buyBtn').attr("value","kup "+object.name+"");
      $('#buyBtn').attr("item_name",$(event.target).attr('itemType'));
      $('#buyBtn').attr("item_id",$(event.target).attr('itemID'));
      $('#buyBtn').attr("sellbuy",'buy');
      $('#buyBtn').attr("autoPowrot",'1');
      $('#buyBtn').show();
      
});
$(document).on('click', '#buyBtn', function(event){ 
CheckBuyAvailibility('base',uczen_pobrany.base);
CheckBuyAvailibility('helmet',uczen_pobrany.helmet);
CheckBuyAvailibility('torso',uczen_pobrany.torso);
CheckBuyAvailibility('gloves',uczen_pobrany.gloves);
CheckBuyAvailibility('weapon',uczen_pobrany.weapon);
CheckBuyAvailibility('boots',uczen_pobrany.boots);
CheckBuyAvailibility('pants',uczen_pobrany.pants);
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
//console.log("Sprzedajemy "+$_item);
    $('#buyBtn').attr("item_name",$_item);
    $('#buyBtn').attr("item_id",$_id);
    $('#buyBtn').attr("sellbuy",'sell');
    $('#buyBtn').attr("autoPowrot",'1');
    sell_buy();
};
function sell_buy() { //Skrypt kupująco/sprzedający
var item = $('#buyBtn').attr("item_name");
var id = $('#buyBtn').attr("item_id");
var sellbuy = $('#buyBtn').attr("sellbuy");
var autoPowrot = $('#buyBtn').attr("autoPowrot");
$.get('buy.php',{login:login,password:password,sellbuy:sellbuy,item:item,id:id,autoPowrot:autoPowrot}, function(data){

    coins_update();
    user_create();
    armory = armory_create();

 });
 return false;
};

function PostUpdatesCallback(){ // Funkcja która odpali się dopiero po zakonczeniu wszystkich asynchronicznych rzeczy

    if((uczen_pobrany.helmet)>0){
        $('#character_helmet_thumbnail').attr("style","background-image:url("+armory.helmet_array[uczen_pobrany.helmet-1].thumbnail+")");
        $('#character_helmet_thumbnail').attr("itemid",armory.helmet_array[uczen_pobrany.helmet-1].id);
        $('#character_helmet_thumbnail').attr("itemtype","helmet");
        $('#character_helmet_thumbnail').removeAttr("disabled");
    }else{
        $('#character_helmet_thumbnail').attr("style","null");
        $('#character_helmet_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.torso)>0){
        $('#character_torso_thumbnail').attr("style","background-image:url("+armory.torso_array[uczen_pobrany.torso-1].thumbnail+")");
        $('#character_torso_thumbnail').attr("itemid",armory.torso_array[uczen_pobrany.torso-1].id);
        $('#character_torso_thumbnail').attr("itemtype","torso");
        $('#character_torso_thumbnail').removeAttr("disabled");
    }else{
        $('#character_torso_thumbnail').attr("style","null");
        $('#character_torso_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.gloves)>0){
        $('#character_gloves_thumbnail').attr("style","background-image:url("+armory.gloves_array[uczen_pobrany.gloves-1].thumbnail+")");
        $('#character_gloves_thumbnail').attr("itemid",armory.gloves_array[uczen_pobrany.gloves-1].id);
        $('#character_gloves_thumbnail').attr("itemtype","gloves");
        $('#character_gloves_thumbnail').removeAttr("disabled");
    }else{
        $('#character_gloves_thumbnail').attr("style","null");
        $('#character_gloves_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.pants)>0){
        $('#character_pants_thumbnail').attr("style","background-image:url("+armory.pants_array[uczen_pobrany.pants-1].thumbnail+")");
        $('#character_pants_thumbnail').attr("itemid",armory.pants_array[uczen_pobrany.pants-1].id);
        $('#character_pants_thumbnail').attr("itemtype","pants");
        $('#character_pants_thumbnail').removeAttr("disabled");
    }else{
        $('#character_pants_thumbnail').attr("style","null");
        $('#character_pants_thumbnail').attr("disabled","true");
    }
    if((uczen_pobrany.boots)>0){
        $('#character_boots_thumbnail').attr("style","background-image:url("+armory.boots_array[uczen_pobrany.boots-1].thumbnail+")");
        $('#character_boots_thumbnail').attr("itemid",armory.boots_array[uczen_pobrany.boots-1].id);
        $('#character_boots_thumbnail').attr("itemtype","boots");
        $('#character_boots_thumbnail').removeAttr("disabled");
    }else{
        $('#character_boots_thumbnail').attr("style","null");
        $('#character_boots_thumbnail').attr("disabled","true");
    }
        if((uczen_pobrany.weapon)>0){
        $('#character_weapon_thumbnail').attr("style","background-image:url("+armory.weapon_array[uczen_pobrany.weapon-1].thumbnail+")");
        $('#character_weapon_thumbnail').attr("itemid",armory.weapon_array[uczen_pobrany.weapon-1].id);
        $('#character_weapon_thumbnail').attr("itemtype","weapon");
        $('#character_weapon_thumbnail').removeAttr("disabled");
    }else{
        $('#character_weapon_thumbnail').attr("style","null");
        $('#character_weapon_thumbnail').attr("disabled","true");
    }
    

}
</script>

</html>