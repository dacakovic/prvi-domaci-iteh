<?php

require('./klase/Baza.php');
require('./klase/Placanje.php');

$placanje = new Placanje($konekcija);
$placanje->novac =  $_POST['novac_placanje'];
$placanje->opis = strval($_POST['opis_placanje']);
$placanje->studentId = $_POST['id_student'];

if ($placanje->dodaj()) {
    echo "Placanje uspesno dodato!";
} else
    echo "Placanje nije uspesno dodato!";
$konekcija->close();
