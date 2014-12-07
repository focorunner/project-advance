Some Classes to make some difficult work a little easier.

Class:  Database

Methods:

dbconnect()
    Parameters
        NONE
    Echos
        Success message
        Connection error.
    Returns
        Database connection object

addCreate($db, $table = null, $action, $data = null)
    Parameters
        $db:  REQUIRED(string), a database connection object
        $table:  REQUIRED(string), the name of the database table - depends on what tables your app uses
        $action:  REQUIRED(string), the type of add/create action requested
            valid strings: "add_rec", "make_table"
    Echos
        Success message - confirms what new item (table or record) exists
        SQL errors
    Returns
        Incorrect or missing parameter errors

select($db, $table, $id = null,$between = null)
    Parameters
        $db:  REQUIRED(string), a database connection object
        $table:  REQUIRED(string), the name of the database table - depends on what tables your app uses
        $id: a single or list of record id/s
            OPTIONAL(string or int) if all fields for all records are desired
            REQUIRED(string or int) for all other requests
                valid $id values: null, or any single integer equal to an existing record id
                valid $id strings: a comma separated lists of existing record id's
                    examples: 1, "1", "1,4,9,10,15" ...
        $between
            OPTIONAL(string), the upper and lower id's of a desired range
    Echos
        Success message - confirms what new item (table or record) exists
        SQL errors
    Returns
        Incorrect or missing parameter errors

remove($db, $table, $action, $id = null)
    Parameters
        $db:  REQUIRED(string), a database connection object
        $table:  REQUIRED(string), the name of the database table - depends on what tables your app uses
        $action:  REQUIRED(string), the type of delete/drop action requested
            valid strings: "rm_single", "rm_all", "drop_table"
        $id: a single or list of record id/s
            OPTIONAL(string or int) if all fields for all records are desired
            REQUIRED(string or int) for all other requests
                valid $id values: null, or any single integer equal to an existing record id
                valid $id strings: a comma separated lists of existing record id's
                    examples: 1, "1", "1,4,9,10,15" ...
        $between
            OPTIONAL(string), the upper and lower id's of a desired range
