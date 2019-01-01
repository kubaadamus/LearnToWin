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

