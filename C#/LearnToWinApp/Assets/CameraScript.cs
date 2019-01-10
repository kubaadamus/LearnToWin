using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CameraScript : MonoBehaviour {

    public GameObject LoginPos;
    public GameObject MenuPos;
    public GameObject RankPos;
    public Vector3 TargetPosition;
	void Start () {
        TargetPosition = LoginPos.transform.position;
	}
	
	// Update is called once per frame
	void Update () {
		if(transform.position!=TargetPosition)
        {
            transform.position += (TargetPosition - transform.position)/20.0f;
        }
	}
}
