 
function GetTours () {

 document.getElementById("loading").classList.add("displayBlock");
 
    let globDatas = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;;
    let globCount = document.getElementById("countries").options[document.getElementById("countries").selectedIndex].value;;
    let globCities = document.getElementById("cities").options[document.getElementById("cities").selectedIndex].value;
    let fly = document.getElementById("flyCheck").checked;
     $.ajax({
     url:"gateway_start.php", //the page containing PHP скрипт
     type: "POST", //request type
     data: {city: globDatas, count: globCount, cities :globCities,flyCheck:fly },
     success:function(result){
         
     document.getElementById("searchResult").innerHTML=result;
     document.getElementById("loading").classList.remove("displayBlock");
     
         for(var i = 0; i<20 ;i++){
        
    //   var idTour = "tour"+i; 
       var element = document.getElementById('tour'+i);
       var attribute = element.getAttribute('imgUrl');
      
       element.style.backgroundImage = attribute;
 
       
       }
           }
});}
  
  
