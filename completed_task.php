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
                <a href="index.php">
                    <div>
                        <h3>My Task</h3>
                    </div>
                </a>
                <div>
                    <h3>Completed Task</h3>
                </div>
            </div>
        </div>
    </aside>

    <div class="task">
        <section class="completed-task">
            <h3>Completed Task</h3>
                <?php
                    foreach($all_tasks as $task){
                        if ($task['is_completed'] == 0) {
                            continue;
                        }   
                ?>
                        <span>
                            <form action="delete_task.php" method="post">
                                <input type="hidden" name="file_name" value="completed_task.php">
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