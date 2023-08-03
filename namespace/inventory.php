<?php

namespace inventory; /////name space////

session_start(); //////session*///////
require 'C:\xampp\htdocs\CRUDEFUNCTIONPHP\connection.php'; /////////connection to database//////////
//////////////////login////////////////////
/**
 *this class is encapsulated it will retrive data from employees and admin table'
 * 
 * @param    $tablename,emailid,password.
 * @return   mixed result.
 *
 */
class login1
{
    /////////////////class function/////////
    private $tableName;
    private $userid;
    private $password;
    ///////////////constructor///////////
    function __construct($tableName, $userid, $password)
    {
        $this->tableName = $tableName;
        $this->userid = $userid;
        $this->password = $password;
    }
    private function commonquery()
    {
        ////////this function return data of single employee//////////
        $tableName = $this->tableName;
        $userid = $this->userid;
        global $connection;
        $stmt = mysqli_prepare($connection, "SELECT * FROM $tableName WHERE emailid = ?");
        mysqli_stmt_bind_param($stmt, 's', $userid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    private function loginOfPrivate($row)
    {
        ////////////this function return boolean value and redirects if password matches////////
        $tableName = $this->tableName;
        $password = $this->password;
        if ($row !== null) {
            $hashedPassword = $row['password'];
            if ($tableName == 'admin' && password_verify($password, $hashedPassword) && $row['branch'] == 3) {
                header("Location: adminAddEmp.php");
                $_SESSION['employee'] = array(
                    'id' => $row['id'],
                    'emailid' => $row['emailid'],
                    'branch' => $row['branch'],
                );
                exit();
            } elseif ($tableName == 'employees' && password_verify($password, $hashedPassword) && $row['branch'] == 1) {
                header("Location: employees.php");
                $_SESSION['employee'] = array(
                    'id' => $row['id'],
                    'emailid' => $row['emailid'],
                    'branch' => $row['branch'],
                );
                return $row;
            } elseif ($tableName == 'employees' && password_verify($password, $hashedPassword) && $row['branch'] == 2) {
                header("Location: hr.php");
                $_SESSION['employee'] = array(
                    'id' => $row['id'],
                    'emailid' => $row['emailid'],
                    'branch' => $row['branch'],
                );
                print_r($row);
                return $row;
            }
        }
        return $x = 'incorrect user id or password';
    }
    //////////////public calling functions to achieve encapsulation//////////////
    public function loginOf()
    {
        $row = $this->commonquery();
        $x = $this->loginOfPrivate($row);
        return $x;
    }
    public function fetchDetails()
    {
        return $this->commonquery();
    }
}
/**
 *this class is returns values and creaste a table'
 * 
 * @param    ...spred operator-->$obj
 * @return   mixed result.
 *
 */
class retrieveData
{
    //function retrive data based on your 
    //input you can pass n number of parameters 
    /////////but first argument should tablename
    function retrieveData(...$obj)
    {
        global $connection;
        $query = 'SELECT ';

        for ($x = 1; $x < count($obj); $x++) {
            $column = $obj[$x];
            $query .= $column . ', ';
        }
        $query = rtrim($query, ', '); // Remove the trailing comma and space
        $query .= ' FROM ' . $obj[0];

        $result = mysqli_query($connection, $query);
        return $result;
    }
    //////////////////////////////////tavble delete////////////////////////////////////
    /**
     *this table returns table '
     * 
     * @param   @query result of any query.
     * @param $columname $name
     * @param $coldata $data
     * @param $pagename.php $getglobal
     * @return   $none.
     *
     */
    function tableDelete1($result, $columName, $coldata, $pageName, $colhref)
    {
        global $connection;
        $keys = array();
        if ($result) {
            // Create the table to display the data
            echo '<table class="table table-hover">';
            // Create the table header row
            echo '<tr class="table-dark">';

            // Check if there is at least one row in the result
            if ($row1 = mysqli_fetch_assoc($result)) {
                $keys = array_keys($row1);
                foreach ($keys as $k) {
                    echo "<th>" . $k . "</th>";
                }
                echo "<th>$columName</th>";
                echo "</tr>";

                // Output the first row of data
                echo '<tr>';
                foreach ($row1 as $value) {
                    echo '<td>' . $value . '</td>';
                }
                $rowId = $row1["$colhref"];
                echo "<td><a href='$pageName?id=$rowId' onclick='showAlert(event)'>$coldata  </a></td>";
                echo '</tr>';
            }
            // Process the rest of the retrieved data
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                foreach ($row as $value) {
                    echo '<td>' . $value . '</td>';
                }
                $rowId = $row["$colhref"];
                echo "<td><a href='$pageName?id=$rowId' onclick='showAlert(event)'>$coldata</a></td>";
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "Error retrieving data: " . mysqli_error($connection);
        }
    }
}
/**
 *this class updates table'
 * 
 * @param    $tablename.
 * @param $coltoupdate $nameofcol
 * @param $valueofcol $value
 * @param $wherecondition key $key
 * @param $conditionvalue $conditionvalue
 * @return   mixed result.
 *
 */
class update
{
    function updateTable($tableName, $column, $value, $conditionColumn, $conditionValue)
    {
        global $connection;
        // Escape the values to prevent SQL injection
        $column = mysqli_real_escape_string($connection, $column);
        $value = mysqli_real_escape_string($connection, $value);
        $conditionColumn = mysqli_real_escape_string($connection, $conditionColumn);
        $conditionValue = mysqli_real_escape_string($connection, $conditionValue);
        // Construct the update query
        $query = "UPDATE $tableName SET $column = '$value' WHERE $conditionColumn = '$conditionValue'";
        // Execute the query
        $result = mysqli_query($connection, $query);
        return $result;
    }
}
/**
 *this class is delets table'
 * 
 * @param    $tablename,conditionkey,value.
 * @return   mixed result.
 *
 */
class deleteRow
{
    function deleteFromTable($tableName, $conditionColumn, $conditionValue)
    {
        global $connection;

        // Escape the values to prevent SQL injection
        $tableName = mysqli_real_escape_string($connection, $tableName);
        $conditionColumn = mysqli_real_escape_string($connection, $conditionColumn);
        $conditionValue = mysqli_real_escape_string($connection, $conditionValue);
        // Construct the delete query
        $query = "DELETE FROM $tableName WHERE $conditionColumn = '$conditionValue'";
        // Execute the query
        $result = mysqli_query($connection, $query);
        return $result;
    }
}
class insert
{
    /**
     * it will insert the date into table name.
     * 
     * @param    object  $object()
     * @return   mixed result.
     *
     */
    public function insertInto(...$obj)
    {
        global $connection;
        $tableName = $obj[0];
        $columns = [];
        $values = [];
        for ($x = 1; $x < count($obj); $x++) {
            if ($x <= count($obj) / 2) {
                $columns[] = mysqli_real_escape_string($connection, $obj[$x]);
            } else {
                // Check if the current value is for the image column
                if ($columns[$x - count($obj) / 2 - 1] === 'image') {
                    // Read the image file and convert it to binary data
                    $imageData = file_get_contents($obj[$x]);
                    $encodedImageData = base64_encode($imageData);
                    $values[] = "'" . mysqli_real_escape_string($connection, $encodedImageData) . "'";
                } else {
                    $values[] = "'" . mysqli_real_escape_string($connection, $obj[$x]) . "'";
                }
            }
        }
        $columnString = implode(", ", $columns);
        $valueString = implode(", ", $values);
        $query = "INSERT INTO $tableName ($columnString) VALUES ($valueString)";
        $result = mysqli_query($connection, $query);
        return $result;
    }
}
///////////////////////hr pop notifications//////////////////
/**
 *this class display popups in hr GUI'
 * 
 * @param    $no.
 * @return   $number result.
 *
 */
class inventoryLoss
{
    /////////these function for the popup messeeege///////
    function  popuopnotifications()
    {
        global $connection;
        $query1 = "SELECT * FROM inventory WHERE remark IS NOT NULL";
        $result1 = mysqli_query($connection, $query1);
        $res1 = mysqli_num_rows($result1);
        /////////////////////////
        $query2 = "SELECT * FROM inventory WHERE remark IS NULL AND assignedDate <= DATE_SUB(CURDATE(), INTERVAL 3 DAY)";
        $result1 = mysqli_query($connection, $query1);
        $result2 = mysqli_query($connection, $query2);
        $res1 = mysqli_num_rows($result1);
        $res2 = mysqli_num_rows($result2);
        return [$res1, $res2];
    }
}
//////////////////////add img fun///////////////////////////
///////////////////////////////////

function addImg($image, $id)
{ /////////////fix and add filid///////////???????argument
    global $connection;
    $stmt = "C:\Users\siddu\Downloads/";
    $path = $stmt . $image;
    $updatedFileContents = file_get_contents("$path");
    $stmt = mysqli_prepare($connection, "UPDATE employees SET image = ? WHERE id = ?");
    $fileID = $id;
    mysqli_stmt_bind_param($stmt, 'si', $updatedFileContents, $fileID);
    $res = mysqli_stmt_execute($stmt);
    return $res;
}
////////////////////////////////
/////////////////admin notification///////////////////////
function admin()
{
    global $connection;
    $query = "SELECT * FROM notifications ";
    $result = mysqli_query($connection, $query);
    $res = mysqli_num_rows($result);
    return $res; //return number retrived lines
}
///////////////////////common retrive////////////
function commonretrive($tableName, $key, $value)
{
    global $connection;
    $query = "SELECT * FROM $tableName WHERE $key=$value";
    $result = mysqli_query($connection, $query);
    return $result; //returns results
}
function commonquery($tablename)
{
    global $connection;
    $query = "SELECT * FROM $tablename";
    $result = mysqli_query($connection, $query);
    return $result; //return results
}
