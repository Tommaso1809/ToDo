<?php

    $connection=mysqli_connect('localhost','cltyfibz_root',',aDeMz8i(m7?','cltyfibz_todo');

    if(!$connection){
        echo 'Connection Error';
    }

$taskId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT * FROM tasks WHERE Id = $taskId";
$result = mysqli_query($connection, $query);

if ($row = mysqli_fetch_array($result)) {
    echo json_encode([
        'taskName' => htmlspecialchars($row['taskName']),
        'description' => htmlspecialchars($row['description']),
        'dateTime' => htmlspecialchars($row['dateTime']),
        'link' => htmlspecialchars($row['link']),
        'tag' => htmlspecialchars($row['tag'])
    ]);
} else {
    echo json_encode(['error' => 'Task not found']);
}
?>