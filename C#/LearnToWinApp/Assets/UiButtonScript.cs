using System.Collections;
using System.Collections.Generic;
using UnityEngine.UI;
using UnityEngine;
using UnityEditor;
using System;

public class UiButtonScript : MonoBehaviour {

    public enum UiButtonType { primary, secondary, throwable, medikit, armor, perk};
    bool once = true;
	public UiButtonType type;
    Button button;
    
	void Start () {

        button = GetComponent<Button>();
        SQL.SqlFinished += UiUpdate;
    }
	
    
	void Update () {

	}

    public void UiUpdate(object sender, EventArgs eventargs)
    {
        if (type == UiButtonType.primary && SQL.Character.primary != null)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.primary.name;
        }

        else if (type == UiButtonType.secondary && SQL.Character.secondary != null)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.secondary.name;
        }
        else if (type == UiButtonType.throwable && SQL.Character.throwable != null)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.throwable.name;
        }
        else if (type == UiButtonType.medikit && SQL.Character.medikit!=null)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.medikit.name;
        }
        else if (type == UiButtonType.armor && SQL.Character.armor != null)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.armor.name;
        }
        else if (type == UiButtonType.perk && SQL.Character.perk != null)
        {
            button.GetComponentInChildren<Text>().text = SQL.Character.perk.name;
        }
        else
        {
            button.GetComponentInChildren<Text>().text = "BRAK";
        }
    }
}
