<?php


    $connection=mysqli_connect('localhost','cltyfibz_root',',aDeMz8i(m7?','cltyfibz_todo');

    if(!$connection){
        echo 'Connection Error';
    }


$ID = mysqli_real_escape_string($connection, $_POST['Id']);


$query = "DELETE FROM tasks WHERE  Id = '$ID'";


$result = mysqli_query($connection, $query);

if ($result) {
    header("Location:index.php");
    exit;

    exit;
} else {
    echo 'Error: ' . mysqli_error($connection);
}
?>

