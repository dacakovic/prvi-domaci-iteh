<?php

require('./interfejsi/Ekonomija.php');

class Zaduzivanje implements Ekonomija
{
    private $konn;
    private $tabela = "zaduzivanje";

    public $id;
    public $opis;
    public $novac;
    public $studentId;

    public $datumZaduzivanja;

    public function __construct($konekcijaSaBazom)
    {
        $this->konn = $konekcijaSaBazom;
        $this->datumZaduzivanja =  time();
    }

    public function dodaj()
    {

        $sql = "INSERT INTO " . $this->tabela . " (novac_zaduzivanje, opis_zaduzivanje, timestamp_zaduzivanje, id_student)
        VALUES (" . $this->novac . ",  '" . $this->opis .  "',  $this->datumZaduzivanja   ,  $this->studentId)";

        if ($this->konn->query($sql) === TRUE)
            return true;

        return false;
    }
    public function prikazi()
    {
        $zaduzivanjeArray = [];

        $sql = "SELECT *
        FROM  " . $this->tabela . "
            WHERE id_student = " . $this->studentId;

        $result = $this->konn->query($sql);



        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['timestamp_zaduzivanje'] =  date("d.m.Y", intval($row['timestamp_zaduzivanje']));
                array_push($zaduzivanjeArray, $row);
            }
        }

        return $zaduzivanjeArray;
    }
}
