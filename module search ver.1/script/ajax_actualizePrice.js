function actualizePrice (obj) {

 document.getElementById("loading").classList.add("displayBlock");
 
 var sourceId = obj.getAttribute("sourceId");
 var offerId = obj.getAttribute("offerId");
 var requestId = obj.getAttribute("requestid");
 
 
     $.ajax({
     url:"actualizePrice.php", //the page containing PHP скрипт
     type: "POST", //request type
     data: {sourceId: sourceId, offerId: offerId, requestId :requestId},
     success:function(result){
     document.getElementById("actualize").innerHTML=result;
     document.getElementById("loading").classList.remove("displayBlock");
     document.getElementById("actualize").classList.add("displayBlock");
           }
});}
  
  
// let sourceId = obj.sourceId;
//     let offerId = obj.offerId;
//     let requestId = obj.requestId;
function closeCard(){
    document.getElementById("actualize").classList.remove("displayBlock");
    
   
    
    
}