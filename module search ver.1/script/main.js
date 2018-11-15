




let adress = 'https://module.sletat.ru/Main.svc/';//справочник методов

let pass = 27863140; 
let login = 'fol@sletat.ru'; 





// ---------------------------Список Городов GetDepartCities ----------------------


    let http = new XMLHttpRequest();

    http.open("GET", adress + "GetDepartCities");
    http.send();
    http.onload = () => {
    
    let Prs = JSON.parse(http.responseText);//переводим результат в json
    console.log(Prs);//выводим в консоль для проверки

    for (let i=0; i < Prs.GetDepartCitiesResult.Data.length; i++){

    let newOption = document.createElement("option");
    newOption.setAttribute('value',Prs.GetDepartCitiesResult.Data[i].Id );
    newOption.innerHTML=Prs.GetDepartCitiesResult.Data[i].Name ;
     city.appendChild(newOption);
    }}
    

    
//-------------------------------------------------------------
// ---------------------------   GetCountries — Направления    ----------------------

let http2 = new XMLHttpRequest();
    
http2.open("GET", adress + "GetCountries");
http2.send();

http2.onload = () => {

let Prs2 = JSON.parse(http2.responseText);//переводим результат в json
console.log(Prs2);//выводим в консоль для проверки

for (let i=0; i < Prs2.GetCountriesResult.Data.length; i++){

    let newOption2 = document.createElement("option");
    newOption2.setAttribute('value',Prs2.GetCountriesResult.Data[i].Id );
    newOption2.innerHTML=Prs2.GetCountriesResult.Data[i].Name ;
    countries.appendChild(newOption2);


    }}





// -------------------------------------------------   
// ---------------------------- GetCities — Курорты  ---------------------


function init() {
                GetCities();
            }


function GetCities(){
   
    

    let http4 = new XMLHttpRequest();
    
    let selectCount = document.getElementById('countries');
    let countryId = selectCount.options[selectCount.selectedIndex].value ;//активный select countries

    http4.open("GET", adress + "GetCities?countryId=" + countryId );
    http4.send();
    
    
    

    http4.onload = () =>{

        let Prs4 = JSON.parse(http4.responseText);//переводим результат в json
        console.log(Prs4);//выводим в консоль для проверки
      //выводим в консоль для проверки
        

        cities.innerHTML='<option value="0">Все курорты</option>';// удаляем старые значения и добавляем пункт все курорты





        
        
        for (let i=0; i <= Prs4.GetCitiesResult.Data.length; i++){

            let newOption = document.createElement("option");
            
            newOption.setAttribute('value',Prs4.GetCitiesResult.Data[i].Id );
          

            newOption.innerHTML=Prs4.GetCitiesResult.Data[i].Name ;
            
            cities.appendChild(newOption);}
        
    }}
// -------------------------------------------------
// ------------------------GetTours — Список туров по заданным параметрам------------------------- 
// function GetTours(){
// let http3 = new XMLHttpRequest();

//     let selectCity = document.getElementById('city');
//     let fromId =selectCity.options[selectCity.selectedIndex].value ;// активный select city

//     let selectCount = document.getElementById('countries');
//     let countryId = selectCount.options[selectCount.selectedIndex].value ;//активный select countries
    
//     let citiesCount = cities.options[cities.selectedIndex].value;//активный select cities

    
//     http3.open("GET", adress + "GetTours?login="+ login + "&password="+ pass +"&cityFromId=" + fromId +"&countryId=" + countryId + "&cities="+ citiesCount + '&requestId=0&updateResult =0');
//     http3.send();

//     http3.onload = () => {

//     let Prs3;
//     window.Prs3 = JSON.parse(http3.responseText);//результат делаем глобальным и переводим в json


//     setTimeout( getTrsRes,2000); //задержка перед запросом результатов поиска после получения requestId



//     console.log(adress + "GetTours?login="+ login + "&password="+ pass +"&cityFromId=" + fromId +"&countryId=" + countryId + "&cities="+ citiesCount);
//     console.log(fromId);
//     console.log(countryId);
//     console.log(Prs3);

//     }}





// // -------------------------------------------------
//  //   ---------------------------- функция поиска туров по полученному requestId  ---------------------



// function getTrsRes() {
//     let http31 = new XMLHttpRequest();
//     let requestId = Prs3.GetToursResult.Data.requestId;
//     let selectCity = document.getElementById('city');
//     let fromId =selectCity.options[selectCity.selectedIndex].value ;// активный select city

//     let selectCount = document.getElementById('countries');
//     let countryId = selectCount.options[selectCount.selectedIndex].value ;//активный select countries

//     let citiesCount = cities.options[cities.selectedIndex].value;//активный select cities
    
//     http31.open("GET", adress + "GetTours?login="+ login + "&password="+ pass +"&cityFromId=" + fromId +"&countryId=" + countryId + "&cities="+ citiesCount + '&requestId' + requestId + '&updateResult=1');
//     http31.send();

//     result.innerHTML='<span></span>';// убираем результаты старого поиска

    
    
    
    
//     http31.onload = () =>{
    
//     let Prs31 = JSON.parse(http31.responseText);
//     console.log(adress + "GetTours?login="+ login + "&password="+ pass +"&cityFromId=" + fromId +"&countryId=" + countryId + "&cities="+ citiesCount + '&requestId' + requestId + '&updateResult=1')
//     console.log(Prs31); 
       
//  //   ---------------------------- обрабатываем полученые туры и выводим на экран  ---------------------

//     for (let i=0; i < Prs31.GetToursResult.Data.aaData.length; i++){


//     let newOption31 = document.createElement('div');
    
//     newOption31.setAttribute('value',Prs31.GetToursResult.Data.aaData[i][0]);
//     newOption31.className= 'res';
//     newOption31.innerHTML=Prs31.GetToursResult.Data.aaData[i][48] + '<img class="hotelImg" src=https:'+ Prs31.GetToursResult.Data.aaData[i][29] +'>' ;
    
//     result.appendChild(newOption31);
//     }}}
    


    
    