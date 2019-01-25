<?php

session_start();

$taskname = "";
$description = "";
$due_date = "";
$id = 0;
$edit_state = false;
//Creating a connection to the database

$db = mysqli_connect('localhost', 'root', 'MyNewPass', 'crud');

if (isset($_POST['save'])) {
    $taskname = $_POST['taskname'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $query = "INSERT INTO info (taskname, description, due_date) VALUES ('$taskname', '$description', '$due_date')";
    mysqli_query($db, $query);
    $_SESSION['msg'] = "TASK SAVED";
    header('location: index.php');


}

if (isset($_POST['update'])) {
   $taskname = mysqli_real_escape_string($db, $_POST['taskname']);
   $description = mysqli_real_escape_string($db, $_POST['description']);
   $id = mysqli_real_escape_string($db, $_POST['id']);
   $due_date = mysqli_real_escape_string($db, $_POST['due_date']);


   mysqli_query($db, "UPDATE info SET taskname='$taskname', description='$description', due_date='$due_date' WHERE id='$id'");
   $_SESSION['msg'] = "TASK UPDATED";

    header('location: index.php');
}

if (isset($_GET['dlt'])) {
    $id = $_GET['dlt'];
    mysqli_query($db, "DELETE FROM info WHERE id=$id");
    $_SESSION['msg'] = "TASK DELETED";
    header('location: index.php');
}




$results = mysqli_query($db, "SELECT * FROM info ORDER BY taskname");


?>