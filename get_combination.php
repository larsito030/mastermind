<?php 

$raw = array('red','blue','green','yellow','purple');
	$rand = $raw;
	shuffle($rand);
	$rand = array_slice($rand,1);
	$_SESSION['random'] = $rand;