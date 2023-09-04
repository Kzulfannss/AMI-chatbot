<?php

namespace App\ThirdParty\chatbot\chatbot\Humans;

require_once "Human.php";

class User extends Human
{
	public function __construct($chatbot, $unique)
    {	
        parent::__construct($chatbot, $unique, "user");
    }
}