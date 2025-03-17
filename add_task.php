<?php  
    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $new_task = $_POST['new-task'];

        $query = $conn->prepare("INSERT INTO tasks (task_name)
                                    VALUES (:new_task)");

        $query->bindParam(":new_task", $new_task);

        try{
            $query->execute();
            
            header("Location: index.php");
        } catch (\Throwable $e){
            echo"Something went wrong.";
        }
    }
?>