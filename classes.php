<?php
class uczen_object
{

   //Ekwipunek
   public $base = 0;
   public $helmet = 0;
   public $torso = 0;
   public $gloves = 0;
   public $pants = 0;
   public $boots = 0;
   public $weapon = 0;

 
   public function __construct($_base=0, $_helmet=0, $_torso=0, $_gloves=0, $_pants=0, $_boots=0, $_weapon=0)
   {
      //Ekwipunek
      $this->base = $_base;
      $this->helmet = $_helmet;
      $this->torso = $_torso;
      $this->gloves = $_gloves;
      $this->pants = $_pants;
      $this->boots = $_boots;
      $this->weapon = $_weapon;
      //$this->wypisz();
   }
   public function wypisz(){
       //Ekwipunek
       debug_to_console("base:".$this->base);
       debug_to_console("helmet:".$this->helmet);
       debug_to_console("torso:".$this->torso);
       debug_to_console("gloves:".$this->gloves);
       debug_to_console("pants:".$this->pants);
       debug_to_console("boots:".$this->boots);
       debug_to_console("weapon:".$this->weapon);
       debug_to_console("--------------------------------");
   }
}


class item_object{

    public $id = 0;
    public $name = 0;
    public $price = 0;
    public $defence = 0;
    public $attack = 0;
    public $thumbnail = 0;
 
  
    public function __construct($_id=0, $_name=0, $_price=0, $_defence=0, $_attack=0, $_thumbnail=0)
    {
 
       $this->id = $_id;
       $this->name = $_name;
       $this->price = $_price;
       $this->defence = $_defence;
       $this->attack = $_attack;
       $this->thumbnail = $_thumbnail;
 
    }
 }

 function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

?>