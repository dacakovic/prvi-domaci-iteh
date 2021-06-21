<?php

class Student
{
    private $konn;
    private $tabela = "student";

    public $id;
    public $ime;
    public $indeks;

    public function __construct($konekcijaSaBazom)
    {
        $this->konn = $konekcijaSaBazom;
    }

    public function ucitaj()
    {

        $sql = "SELECT * FROM " . $this->tabela;

        $result = $this->konn->query($sql);

        $studentArray = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($studentArray, $row);
            }
        }

        return $studentArray;
    }
    public function deleteByID()
    {
        $sql = "DELETE FROM " . $this->tabela . " WHERE id_student =" . $this->id;

        if ($this->konn->query($sql) === TRUE) {
            return true;
        }

        return false;
    }
}
