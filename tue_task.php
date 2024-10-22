<?php

    $connection=mysqli_connect('localhost','cltyfibz_root',',aDeMz8i(m7?','cltyfibz_todo');

    if(!$connection){
        echo 'Connection Error';
    }

function getDueTasks() {
    global $connection;

    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    $sql = "SELECT * FROM tasks WHERE dateTime >= '$tomorrow 00:00:00' AND dateTime < '$tomorrow 23:59:59'";
    
    $result = mysqli_query($connection, $sql);
    
    if (!$result) {
        die('Query Error: ' . mysqli_error($connection));
    }
    
    $dueTasks = [];
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dueTasks[] = $row;
        }
    }
    
    return $dueTasks;
}

header('Content-Type: application/json'); 
$tasksDueTomorrow = getDueTasks();
echo json_encode($tasksDueTomorrow); 


mysqli_close($connection);
?>