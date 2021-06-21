<?php

require('./klase/Baza.php');
require('./klase/Placanje.php');

$placanje = new Placanje($konekcija);
$placanje->studentId = intval($_GET['id_student']);


echo json_encode($placanje->prikazi());



$konekcija->close();
