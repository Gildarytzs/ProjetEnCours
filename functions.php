<?php

function dataSelect($select, $from, $where, $id, $method) {
	$bdd = connectBdd();
	$query = $bdd->prepare('SELECT '. $select .' FROM '. $from .' WHERE '. $where .' = :id');
	$query->execute(["id" => $id]);
	if ($method == 0) $resultat = $query->fetch();
	else $resultat = $query->fetchAll();
	return $resultat;
}

function dataSelectAll($select, $from) {
	$bdd = connectBdd();
	$query = $bdd->prepare('SELECT '. $select .' FROM '. $from);
	$query->execute();
	$resultat = $query->fetchAll();
	return $resultat;
}

function dataModify($from, $set, $where, $id, $message) {
	$bdd = connectBdd();
    $message = stripslashes(trim($message));
	$query = $bdd->prepare('UPDATE '. $from .' SET '. $set .' = :message WHERE '. $where .' = :id');
	$query->execute(["message" => $message, "id" => $id]);
}

function dataDelete($from, $where, $id) {
	$bdd = connectBdd();
	$query = $bdd->prepare('DELETE FROM '. $from .' WHERE '. $where .' = :id');
	$query->execute(["id" => $id]);
}

