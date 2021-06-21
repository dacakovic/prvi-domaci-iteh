
<?php


require('./klase/Baza.php');
require('./klase/Student.php');

$student = new Student($konekcija);

echo json_encode($student->ucitaj());




$konekcija->close();
