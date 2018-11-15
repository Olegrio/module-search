<?
 if(isset($_POST['sourceId'])) {
         $sourceId = $_POST['sourceId'];
        //   echo $sourceId;
         }
 if(isset($_POST['offerId'])) {
         $offerId = $_POST['offerId'];
        //   echo  $offerId;
         }
 if(isset($_POST['requestId'])) {
         $requestId = $_POST['requestId'];
        //   echo $requestId;
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

$paramsActualize = array(
	'sourceId' => $sourceId,
	'offerId'=> $offerId,
	'requestId'=> $requestId,
);


$ActualizePrice =$soap -> getMethod('ActualizePrice',$paramsActualize);

echo '
<form>
    <div class="actualizePrice">
   
     <p>CountryName'.$ActualizePrice["ActualizePriceResult"]["TourInfo"]["CountryName"].'</p>
     <p>CityFromName'.$ActualizePrice["ActualizePriceResult"]["TourInfo"]["CityFromName"].'</p>
     <p>ResortName'.$ActualizePrice["ActualizePriceResult"]["TourInfo"]["ResortName"].'</p>
     <p>CheckIn'.$ActualizePrice["ActualizePriceResult"]["TourInfo"]["CheckIn"].'</p>
     <p>CheckOut'.$ActualizePrice["ActualizePriceResult"]["TourInfo"]["CheckOut"].'</p>
     <p>Nights'.$ActualizePrice["ActualizePriceResult"]["TourInfo"]["Nights"].'</p>
     <p>OfferId'.$ActualizePrice["ActualizePriceResult"]["TourInfo"]["OfferId"].'</p>
     <p id="offeridCard">'.$offerId.'</p>
     <p id="requestidCard">'.$requestId.'</p>
     <p id="sourceidCard">'.$sourceId.'</p>
      <button type="button" class="btn btn-light" onclick="closeCard()" id="btn_search">Закрыть</button>
     <h3>Оставьте заявку и мы с Вами свяжемся</h3>
     <form>
         <p>Имя</p><textarea rows="1" cols="45" name="text" id="user1" ></textarea>
         <p>Контактный e-mail</p><textarea rows="1" cols="45" name="text" id="email"></textarea>
         <p>Контактный телефон</p><textarea rows="1" cols="45" name="text" id="phone"></textarea>
         <button type="button" class="btn btn-light" onclick="SaveTourOrder()" id="btn_search">Отправить заявку</button>
     </form>
    <div>

';