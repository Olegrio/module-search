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
 if(isset($_POST['user'])) {
         $user = $_POST['user'];
        //   echo $requestId;
         }
 if(isset($_POST['email'])) {
         $email = $_POST['email'];
        //   echo $requestId;
         }
 if(isset($_POST['phone'])) {
         $phone = $_POST['phone'];
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

$paramsTourOrder = array(
	'sourceId' => $sourceId,
	'offerId'=> $offerId,
	'requestId'=> $requestId,
	'user'=>$user,
	'email'=>$email,
	'phone'=>$phone,
);


$SaveTourOrder =$soap -> getMethod('SaveTourOrder',$paramsTourOrder);
var_dump($SaveTourOrder);

echo '
<form>
    <div class="actualizePrice">
<p>Заявка отправлена</p>
      <button type="button" class="btn btn-light" onclick="closeCard()" id="btn_search">Закрыть</button>
     
    <div>
</form>
';