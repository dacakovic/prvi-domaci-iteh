<?php

require('./klase/Baza.php');
require('./klase/Student.php');

$student = new Student($konekcija);


$student->id = $_POST['id_student'];

$student->deleteByID();

$konekcija->close();
