using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class ShopScrollBar : MonoBehaviour {

    public GameObject ShopItemsParent;
	void Start () {
        ShopItemsParent.transform.position = new Vector3(2 - GetComponent<Scrollbar>().value * SQL.ShopItemsCount, ShopItemsParent.transform.position.y, ShopItemsParent.transform.position.z);


    }
	
	// Update is called once per frame
	void Update () {
        if (Input.GetAxis("Mouse ScrollWheel") > 0f) // forward
        {
            GetComponent<Scrollbar>().value -= 0.1f;
        }
        else if (Input.GetAxis("Mouse ScrollWheel") < 0f) // backwards
        {
            GetComponent<Scrollbar>().value += 0.1f;
        }
    }

    public void ShopItemsScrollbarValueChanged()
    {
        ShopItemsParent.transform.position = new Vector3(2-(GetComponent<Scrollbar>().value*2)*SQL.ShopItemsCount, ShopItemsParent.transform.position.y, ShopItemsParent.transform.position.z);
    }
}
