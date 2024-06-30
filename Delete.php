<?php
include("DB_Connection.php");

//to use upcoming data first you have to convert it from "JSON String to PHP Array or PHP Object"

$data = stripslashes(file_get_contents("php://input"));   //this is use to read the data which is coming from the form

//ones the data is come then you have to convert it into PHP Array or PHP Object
$Con_data = json_decode($data, true);     //now it is PHP Object

$my_id = $Con_data['going_id'];  //it is come from delete department

if(!empty($my_id))
{
    $delete = "DELETE FROM crud WHERE id=$my_id";
    $q = mysqli_query($DB_connect, $delete);
    if($q==true)
    {
        echo"Recode Deleted Successfully";
    }
    else
    {
        echo"Record Not Delete";
    }
}


?>