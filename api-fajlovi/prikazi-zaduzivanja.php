<?php

require('./klase/Baza.php');
require('./klase/Zaduzivanje.php');

$zaduzivanje = new Zaduzivanje($konekcija);
$zaduzivanje->studentId = intval($_GET['id_student']);


echo json_encode($zaduzivanje->prikazi());



$konekcija->close();
