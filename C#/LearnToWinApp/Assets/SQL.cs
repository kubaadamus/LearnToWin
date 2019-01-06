
using UnityEngine;
using System.Web.Script.Serialization;
using System;
using System.Collections.Generic;

public class SQL : MonoBehaviour {

	void Start () {

        //rifles
        Item m4a1 = new Item(ItemType.rifle, 120, "m4a1", "assets/m4a1");

        //pistols
        Item desertEagle = new Item(ItemType.pistol, 60, "desertEagle", "assets/desertEagle");

        //throwable
        Item F1Grenade = new Item(ItemType.grenade, 70, "F1Grenade", "assets/F1Grenade");

        //medikits
        Item FirstAidKit = new Item(ItemType.medikit, 20, "FirstAidKit", "assets/firstAidKit");

        //armors
        Item BasicArmor = new Item(ItemType.armor, 40, "BasicArmor", "assets/BasicArmor");


        Uczen Character = new Uczen("Jakub", "Adamus", m4a1, desertEagle, F1Grenade, FirstAidKit, BasicArmor,new List<Item>());

        Character.ItemList.Add(new Item(ItemType.rifle, 20, "aaa", "aaabbb"));

        var json = new JavaScriptSerializer().Serialize(Character);

        Debug.Log(json);
    }


}

public class Uczen
{
    public string imie;
    public string nazwisko;

    //ekwipunek
    public Item primary;
    public Item secondary;
    public Item throwable;
    public Item medikit;
    public Item armor;

    public List<Item> ItemList;

    public Uczen(string imie, string nazwisko, Item primary, Item secondary, Item throwable, Item medikit, Item armor, List<Item> itemList)
    {
        this.imie = imie;
        this.nazwisko = nazwisko;
        this.primary = primary;
        this.secondary = secondary;
        this.throwable = throwable;
        this.medikit = medikit;
        this.armor = armor;
        ItemList = itemList;
    }
}
public class Item
{
    public ItemType type;
    public int price;
    public string name;
    public string thumbnail;

    public Item(ItemType type, int price, string name, string thumbnail)
    {
        this.type = type;
        this.price = price;
        this.name = name;
        this.thumbnail = thumbnail;
    }
}

public enum ItemType {pistol, rifle, grenade, armor, ammo, medikit};
