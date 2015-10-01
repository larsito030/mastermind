<?php

function get_grid_html() {
	$rows = isset($_POST['rows']) ? $_POST['rows']+1 : 9;
	for($i=0;$i<($rows-1);$i++){
		echo "<ul class=\"row bullets\">";
		for($a=0;$a<4;$a++){
			$out="";
			$out .= "<li>";
			$out .= "<span class=\"circular\"></span>";
			$out .= "</li>";
			echo $out;
		}
		echo "</ul>";
	}
}

function get_row_numbers() {
	$rows = isset($_POST['rows']) ? $_POST['rows']+1 : 9;
	for($i=1;$i<$rows;$i++){
		echo "<li class=\"numbers\">".$i."</li>";
	}
}

function get_hint_column() {
	$rows = isset($_POST['rows']) ? $_POST['rows']+1 : 9;
	for($i=1;$i<$rows;$i++){
		$out="";
		$out .= "<ul class=\"results\">";
		for($a=0;$a<4;$a++) {
			$out .= "<li class=\"sm_bullet\"></li>";
		}
		$out .= "</ul>";
		echo $out;
	}
}

function get_random_sample() {
	$raw = array('red','blue','green','yellow','purple');
	$rand = $raw;
	shuffle($rand);
	$rand = array_slice($rand,1);
	$_SESSION['random'] = $rand;

}
/*
$random_sample = function() {
	$raw = range(1,5);
	$rand = $raw;
	$rand = shuffle($raw);
	$rand = array_slice($rand,-1,1);
	echo $rand;
}*/