using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
using UnityEngine.UI;

public class ShopItemButton : MonoBehaviour {


    public Item Item;

    public static event ShopItemButtonDelegate ShopItemButtonPressedEvent;
    public delegate void ShopItemButtonDelegate(GameObject button);
    GameObject BuyItemProperties;
    GameObject BuyImage;
    private void Start()
    {
        BuyItemProperties = GameObject.Find("BuyProperties");
        BuyImage = GameObject.Find("BuyImage");
        //Debug.Log(Item.name);
        transform.GetChild(0).GetComponent<Text>().text = Item.name;
        GetComponent<Image>().sprite = Sprite.Create(Item.texture, new Rect(0.0f, 0.0f, Item.texture.width, Item.texture.height), new Vector2(0.5f, 0.5f), 100.0f);
        if (Item.price>SQL.Character.SpendableCoins)
        {
            transform.GetChild(0).GetComponent<Text>().text = Item.name+"za drogie";
            var colors = GetComponent<Button>().colors;
            colors.normalColor = Color.red;
            colors.highlightedColor = Color.red;
            colors.pressedColor = Color.red;
            GetComponent<Button>().colors = colors;
        }
        //Debug.Log("Stworzono guzik z typem Itemu: " + Item.type);
    }
    public void ButtonPressed()
    {
        ShopItemButtonPressedEvent(gameObject);
        BuyItemProperties.GetComponent<Text>().text = Item.name;
        BuyImage.GetComponent<Image>().sprite = Sprite.Create(Item.texture, new Rect(0.0f, 0.0f, Item.texture.width, Item.texture.height), new Vector2(0.5f, 0.5f), 100.0f);

        GameObject.Find("BuyButton").GetComponent<BuyButton>().ItemToBuy = Item;

    }
}
