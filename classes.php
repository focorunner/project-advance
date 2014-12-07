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
    public function __construct()
    {
        //echo 'Hello world ';
        //echo '<br />Shall we play a game?';
    }

    public function dbconnect()
    {
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

    // Method handles add/create actions, including create table, and add records to table
    // $action = the type of action being requested (add_rec or make_table)
    public function addCreate($db, $table = null, $action, $data = null)
    {
        //var_dump($data); echo $data; echo $table."<br>";
        if ($action === "add_rec" && ($data === null || is_array($data) === false || $table === null)) {
            ;
            return "Error in method call: to add single record to a table, the user data array and table are needed in the function call";
        } elseif ($action === "make_table" && $table === null) {
            return "Error in method call: to create a table, the table name is needed";
        } else {
            switch ($action) {
                case "add_rec":
                    $keys = array_keys($data);
                    $cols = implode(',', $keys);
                    $vals = "'" . implode("','", $data) . "'";
                    $sql = "INSERT INTO " . $table . " (" . $cols . ") VALUES (" . $vals . ")";
                    $msg = "Record";
                    break;
                case "make_table":
                    $sql = 'CREATE TABLE IF NOT EXISTS ' . $table . '(
                            id INT NOT NULL AUTO_INCREMENT,
                            name VARCHAR(200) NOT NULL,
                            age INT NOT NULL,
                            PRIMARY KEY(id)
                            )';
                    $msg = "Table";
                    break;
                default:
                    return "<strong>" . $action . "</strong> isn't a recognized add/create request type.";
            }
            //echo '<br />'.$sql.'<br />';  // echo the SQL query string
            if ($db->query($sql) === TRUE) {
                echo $msg . " exists";
            } else {
                echo "Error creating " . $msg . ": " . $db->error;
            }
        }
    }

    // Method handles select requests.
    // If $id is specified (single or comma-separated values), uses value/s provided to specify record/s to return
    // If $between is specified, splits comma-separated values and uses them to specify range in SQL sting
    // otherwise, returns all records in specified $table
    public function select($db, $table, $id = null, $between = null)
    {
        // Create database
        if ($between && $id) {
            return "Error in method call: both a single id and range of id's were specified.
                <br>If a single record was desired, the between range should not be included.
                <br>If a range was desired, the value passed for id should be null";
        } elseif ($between) {
            $range = explode(",", $id);
        }
        $sql = "SELECT * FROM " . $table . " " .
            (($id) ? "WHERE id IN (" . $id . ")" : "") .
            (($between) ? "WHERE id BETWEEN " . trim($range[0]) . " AND " . trim($range[1]) : "");
        //echo $sql.'<br />';  // echo the SQL query string
        if ($result = $db->query($sql)) {
            printf("Select returned %d rows.<br />", $result->num_rows);
            foreach($result as $record) {
                echo $record[id] . ': ' . $record[name] . ' is ' . $record[age] . ' years old.<br />';
            }
        } else {
            echo "Error creating record: " . $db->error;
        }
    }

    // Method handles delete/remove actions, including delete single record by id, delete all records, drop table
    // Valid actions include (rm_single, rm_all, rm_range, drop_table)
    public function remove($db, $table, $id = null)
    {
        if ($id === null) {
            $action = "drop_table";
        } elseif ($id === "all") {
            $action = "rm_all";
        } elseif (strpos($id, "-")) {
            $action = "rm_range";
            $range = explode("-", $id);
        }
        else {
            $action = "rm_by_id";
        }

        switch ($action) {
            case "rm_by_id":
                $sql = "DELETE FROM " . $table . " WHERE id IN (" . $id . ")";
                $msg = "Record";
                break;
            case "rm_all":
                $sql = "DELETE FROM " . $table;
                $msg = "All Records";
                break;
            case "rm_range":
                $sql = "DELETE FROM " . $table . " WHERE id BETWEEN " . trim($range[0]) . " AND " . trim($range[1]);
                $msg = "Selected Range";
                break;
            case "drop_table":
                $sql = "DROP TABLE IF EXISTS " . $table;
                $msg = "Table";
                break;
            default:
                return "<strong>" . $action . "</strong> isn't a recognized delete request type.";
        }
        //echo '<br />'.$sql.'<br />';  // echo the SQL query string
        if ($db->query($sql) === TRUE) {
            return $msg . " deleted successfully";
        }
        else {
            return "Error deleting " . $msg . ": " . $db->error;
        }
    }

    /*
        private function logError($err) {

        }
    */
}
?>