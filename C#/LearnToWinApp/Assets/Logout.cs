using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class Logout : MonoBehaviour {

    public GameObject Camera;
    void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}

    public void logout()
    {
        Camera.GetComponent<CameraScript>().TargetPosition = Camera.GetComponent<CameraScript>().LoginPos.transform.position;
    }
}
