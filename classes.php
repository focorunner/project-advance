<?php
// See comments above each class for latest updates on recent edits.
// Please make sure to update comments when you make edits.

Class UserAuth {
    

}


// Building a MySQLi class, to simplify back-end db stuff Feel free to edit.
// Goal 1: Make this work
// Goal 2: Make this robust to bad input
// Goal 3: Code efficiently - make it possible to do all similar actions with one function.
// Probable needs:  Function to handle bad input data (this can be done through Javascript valication at the view/form level)


Class database {
    // Placeholder constructor function
    public function __construct () {
        //echo 'Hello world ';
        //echo '<br />Shall we play a game?';
    }
    
    public function dbconnect () {
        $host = "localhost";
        $user = "";
        $pw = "";
        $dbname = "test";
        $port = "3306";

        $db = new mysqli($host,$user,$pw,$dbname,$port);

        if($db->connect_errno > 0){
            die ('Database Error' . $db->connect_error);
        } else {
            echo '<br />Connected...';
            return($db);
        }
    }
    
    public function buildTable ($db) {
        // Create database
        $sql = 'CREATE TABLE IF NOT EXISTS mytable
        (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(200) NOT NULL,
        age INT NOT NULL,
        PRIMARY KEY(id)
        )';
        if ($db->query($sql) === TRUE) {
            echo "<br />Table exists";
        } else {
            echo "Error creating table: " . $db->error;
        }

        //$db->close();
    }
    
    public function addRecord ($db,$data) {
        // Create database
        $keys = array_keys($data);
        $cols = implode(',', $keys);
        $vals = "'".implode("','", $data)."'";
        $sql = "INSERT INTO mytable (".$cols.") VALUES (".$vals.')';
        echo '<br />'.$sql.'<br />';
        if ($db->query($sql) === TRUE) {
            echo "Record Added";
        } else {
            echo "Error creating record: " . $db->error;
        }
        //$db->close();
    }

    public function selectAll ($db) {
        // Create database
        $sql = "SELECT * FROM mytable LIMIT 50";
        echo '<br />'.$sql.'<br />';
        if ($result = $db->query($sql)) {
            printf("Select returned %d rows.\n", $result->num_rows);
            foreach($result as $record) {
                //echo '<pre>';print_r($record); echo '<br />';
                echo '<br />'.$record[id].': '.$record[name].' is '.$record[age].' years old.';
            }
        } else {
            echo "Error creating record: " . $db->error;
        }
        //$db->close();
    }

/*
    public function removeByID ($db,$id) {
        $sql = "DELETE FROM mytable WHERE id = ".$id;
        echo '<br />'.$sql.'<br />';
        if ($db->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $db->error;
        }
        //$db->close();
    }

    public function removeAll ($db) {
        $sql = "DELETE FROM mytable ";
        echo '<br />'.$sql.'<br />';
        if ($db->query($sql) === TRUE) {
            echo "All records deleted successfully";
        } else {
            echo "Error deleting records " . $db->error;
        }
        //$db->close();
    }
    
    public function dropTable ($db) {
        $sql = 'DROP TABLE IF EXISTS mytable';
        echo '<br />'.$sql.'<br />';
        if ($db->query($sql) === TRUE) {
            echo "Table successfully dropped";
        }
        else {
            echo "Unable to drop table" . $db->error;
        }
    }
*/

    // $action = type of remove/delete action. Can be: "rm_single" "rm_all" "drop_table"
    // $db passes the database connection object
    // $id = optional parameter, default of null - if "rm_single" $action, $id is needed to specify record to delete
    public function remove($action, $db, $id = null) {
        if($action==="rm_single" && $id===null) {
            return "Error in method call: for single item deletions, the id # of the record is needed";
        }
        else {
            switch($action) {
                case "rm_single":
                    $sql = "DELETE FROM mytable WHERE id = ".$id;
                    $msg = "Record";
                    break;
                case "rm_all":
                    $sql = "DELETE FROM mytable ";
                    $msg = "All Records";
                    break;
                case "drop_table":
                    $sql = "DROP TABLE IF EXISTS mytable";
                    $msg = "Table";
                    break;
                default:
                    return "<strong>".$action."</strong> isn't a recognized delete request type.";
            }

            echo '<br />'.$sql.'<br />';
            if ($db->query($sql) === TRUE) {
                return $msg." deleted successfully";
            } else {
                return "Error deleting ".$msg.": " . $db->error;
            }
        }
    }
/*
    private function logError($err) {

    }
*/
}
?>