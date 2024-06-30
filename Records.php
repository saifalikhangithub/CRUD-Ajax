
<?php
include("DB_Connection.php");

$select = "SELECT * FROM crud";
$q = mysqli_query($DB_connect, $select);
if($Check = mysqli_num_rows($q)>0)
{
    while($row = mysqli_fetch_assoc($q))
    {
        $data[] = $row;     //it will return an Array
    }
}

//it will convert your array into JSON Returning JSON format data
echo json_encode($data);

?>