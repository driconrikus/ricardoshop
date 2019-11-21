<?php

class session
{

    private $session = NULL;
    
    public function __construct($session_name)
    {
        session_start();

        if(!isset($_SESSION[$session_name]))
        {
            $_SESSION[$session_name] = NULL;
    
           // echo "Session $session_name created";
        }
       // echo "Session $session_name already exists";
        
        $this->session = $session_name;
    }

    public function setValue($value)
    {
        $_SESSION[$this->session] = $value;
    }

    public function getValue()
    {
        return $_SESSION[$this->session];
    }
}

?>

