<?php
require('./klase/Baza.php');
require('./klase/Zaduzivanje.php');

$zaduzivanje = new Zaduzivanje($konekcija);
$zaduzivanje->novac =  $_POST['novac_zaduzivanje'];
$zaduzivanje->opis = strval($_POST['opis_zaduzivanje']);
$zaduzivanje->studentId = $_POST['id_student'];

if ($zaduzivanje->dodaj()) {
    echo "Zaduzivanje uspesno dodato!";
} else
    echo "Zaduzivanje nije uspesno dodato!";
$konekcija->close();
