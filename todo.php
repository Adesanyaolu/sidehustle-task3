<?php
        $errors = "";
        $db = mysqli_connect("localhost", "root", "", "to-do");

    if (isset($_POST["submit"])) {
        $title = $_POST['title'];
        if (empty($title)){
            $errors = "You must fill in the task";
        } else {
            mysqli_query($db, "INSERT INTO todo (titles) VALUES ('$title')");
            header('location: todo.php');
        }
    }
/*    if (isset($_POST["submit"])) {
        $description = $_POST['description'];
        if (empty($description)){
            $errors = "Input Specific info about the task.";
        } else {
            mysqli_query($db, "INSERT INTO todo (descriptions) VALUES ('$description')");
            header('location: todo.php');
        }
    } */
    // delete task
    if (isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM todo WHERE id=$id");
        header('location:todo.php');
    }

    $title = mysqli_query($db, "SELECT * FROM todo");
    $description = mysqli_query($db, "SELECT * FROM todo");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Create Todo list</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
            <h1>Create Todo List</h1>
            <form action = "todo.php" method = "POST">
            <?php if (isset($errors)) { ?>
                <p><?php echo $errors; ?></p>
            <?php } ?>

                <p>Todo title: </p>
                    <input name="title" type="text">
            <!--    <p>Todo description: </p>
                    <input name="description" type="text">
                <br> -->
                <br>
                    <input type="submit" name="submit" value="submit">
            </form>
            
            <table>
                <thead>
                    <tr>
                        <th>N</th>
                        <th>Task</th>
                    <!--    <th>Description</th> -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; while ($row = mysqli_fetch_array($title)) { ?>
                        <tr>
                        <td><?php echo $i; ?> </td>
                        <td class="task"><?php echo $row['titles']; ?></td>
                    <!-- <td class="task"><?php echo $row['descriptions']; ?></td> -->
                        <td class="delete">
                            <a href="todo.php?del_task=<?php echo $row['id']; ?> ">x</a>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                    
                </tbody>
            </table>


    </body>