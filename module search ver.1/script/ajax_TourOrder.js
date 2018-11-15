function SaveTourOrder () {

 document.getElementById("loading").classList.add("displayBlock");
 
 var sourceId = document.getElementById("sourceidCard").textContent;
 var offerId = document.getElementById("offeridCard").textContent;
 var requestId = document.getElementById("requestidCard").textContent;
 
var user = document.getElementById("user").value;
var email = document.getElementById("email").value;
var phone = document.getElementById("phone").value;
 
 
 
     $.ajax({
     url:"SaveTourOrder.php", //the page containing PHP скрипт
     type: "POST", //request type
     data: {sourceId: sourceId, offerId: offerId, requestId :requestId,user:user,email: email,phone: phone},
     success:function(result){
     document.getElementById("actualize").innerHTML=result;
     document.getElementById("loading").classList.remove("displayBlock");
     document.getElementById("actualize").classList.add("displayBlock");
           }
});}
  
  

function closeCard(){
    
    document.getElementById("actualize").classList.remove("displayBlock");
}