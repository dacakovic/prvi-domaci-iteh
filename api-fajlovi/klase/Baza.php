<?php

class Baza
{
    private $server = "localhost:3306";
    private $username = "root";
    private $password = "";
    private $baza = "ekonomijacasova";

    private $konn;


    public function __construct()
    {
        $this->konn = new mysqli($this->server, $this->username, $this->password, $this->baza);
    }

    public function getKonn()
    {

        return $this->konn;
    }
}

$baza = new Baza();
$konekcija = $baza->getKonn();
