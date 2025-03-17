<?php 
    include("db.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $task_id = $_POST['task_id'];

        $query = $conn->prepare("UPDATE tasks SET is_completed=1 WHERE id = :task_id");
        
        $query->bindParam(":task_id", $task_id);

        try{
            $query->execute();
            
            header("Location: index.php");
        } catch(\Throwable $th) {
            echo"Something went wrong.";
        }
    }
?>