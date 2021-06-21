<?php

require('./interfejsi/Ekonomija.php');

class Placanje implements Ekonomija
{
    private $konn;
    private $tabela = "placanje";

    public $id;
    public $opis;
    public $novac;
    public $studentId;

    public function __construct($konekcijaSaBazom)
    {
        $this->konn = $konekcijaSaBazom;
    }

    public function dodaj()
    {

        $sql = "INSERT INTO " . $this->tabela . " (novac_placanje, opis_placanje, id_student)
        VALUES ($this->novac,  '" . $this->opis .  "', $this->studentId)";

        if ($this->konn->query($sql) === TRUE)
            return true;

        return false;
    }
    public function prikazi()
    {
        $placanjeArray = [];

        $sql = "SELECT *
        FROM  " . $this->tabela . "
            WHERE id_student = $this->studentId;
            ";

        $result = $this->konn->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($placanjeArray, $row);
            }
        }

        return $placanjeArray;
    }
}
