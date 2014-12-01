<?php
// Homepage placeholder.
// I'm just using this to run/test classes for now.
// Later build web-responsive homepage using bootstrap framework.

include('classes.php');

$obj = new database();

$db = $obj->dbconnect();

$obj->buildTable($db);

$data = array("name"=>"Kyle Reiners","age"=>2);

$obj->addRecord($db,$data);

$obj->selectAll($db);

echo "<br>".$obj->remove("rm_single",$db);
echo "<br>".$obj->remove("single",$db);
echo "<br>".$obj->remove("rm_single",$db,1);

$obj->selectAll($db);

echo "<br>".$obj->remove("rm_all",$db);

$obj->selectAll($db);

echo "<br>".$obj->remove("drop_table",$db);

$db->close();

?>