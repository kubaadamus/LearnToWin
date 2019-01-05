    //=================================================================== C A N V A S  ==========================================================================//
    class Vector2{
        constructor(x,y){
            this.x = x;
            this.y = y;
        }
        coords(){
            alert("x:"+this.x+" y:"+this.y);
        }
        }
        class Chest{
            constructor(position, src,head,larm,rarm,legs){
                this.position = position;
                this.img = new Image();
                this.img.src = src;
                this.head = new Vector2(position.x+head.x-10,position.y+head.y-10);
                this.larm = new Vector2(position.x+larm.x-10,position.y+larm.y-10);
                this.rarm = new Vector2(position.x+rarm.x-10,position.y+rarm.y-10);
                this.legs = new Vector2(position.x+legs.x-10,position.y+legs.y-10);
            }
        }
        class Head{
            constructor(position,src)
            {
                this.position = position;
                this.img = new Image();
                this.img.src = src;
            }
        }
        
        var canvas = document.querySelector('canvas');
        canvas.width = 400;
        canvas.height = 400;
        var c = canvas.getContext('2d');
        
        var czest = new Chest(new Vector2(200,200),'assets/character/chest/chest_1.png',new Vector2(0,-50),new Vector2(-40,-30),new Vector2(40,-30),new Vector2(0,50));
        var hed = new Head(czest.head,'assets/character/head/head_1.png');
        
        
        
        function animate(){
            c.clearRect(0,0,400,400);
            c.drawImage(czest.img, czest.position.x-czest.img.width/2, czest.position.y-czest.img.height/2);
            c.drawImage(hed.img, (hed.position.x-hed.img.width/2)+10, hed.position.y-hed.img.height/2);
            c.fillRect(czest.head.x,czest.head.y,20,20);
            c.fillRect(czest.larm.x,czest.larm.y,20,20);
            c.fillRect(czest.rarm.x,czest.rarm.y,20,20);
            c.fillRect(czest.legs.x,czest.legs.y,20,20);
        
            czest.img.onload = function() {
                animate();
        };
        }
        
        
        