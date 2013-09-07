<?php

class BCFG
{
  // Config - Bevster 2013
    private $BEA_HOST;
    private $BEA_DATABASE;
    private $BEA_USERNAME;
    private $BEA_PASSWORD; 

	//Database
  function __construct()
  {
     $this->BEA_HOST = 'localhost';
     $this->BEA_DATABASE = 'db';
     $this->BEA_USERNAME = 'username';
     $this->BEA_PASSWORD = 'passworddinhex';

  }

//Getters
public function getHost()
{
  return $this->BEA_HOST;
}

public function getDatabase()
{
  return $this->BEA_DATABASE;
}

public function getUsername()
{
  return $this->BEA_USERNAME;
}

public function getPassword()
{
  return trim($this->hexToStr($this->BEA_PASSWORD));
}



//Simpel kryptering for skulderblikk
private function hexToStr($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2)
    {
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

}