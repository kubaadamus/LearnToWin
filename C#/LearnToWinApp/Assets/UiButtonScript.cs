using System.Collections;
using System.Collections.Generic;
using UnityEngine.UI;
using UnityEngine;
using UnityEditor;
using System;

public class UiButtonScript : MonoBehaviour {

    public enum UiButtonType { primary, secondary, throwable, medikit, armor, perk};
    public GameObject teksttestxD;
	public UiButtonType type;
    Button button;
    
	void Start () {


    }
    void Update () {

	}

    public void UiUpdate(object sender, EventArgs eventargs)
    {

    }

    public void onClickEventHandler()
    {
        switch(type)
        {

        }

    }
}
