<?php include('server.php'); 

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $rec = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
    $edit_state = true;
    $record = mysqli_fetch_array($rec);
    $taskname = $record['taskname'];
    $description = $record['description'];
    $due_date = $record['due_date'];
    $id = $record['id'];

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attempt100</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Acme|VT323" rel="stylesheet"> 
</head>
<body>

    <!--This is where the user will recieve a message to state that an action has been performed or not. I used a div within an if statement to to contain the message and echoed a message which is stored on my server.php page -->
    <?php if(isset($_SESSION['msg'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            ?>
        </div> 
    <?php endif?>

    <!--This is my Title/ Application name-->
    <h1>Urick Esau's Task Manager v1.2.0(mxit)</h1>


    <!-- This is the form for users to enter their details. The data is saved to the server.php page-->
    <form method="post" action="server.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Task Name</label>
            <input type="text"name="taskname" value="<?php echo $taskname; ?>">
        </div>
        <div class="input-group">
            <label>Description</label>
            <input type="text"name="description" value="<?php echo $description; ?>">
        </div>
        <div class="input-group">
            <label>Due-date</label>
            <input type="text"name="due_date" value="<?php echo $due_date; ?>">
        </div>
        <div class="input-group">
            <!--Here I defined my buttons to respond according to whether a user wants to update or save a task-->
            <?php if ($edit_state == false): ?>
                <button type="submit" name="save" class="btn">Save</button>
             <?php else:  ?>
                <button type="submit" name="update" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>
    <!--USER FORM ENDS HERE-->

    <!--THIS IS THE TABLE WHICH DISPLAYS THE TASK INFORMATION ONCE IT HAS BEEN ENTERED AND SAVED-->
    <table>
        <thead>
            <tr>
                <th>Task Name</th>
                <th>Description</th>
                <th>Due Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
        <!--THE DATA IS FETCHED AND DISPLAYED VIA THE FETCH ARRAY FUNCTION. I CALLED THE DATA FROM THEIR ASSIGNED FIELDS IN THE DATABASE TO THEIR CORRESPONDING POSITION IN THE USER TABLE-->
        <?php while($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['taskname']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['due_date']; ?></td>
                <td><a class="edit_btn" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
                <td><a class="dlt_btn" href="server.php?dlt=<?php echo $row['id']; ?>">Delete</a></td>
            </tr>

        <?php }?>
            
        </tbody>
    </table>

    
</body>
</html>