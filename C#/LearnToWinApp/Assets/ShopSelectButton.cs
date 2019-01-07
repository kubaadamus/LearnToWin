using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
public enum ShopSelectionEnum { primary,secondary,throwable,mediikit,armor,perk};
public class ShopSelectButton : MonoBehaviour {


    public ShopSelectionEnum typ;
    public static event ShopSelectButtonDelegate ShopSelectButtonPressed;
    public delegate void ShopSelectButtonDelegate(object sender, EventArgs eventargs, ShopSelectionEnum typ);
    void Start()
    {

    }

    // Update is called once per frame
    void Update()
    {

    }
    public void ButtonPressed()
    {
        ShopSelectButtonPressed(null, null, typ);
    }
}
