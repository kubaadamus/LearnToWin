using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
using UnityEngine.UI;

public class ShopItemButton : MonoBehaviour {


    public Item Item;
    public static event ShopItemButtonDelegate ShopItemButtonPressed;
    public delegate void ShopItemButtonDelegate(GameObject button);
    GameObject BuyItemProperties;
    GameObject BuyImage;
    private void Start()
    {
        BuyItemProperties = GameObject.Find("BuyProperties");
        BuyImage = GameObject.Find("BuyImage");
        Debug.Log("Utworzono guzik z primary xD");
        Debug.Log(Item.name);
        transform.GetChild(0).GetComponent<Text>().text = Item.name;
        GetComponent<Image>().sprite = Sprite.Create(Item.texture, new Rect(0.0f, 0.0f, Item.texture.width, Item.texture.height), new Vector2(0.5f, 0.5f), 100.0f);
        if (Item.price>SQL.Character.SpendableCoins)
        {
            transform.GetChild(0).GetComponent<Text>().text = Item.name+"za drogie";
        }
    }
    public void ButtonPressed()
    {
        ShopItemButtonPressed(gameObject);
        BuyItemProperties.GetComponent<Text>().text = Item.name;
        BuyImage.GetComponent<Image>().sprite = Sprite.Create(Item.texture, new Rect(0.0f, 0.0f, Item.texture.width, Item.texture.height), new Vector2(0.5f, 0.5f), 100.0f);
    }
}
