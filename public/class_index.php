<?php

	include('class_lib.php');

	$person1 = new person();
	$person2 = new person();

	$person1->setName("Stefan");
	$person2->SetName("Nick");

	print ($person1->getName() . "<br>");
	print ($person2->getName() . "<br>");
?>
