using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;
public enum ShopSelectionEnum { primary,secondary,throwable,mediikit,armor,perk};
public class ShopSelectButton : MonoBehaviour {


    public ShopSelectionEnum typ;
    public static event ShopSelectButtonDelegate ShopSelectButtonPressed;
    public delegate void ShopSelectButtonDelegate(ShopSelectionEnum typ);
    void Start()
    {

    }

    // Update is called once per frame
    void Update()
    {

    }
    public void ButtonPressed()
    {
        ShopSelectButtonPressed(typ);
    }
}
