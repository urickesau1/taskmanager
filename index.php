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
    <?php if(isset($_SESSION['msg'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            ?>
        </div> 
    <?php endif?>

    <h1>Urick Esau's Task Manager v1.2.0(mxit)</h1>

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
            <?php if ($edit_state == false): ?>
                <button type="submit" name="save" class="btn">Save</button>
             <?php else:  ?>
                <button type="submit" name="update" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>




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