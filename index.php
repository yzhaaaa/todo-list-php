<?php
    include("db.php");

    $tasks = $conn->prepare("SELECT task_name, id, is_completed FROM tasks");
    $tasks->execute();

    $all_tasks = $tasks->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet">
</head>

<body>
    <aside class="sidebar">
        <div>
            <div id="user-profile">
                <img src="images/user.png" alt="profile picture">
                <h2>Diwata Pares</h2>
            </div>
            <hr>
            <div class="navigation">
                <div>
                    <h3>My Task</h3>
                </div>
                <a href="completed_task.php">
                    <div>
                        <h3>Completed Task</h3>        
                    </div>
                </a>
            </div>
        </div>
    </aside>

    <div class="task">
        
        <section class="add-new-task">
            <h3>Add new task</h3>
            <form action="add_task.php" method="post">
                <input type="text" name="new-task" id="new-task" placeholder="Enter Task" required>
                <input type="submit" value="Add Task" id="add-task">
            </form>
        </section>

        <br>

        <section class="ongoing-task">
            <h3>Ongoing Task</h3>
                <?php
                    foreach($all_tasks as $task){
                        if ($task['is_completed'] == 1) {
                            continue;
                        }   
                ?>
                        <span>
                           
                            <form action="complete_task.php" method="post">
                                <input type="hidden" name="task_id" value="<?= $task['id']?>">                               
                                <input type="submit" name="completed" id="completed" value="✓">  
                            </form>

                            <form action="delete_task.php" method="post">
                                <input type="hidden" name="file_name" value="index.php">
                                <input type="hidden" name="task_id" value="<?= $task['id']?>">
                                <input type="submit" name="delete" id="delete" value="✕">
                            </form>                         

                            <div id="tasks">                             
                                    <p>
                                        <?php
                                            echo $task['task_name'];
                                        ?>
                                    </p>                             
                            </div>
                        </span>  
                        <br>
                <?php
                    }
                ?>           
        </section>
</body>

</html>