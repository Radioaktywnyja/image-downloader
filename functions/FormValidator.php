<?php

class FormValidator {
    
    protected $input;

    //zabezpieczenie przed wstrzyknięciem niechcianego kodu
    protected function setSafeInput($data) {
        $this->input = trim($data);
        $this->input = stripslashes($this->input);
        $this->input = htmlspecialchars($this->input);
        return $this->input;
    } 
}
