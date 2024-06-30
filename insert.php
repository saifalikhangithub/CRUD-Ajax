<?php
include("DB_Connection.php");

//to use upcoming data first you have to convert it from "JSON String to PHP Array or PHP Object"

$data = stripslashes(file_get_contents("php://input"));   //this is use to read the data which is coming from the form

//ones the data is come then you have to convert it into PHP Array or PHP Object
$Con_data = json_decode($data, true);     //now it is PHP Object

//now you can access your data
$id = $Con_data['going_id'];
$name = $Con_data['name'];
$email = $Con_data['email'];
$number = $Con_data['number'];

//-----------------------------------------------------------------------------------------------------------------------------

// //Only Insert

// //now you can insert your data into database
// if(!empty($name) && !empty($email) && !empty($number))
// {
//     $insert = "INSERT INTO crud(name, email, number) values('$name', '$email', '$number')";
//     $q = mysqli_query($DB_connect, $insert);
//     if($q==true)
//     {
//         echo"Recode Added Successfully";        //It Will Go To Ajax Response Handling Code
//     }
//     else
//     {
//         echo"Sorry";
//     }
// }
// else
// {
//     echo"Fill All Fields";
// }


//-----------------------------------------------------------------------------------------------------------------------------

//Insert As Well As Update

//if the data is already exist than update it. if data is not exist in that case Insert it based in ID
//if ID already exist than it will update  and  if ID is not exist in that case it will Insert new Record

if(!empty($name) && !empty($email) && !empty($number))
{
    $insert = "INSERT INTO crud(id, name, email, number) values('$id', '$name', '$email', '$number') ON DUPLICATE KEY UPDATE name='$name', email='$email', number='$number'";
    $q = mysqli_query($DB_connect, $insert);
    if($q==true)
    {
        echo"Recode Added Successfully";  //It Will Go To Ajax Response Handling Code
    }
    else
    {
        echo"Sorry";
    }
}
else
{
}
?>