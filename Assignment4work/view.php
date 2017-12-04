<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 11/1/2017
 * Time: 1:55 PM
 */
include_once ("assets/header.html");
include_once ("assets/dbconn.php");
require_once ("assets/functionsToGetStuffDone.php");

$db = dbconn();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$col = filter_input(INPUT_GET, 'col', FILTER_SANITIZE_STRING) ?? NULL;
$dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? NULL;

switch ($action) {
    case 'sort':
        $sortable = true;
        $corps = getCorpsAsSortedTable($db, $col, $dir);
        $cols = getColumnNames($db, 'corps');
        echo getCorpsAsSortedTable($db, $corps, $col);
        break;
    case 'Read':

        // pass the db and the id to getEmployeeDisplay (which in turns gets the employee first) and echo results
        break;
    case 'New':

        // initialize button to Save
        // initialize an employee array and set each field to a blank form value
        $depts = getDepts($db);
        echo employeeForm($depts);
        break;
    case 'Save':
        // pass the data to newEmployee()
        // initialize button to Save
        // initialize an employee array and set each field to a blank form value
        // pass both to employeeForm()
        break;
    case 'Edit':
        // getEmployee()
        // initialize button to Update
        // pass both to employeeForm()
        break;
    case 'Update':
        // pass the data to updateEmployee()
        // getEmployee()
        // initialize button to Update
        // pass both to employeeForm()
        break;
    case 'Delete':
        // deleteEmployee()
        break;
    default:
        $sortable = true;
        $corps = getCorps($db);
        $cols = getColumnNames($db, 'corps');
        echo getCorpsAsTable($db, $corps, $cols, $sortable);
        break;

}





include_once ("assets/footer.php");
?>