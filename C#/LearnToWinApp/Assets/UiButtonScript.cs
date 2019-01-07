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
        SQL.SqlFinished += UiUpdate;
        button = GetComponent<Button>();

    }
    void Update () {
        if(Input.GetKeyDown(KeyCode.G))
        {
            UiUpdate(null, null);
        }
	}

    public void UiUpdate(object sender, EventArgs eventargs)
    {
        if(type == UiButtonType.primary)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.primary.name;
        }
        if (type == UiButtonType.secondary)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.secondary.name;
        }
        if (type == UiButtonType.throwable)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.throwable.name;
        }
        if (type == UiButtonType.medikit)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.medikit.name;
        }
        if (type == UiButtonType.armor)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.armor.name;
        }
        if (type == UiButtonType.perk)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.perk.name;
        }
    }

    public void onClickEventHandler()
    {
        switch(type)
        {
            case UiButtonType.primary:teksttestxD.GetComponent<Text>().text = SQL.Character.primary.DescribeItem(); break;
            case UiButtonType.secondary: teksttestxD.GetComponent<Text>().text = SQL.Character.secondary.DescribeItem(); break;
            case UiButtonType.throwable: teksttestxD.GetComponent<Text>().text = SQL.Character.throwable.DescribeItem(); break;
            case UiButtonType.armor: teksttestxD.GetComponent<Text>().text = SQL.Character.armor.DescribeItem(); break;
            case UiButtonType.medikit: teksttestxD.GetComponent<Text>().text = SQL.Character.medikit.DescribeItem(); break;
            case UiButtonType.perk: teksttestxD.GetComponent<Text>().text = SQL.Character.perk.DescribeItem(); break;
        }

    }
}
