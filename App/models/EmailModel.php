<?php

namespace App\models;

class EmailModel{
    private $url;

    public function __construct($Ses)
    {
        $this->url = $Ses;

        
    }
    
}
?>