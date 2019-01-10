using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class BuyButton : MonoBehaviour {



    public Item ItemToBuy;
	void Start () {
        ShopItemButton.ShopItemButtonPressedEvent += BuyButtonUpdate;

    }
	
	// Update is called once per frame
	void Update () {
		
	}

    void BuyButtonUpdate(GameObject button)
    {
        ItemToBuy = button.GetComponent<ShopItemButton>().Item;
        transform.GetChild(0).GetComponent<Text>().text = "<<Zamień na: " + ItemToBuy.name;
    }

    public void BuyButtonPressed()
    {

        //Debug.Log("Chesz kupic" + ItemToBuy.name + " które ma cene " + ItemToBuy.price + "jest typu: "+ItemToBuy.type + " jego id to: "+ItemToBuy.id);

        if(ItemToBuy.price > SQL.Character.SpendableCoins)
        {
            //Debug.Log("Nie możesz kupić");
        }
        else
        {
            switch(ItemToBuy.type)
            {
                case ShopSelectionEnum.primary:SQL.CharacterUpload("pri", ItemToBuy.id);break;
                case ShopSelectionEnum.secondary: SQL.CharacterUpload("sec", ItemToBuy.id); break;
                case ShopSelectionEnum.throwable: SQL.CharacterUpload("thr", ItemToBuy.id); break;
                case ShopSelectionEnum.mediikit: SQL.CharacterUpload("med", ItemToBuy.id); break;
                case ShopSelectionEnum.armor: SQL.CharacterUpload("armor", ItemToBuy.id); break;
                case ShopSelectionEnum.perk: SQL.CharacterUpload("perk", ItemToBuy.id); break;
            }
            //Debug.Log("Możesz kupić");

        }
    }
}
