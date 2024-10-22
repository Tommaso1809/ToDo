<?php
   
    $connection=mysqli_connect('localhost','cltyfibz_root',',aDeMz8i(m7?','cltyfibz_todo');

    if(!$connection){
        echo 'Connection Error';
    }


    $nameTask = mysqli_real_escape_string($connection, $_POST['name']);
    $descriptionTask = mysqli_real_escape_string($connection, $_POST['description']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    $link = mysqli_real_escape_string($connection, $_POST['link']);
    $tag=mysqli_real_escape_string($connection, $_POST['tag']);


    $query = "INSERT INTO tasks (taskName, description, dateTime, link, tag)
              VALUES ('$nameTask', '$descriptionTask', '$date','$link','$tag')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        header("Location:index.php");
    } else {
        echo 'Error: ' . mysqli_error($connection);
    }
?>