using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
public enum CharacterGearItemButtonType { Primary, Secondary, Throwable, Med, Armor, Perk};
public class CharacterGearItemButton : MonoBehaviour {


    public CharacterGearItemButtonType type;
    public GameObject CurrentItemProperties;
    Image CurrentImage;

    void Start () {
        CurrentImage = GameObject.Find("CurrentImage").GetComponent<Image>();

        SQL.CharacterGearItemButtonUpdateEvent += CharacterGearItemButtonUpdate;

    }
	

	void Update () {
		
	}

    public void CharacterGearItemButtonUpdate()
    {
        Texture2D thumbnail;
        switch (type)
        {
            
            case CharacterGearItemButtonType.Primary:
                transform.GetChild(0).GetComponent<Text>().text = SQL.Character.primary_obj.name;
                thumbnail = SQL.Character.primary_obj.texture;
                GetComponent<Image>().sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Secondary:
                transform.GetChild(0).GetComponent<Text>().text = SQL.Character.secondary_obj.name;
                thumbnail = SQL.Character.secondary_obj.texture;
                GetComponent<Image>().sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Throwable:
                transform.GetChild(0).GetComponent<Text>().text = SQL.Character.throwable_obj.name;
                thumbnail = SQL.Character.throwable_obj.texture;
                GetComponent<Image>().sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Med:
                transform.GetChild(0).GetComponent<Text>().text = SQL.Character.med_obj.name;
                thumbnail = SQL.Character.med_obj.texture;
                GetComponent<Image>().sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Armor:
                transform.GetChild(0).GetComponent<Text>().text = SQL.Character.armor_obj.name;
                thumbnail = SQL.Character.armor_obj.texture;
                GetComponent<Image>().sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Perk:
                transform.GetChild(0).GetComponent<Text>().text = SQL.Character.perk_obj.name;
                thumbnail = SQL.Character.perk_obj.texture;
                GetComponent<Image>().sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

        }

    }

    public void ButtonPressed()
    {
        Texture2D thumbnail;
        switch (type)
        {

            case CharacterGearItemButtonType.Primary:
                CurrentItemProperties.GetComponent<Text>().text = SQL.Character.primary_obj.name;
                thumbnail = SQL.Character.primary_obj.texture;
                CurrentImage.sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Secondary:
                CurrentItemProperties.GetComponent<Text>().text = SQL.Character.secondary_obj.name;
                thumbnail = SQL.Character.secondary_obj.texture;
                CurrentImage.sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Throwable:
                CurrentItemProperties.GetComponent<Text>().text = SQL.Character.throwable_obj.name;
                thumbnail = SQL.Character.throwable_obj.texture;
                CurrentImage.sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Med:
                CurrentItemProperties.GetComponent<Text>().text = SQL.Character.med_obj.name;
                thumbnail = SQL.Character.med_obj.texture;
                CurrentImage.sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Armor:
                CurrentItemProperties.GetComponent<Text>().text = SQL.Character.armor_obj.name;
                thumbnail = SQL.Character.armor_obj.texture;
                CurrentImage.sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

            case CharacterGearItemButtonType.Perk:
                CurrentItemProperties.GetComponent<Text>().text = SQL.Character.perk_obj.name;
                thumbnail = SQL.Character.perk_obj.texture;
                CurrentImage.sprite = Sprite.Create(thumbnail, new Rect(0.0f, 0.0f, thumbnail.width, thumbnail.height), new Vector2(0.5f, 0.5f), 100.0f);
                break;

        }
    }
}
