<?php
    include("db.php");
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $task_id = $_POST['task_id'];

        $query = $conn->prepare("DELETE FROM tasks WHERE id = :task_id");

        $query->bindParam(":task_id", $task_id);

        try{
            $query->execute();

                if ($_POST['file_name'] == "index.php"){
                    header("Location: index.php");
                } else{
                    header("Location: completed_task.php");
                }
           
        } catch(\Throwable $th) {
            echo "Something went wrong.";
        }
    }
?>