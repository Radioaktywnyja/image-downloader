<?php
require_once ('functions/FormValidator.php');

class contactFormValidator extends FormValidator {
    
    protected $name;
    
    protected $email;
    
    protected $phone;
    
    protected $date;
    
    protected $msg;
    
    protected $is_valid;
    
    protected $name_err = null;
    
    protected $email_err = null;
    
    protected $phone_err = null;
    
    protected $date_err = null;
    

    //zabezpieczenie i pobranie danych z formularza
    public function __construct() {
        if (isset($_POST['submit'])) {
            $this->name = $this->setSafeInput($_POST['name']);
            $this->email = $this->setSafeInput($_POST['email']);
            $this->phone = $this->setSafeInput($_POST['phone']);
            $this->date = $this->setSafeInput($_POST['date']);
            $this->msg = $this->setSafeInput($_POST['msg']);
            $this->validateForm();
        }
    }
    
    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getDate() {
        return $this->date;
    }

    public function getMsg() {
        return $this->msg;
    }

    public function getIs_valid() {
        return $this->is_valid;
    }

    public function getName_err() {
        return $this->name_err;
    }

    public function getEmail_err() {
        return $this->email_err;
    }

    public function getPhone_err() {
        return $this->phone_err;
    }

    public function getDate_err() {
        return $this->date_err;
    }
    
    //sprawdzenie czy wpisano imie i nazwisko
    protected function testName() {
        if(preg_match('/^[A-ZŁŚŻŹĆ]{1}[a-ząęółśżźćń]+[ ]{1}[A-ZŁŚŻŹĆ]{1}[a-ząęółśżźćń-]+$/',$this->name)){
            return true;
        } else {
            $this->name_err = 'Wymagany format: "Imię Nazwisko"';
            return false;
        }
    }
    
    protected function testEmail() {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->email_err = 'Niepoprawny adres email';
            return false;
        }
    }
    
    protected function testPhone() {
        if (preg_match('/^[0-9 ]+$/',$this->phone)) {
            return true;
        } else {
            $this->phone_err = 'Wymagany format "123456789"';
            return false;
        }
    }
    
    protected function testDate() {
        $test_arr  = explode('-', $this->date);
        if (checkdate($test_arr[1], $test_arr[0], $test_arr[2])) {
            return true;
        } else {
            $this->date_err = 'Niepoprawna data';
            return false;
        }
    }
    
    public function validateForm() {
        $this->testName();
        $this->testEmail();
        $this->testPhone();
        $this->testDate();
        
        if($this->name_err != null || $this->email_err != null || $this->phone_err != null || $this->date_err != null) {
            $this->is_valid = false;
        } else {
            $this->is_valid = true;
        }
    }
    
    public function getForm() {
        echo '<div class="alert alert-success">Formularz wypełniony poprawnie</div>';
        echo '<h3>Podane informacje:</h3>';
        echo '<dl>';
        echo '<dt>Imię i nazwisko: </dt><dd>'.$this->name.'</dd>';
        echo '<dt>E-mail: </dt><dd>'.$this->email.'</dd>';
        echo '<dt>Nr telefonu: </dt><dd>'.$this->phone.'</dd>';
        echo '<dt>Data spotkania: </dt><dd>'.$this->date.'</dd>';
        echo '<dt>Treść wiadomości: </dt><dd>'.$this->msg.'</dd>';
        echo '</dl>';
    }
  
}
