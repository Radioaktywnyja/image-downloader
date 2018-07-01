<?php
require_once ('functions/FormValidator.php');

class imageFormValidator extends FormValidator {
   
    protected $url;
    
    protected $real_url;
    
    //zabezpieczenie i pobranie adresu url z formularza
    public function __construct() {
        $this->url = $this->setSafeInput($_POST['url']);
    }
    
    //sprawdzenie czy url jest z www czy bez
    protected function setRealURL() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_exec($ch);
        $this->real_url =  curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
    }
    
    //sprawdzenie czy strona do której odnosi się URL istnieje
    protected function existURL() {
        $curl = curl_init($this->real_url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        $result = curl_exec($curl);
        if ($result !== false)
        {
          $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
          if ($statusCode == 404)
          {
            return false;
          }
          else
          {
             return true;
          }
        }
        else
        {
          return false;
        }
    }
    
    //sprawdzenie czy wpisano poprawny adres url
    public function testURL() {
        if (filter_var($this->url, FILTER_VALIDATE_URL)) {
            $this->setRealURL();
            if($this->existURL() === true) {
                return $this->real_url;
            } else {
                echo '<div class="alert alert-danger">Strona o podanym adresie "'.$this->real_url.'" nie istnieje!</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Wpisz poprawny adres strony zaczynając od "http://" lub "https://"</div>'; 
        }
    }
}
