var a = 2;
var b = 20;
function addTours(){
    for(var i = 0; i<10 ;i++){
        
       var cl = "page"+a; 
       var elem = document.getElementsByClassName(cl);
      
       elem[i].classList.add("displayFlex")
       }
    

    a +=1; 
    
    
    
     for(var j=b;j<b+10;j++){
   
       var elementImg = document.getElementById('tour'+j);
       
       
       var attributeImg = elementImg.getAttribute('imgUrl');
       
       
       elementImg.style.backgroundImage = attributeImg;
       
       
      }
       
       
    
    b+=10;
    return a,b;
    
} 

