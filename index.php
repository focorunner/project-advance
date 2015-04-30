<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
// Homepage placeholder.
// I'm just using this to run/test classes for now.
// Later build web-responsive homepage using bootstrap framework.

include('classes.php');

$obj = new database();

$db = $obj->dbconnect();

//$obj->buildTable($db);
echo "<br>" . $obj->addCreate($db, "mytable", "make_table");
$data = array("name"=>"Kyle Reiners","age"=>2);

echo "<h4 style='margin: 0;padding: 0'>Response to Add Records</h4>";
//$obj->addRecord($db,$data);
//echo $obj->add($db,"mytable","add_rec");
//$test = ""; echo $obj->add($db,"mytable","add_rec",$test);
echo "<br />" . $obj->addCreate($db, "mytable", "add_rec", $data);
echo "<br />" . $obj->addCreate($db, "mytable", "add_rec", $data);
echo "<br />" . $obj->addCreate($db, "mytable", "add_rec", $data);
echo "<br />" . $obj->addCreate($db, "mytable", "add_rec", $data);
echo "<br />" . $obj->addCreate($db, "mytable", "add_rec", $data);

echo "<h4 style='margin: 0;padding: 0'>Response to Select all records</h4>";
echo $obj->select($db, "mytable");
echo "<h4 style='margin: 0;padding: 0'>Response to Select record (id = 1)</h4>";
echo $obj->select($db, "mytable", 1);

echo "<h4 style='margin: 0;padding: 0'>Response to remove single record request (id = 1)</h4>";
// expect error response indicating record ID is needed
//echo "<br>".$obj->remove($db,"mytable","rm_single");  // test of missing record id error
// expect error response indicating that action requested isn't correct
//echo "<br>".$obj->remove($db,"mytable","single");  // test of unrecognized action requested
echo $obj->remove($db, "mytable", 4);

echo "<h4 style='margin: 0;padding: 0'>Response to Select all records</h4>";
$obj->select($db, "mytable");

echo "<h4 style='margin: 0;padding: 0'>Response to remove range of records request (id = 1-3)</h4>";
echo $obj->remove($db, "mytable", "1-3");
echo "<br />";

echo "<h4 style='margin: 0;padding: 0'>Response to Select all records</h4>";
$obj->select($db, "mytable");

echo "<h4 style='margin: 0;padding: 0'>Response to Delete all records</h4>";
echo $obj->remove($db, "mytable", "all");

echo "<h4 style='margin: 0;padding: 0'>Response to Select all records</h4>";
$obj->select($db, "mytable");

echo "<h4 style='margin: 0;padding: 0'>Response to Delete Table</h4>";
echo $obj->remove($db, "mytable");

$db->close();

?>