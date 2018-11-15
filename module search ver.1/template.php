<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
     <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>   
    <script src="script/plugin.js"></script>
    <script src="script/script.js"></script>
    <script src="script/main.js"></script>
    <script src="script/ajax.js"></script>
    <script src="script/paginator.js"></script>
    <script src="script/ajax_actualizePrice.js"></script>
    <script src="script/ajax_TourOrder.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Notable" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/styleTour.css">
    <link rel="stylesheet" href="style/styleCard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Prosto+One" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    
    
    <title>Поиск туров</title>
</head>
<body onload="init()">
      <span id="fon"></span>
    
<div id="preloader">
   <div class="dws-progress-bar"></div>
</div>
        
        
<div class="generalPage" id="block_search">
    <div class="row">
        <div class="col-3"></div>
        <div class="search col-6">
            <form>
                <div class="sel"><select class="form-control" onChange="getCityNew()" id="city"></select></div>
                <div class="sel"><select class="form-control"  onChange="GetCities()" id="countries"></select></div>
                <div class="sel"><select class="form-control" onChange="NewCities()" id="cities"><option value="0">Все курорты</option></select></div>
                <button type="button" class="btn btn-light" onclick='GetTours()' id="btn_search">Найти</button>
                <div class="form-check search_fly">
                            <input type="checkbox" class="form-check-input" id="flyCheck">
                            <label class="form-check-label" for="flyCheck">Перелет включен</label>
                    </div>
               
            </form>
        </div>
        
        
        <span id="actualize"></span>
        <div class="col-3"></div>
        <span class="grad"> 
        <img src="img/loading2.gif" id="loading" alt="loading">
            <div id="searchResult"></div>
        </span>
        
    </div>
</div>
</body>
</html>