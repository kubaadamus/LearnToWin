using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;

public class ShopItemButtonScript : MonoBehaviour {

    public ItemType typ;
    public static event Del2 ShopButtonPressed;
    public delegate void Del2(object sender, EventArgs eventargs, ItemType typ);
    void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}
    public void ButtonPressed()
    {
        ShopButtonPressed(null,null, typ);
    }
}
