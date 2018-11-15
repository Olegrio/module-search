<?php
if(isset($_POST['flyCheck'])) {
        $fly = $_POST['flyCheck'];
           
        }

if(isset($_POST['city'])) {
        $city = $_POST['city'];
            // echo ('data: '.$_POST['city'].'<br>');
        }


if(isset($_POST['count'])) {
        $countryId = $_POST['count'];
            // echo ('countryId: '.$_POST['datas'].'<br>');
        }


if(isset($_POST['cities'])) {
        $citiesId = array($_POST['cities']);
            // echo ('cities: '.$_POST['citiesNew'].'<br>');
        }


class moduleSOAP
{
    private $WSDL = 'https://module.sletat.ru/XmlGate.svc?singleWSDL';
    private $login = 'fol@sletat.ru';
    private $pass = '27863140';
    public $client = false;

    public function __construct()
    {
    }

    /**
     * Вызов метода SOAP-сервиса
     * @param string $methodName - название метода сервиса
     * @param array $param - набор параметров ключ -> значение
     * @return array
     */
    public function getMethod($methodName, $param = array())
    {
        if(!is_object($this->client))
        {
            $this->client = new SoapClient($this->WSDL, array("trace" => TRUE));
            $header = new SoapHeader("urn:SletatRu:DataTypes:AuthData:v1", "AuthInfo", array("Login"=>$this->login, 'Password'=>$this->pass));
            $this->client->__setSoapHeaders($header);
        }

        if(	!is_object($this->client) ) echo 'soap';

        try{
            $result = $this->client->$methodName($param);
        }catch(Exception $e){
            $result = $this->client.Close();
            return $e;
        }

        if (!is_soap_fault($result)) return $this->objectToArr($result);
        else return false;
         if (!is_soap_fault($getRequestResult)) return $this->objectToArr($getRequestResult);
        else return false;
        
    }
    

    /**
     * Преобразует объект в массив
     * @param object|array $obj - объект или массив
     * @return array - массив
     */
    private function objectToArr($obj)
    {
        $tmp = array();
        foreach ($obj as $key => $value)
            if (!is_array($value) && !is_object($value))
            {
                if (is_bool($value))
                    $tmp[(string)$key]  = $value?1:0;				// можно заменить на true и false
                else
                    $tmp[(string)$key] = (string)$value;
            }
            else
                $tmp[(string)$key] = $this->objectToArr($value);
        return $tmp;
    }
}

$soap = new moduleSOAP;

$params["townFromId"] = 832;



$paramsTwo = array(
		'countryId' =>$countryId, 
		'cityFromId' => $city, 
		'cities' => $citiesId, 
		'meals' => null, 
		'stars' => null, 
		'hotels' => null,
		'adults' => 2,
		'kids' => 0,
		'kidsAges' => null,
		'nightsMin' => 7,
		'nightsMax' => 7,
		'priceMin' => null,
		'priceMax' => null,
		'currencyAlias' => 'RUB',
		'departFrom' => null,
		'departTo' => null,
		'hotelIsNotInStop' => false,
		'hasTickets' => false,
		'ticketsIncluded' => $fly,
		'useFilter' => false,
		'f_to_id' => null,
		'includeDescriptions' => true,
		'cacheMode' => 0
	);



$result = $soap->getMethod("GetCountries", $params);        
$requestId = $soap->getMethod("CreateRequest", $paramsTwo);

sleep(1);

$tst["requestId"] = $requestId["CreateRequestResult"];

$getRequestResult = $soap->getMethod("GetRequestResult",$tst);






$lng= $getRequestResult["GetRequestResultResult"]["RowsCount"];
// print_r("Rows lng: ". $lng);
if($lng>0){
  $colTour =  $lng; //
    } else {
        
   $colTour = -1; 
   echo'
   <div class="row h-50">
        <div class="col-2"></div>
        <div class="col-8 tourCard">
            <div class="TourCrad__img" style="background-image: url(img/cat.png)" class="imgTour"></div>
                <div><ul class="tourData">
                <li>Туров нет</li>
                <li>Попробуйте выполнить поиск по другим параметрам</li>
                
            </ul>
            </div>
                
            </div>
        </div>
        <div class="col-2"></div>
</div>
 <style>.topCard{
     display:none
 } </style>
   ';
    }
    echo'
   <div class="row">
        <div class="col-2"></div>
        <div class="col-8 topCard" id="found">Tours found: '.$lng .'</div>
        <div class="col-2"></div>
   </div>
   
   ';

for ($i = 0; $i <= $colTour-1; $i++) {
$randPhotoNumber = rand(1,$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]['HotelPhotosCount'] );
$urlHotelPhoto = 'https://hotels.sletat.ru/i/im/'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]['HotelId'].'_'. $randPhotoNumber .'_300_130_1.jpg';

$handle = curl_init($urlHotelPhoto);

curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($handle);

$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE); 
if($httpCode == 404) {
    
    $urlHotelPhoto = 'img/hotel.jpg';
} 
 curl_close($handle);




$colPage = $i/10 + 1;

$z = "$colPage";
$numPage= split("[.]",$z);

if ($i<=9){
    
    $display = 'style="display:flex"';
    
} else {
    
     $display = 'style="display:none"';
}

echo '

<div class="row  page'.$numPage[0] .'"   '.$display .'>
        <div class="col-2 "></div>
        <div class="col-8 tourCard" data-num='.$i. '>
            <div class="TourCrad__img" id ="tour'.$i.'" imgUrl="url('.$urlHotelPhoto.'"alt="hotel_photo'. $getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["HotelId"] .')" class="imgTour"></div>
            <div><ul class="tourData">
                <li><p class="tourData_hotelName">'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]['HotelName'].' <span class="tourData_hotelStars">'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]['StarName'][0] .'<i class="fas fa-star"></i><span></p></li>
                <li>'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["OfferId"] .'</li>
                <li>'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["CheckInDate"] .'</li>
                <li>'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["MealName"].'</li>
                <li><a href="'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["HotelDescriptionUrl"].'" class="tourData_lookHotel"><i class="fas fa-home"></i></a></li>
                
            </ul>
            <div class="tourCard_right">
                <h2>'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["Price"].'</h2><p>руб.</p>
                <button type="button" onclick="actualizePrice(this)" class="look btn btn-light"
                    sourceId="'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["SourceId"].'" 
                    offerId="'.$getRequestResult["GetRequestResultResult"]["Rows"]["XmlTourRecord"][$i]["OfferId"].'"
                    requestId="'.$getRequestResult["GetRequestResultResult"]["RequestId"].'" >
                Подробнее &nbsp&nbsp<i class="fas fa-chevron-right"></i></button></div>
            </div>
        </div>
        <div class="col-2"></div>
</div>



 
';


};

  echo'
   <div class="row" id="addTours">
        <div class="col-2"></div>
        <div class="col-8 addResult"><button type="button" onclick="addTours()" class="paginator btn btn-light">Показать еще</button></div>
        <div class="col-2"></div>
   </div>
   
   
   
<div class="row footer">
    
        <div class="col-2"></div>
        <div class="col-8"><p style="color:white; margin-top:5%;text-align:center">v.1/2018 <br> http://metal-proc.ru/<p/></div>
        <div class="col-2"></div>
    
</div>
   
   ';


  

// <button type="button" onclick="arrResult()" class="btn btn-light">Показать еще</button>

   