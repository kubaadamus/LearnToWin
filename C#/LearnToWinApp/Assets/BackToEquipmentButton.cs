using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class BackToEquipmentButton : MonoBehaviour {
    public GameObject Camera;
    void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}

    public void BackToEquipment()
    {
        Camera.GetComponent<CameraScript>().TargetPosition = Camera.GetComponent<CameraScript>().MenuPos.transform.position;
    }
}
