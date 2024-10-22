<?php
     $connection=mysqli_connect('localhost','cltyfibz_root',',aDeMz8i(m7?','cltyfibz_todo');

    if(!$connection){
        echo 'Connection Error';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <style>
        *{
            padding:0;
            margin:0;
        }

        

        #sidebar{
            width:150px;
            min-height: 100%;
            background-color: #fafafa ;
            font-family: 'Poppins' ,sans-serif;
            padding:50px;
            padding-left: 50px;
            border-radius: 15px;
            transition: width 2s;
            overflow: hidden;

        }

        #sidebar:hover{
            width: 200px;
        }

        #sidebar h5{
            font-size: 20px;
        }

        #sidebar input[type=text]{

            border-radius: 15px;
            border:0px;
            height:15px;
            padding:10px;
            width: 200px;

        }

        #sidebar h6{
            font-size: 16px;
            font-weight: 400;
        }

        #sidebar li{

            font-size: 12px;
            list-style: none;
        }

        a:hover{
            
            text-decoration: underline;
        }

        a{
            color: black;
            text-decoration: none;
            cursor: pointer;
            
        }

        input:focus{
            border:none;
            outline: none;
        }

        textarea:focus{
            outline: none;
        }

        body {
            display: flex; 
        }

        #sidebar {
            max-width: 220px;
            height: 1000px;
            background-color: #fafafa;
            font-family: 'Poppins', sans-serif;
            padding: 50px;
            padding-left: 50px;
            border-radius: 15px;
        }

        #up{
            flex-grow: 1; 
            padding: 50px; 
        }

        #to{
            display: none;
            flex-grow: 1; 
            padding: 50px; 
        }

        #up h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 25px;
        }

        #to h3{
            font-family: 'Poppins', sans-serif;
            font-size: 25px;
        }

        hr{

            max-width:70%;
            background-color: #dedede;
            height: 1px;
            border: 0px;
        }

        #up li{
            color: black;
            list-style: none;
            font-family: 'Poppins', sans-serif;


        }


        #to li{
            color: black;
            list-style: none;
            font-family: 'Poppins', sans-serif;

        }

        #new{
            width: 220px;
            min-height: 100%;
            background-color: #fafafa ;
            font-family: 'Poppins' ,sans-serif;
            padding:50px;
            padding-left: 50px;
            border-radius: 15px;
            display: flex;
            justify-content: flex-end;
            transition: width 2s;

            align-items: flex-end;
        }

        

        #new input[type=datetime-local]{
            border: 0px;
            background-color: #fafafa;
        }

        #new input[type=text]{
        
            border:none;
            height:15px;
            padding:10px;
            width: 200px;
            box-sizing: border-box;
            background-color: #fafafa;
            color:black;
        }

        #new input[type=submit]{
            border: 0;
            padding:10px;
            border-radius: 15px;
            font-weight: 550;
        }

        input[type=checkbox]{
        margin: 0;
        
        padding: 2px 0 0px 24px;
        cursor: pointer;
        }

        textarea{
           
            text-align: left;
            border:0px;
            max-height:100px;
            max-width: 200px;
            padding:10px;
            width: 200px;
            box-sizing: border-box;
        }

        #new hr{
            width: 200px;
        }

        #new{
            display: none;
        }

        

        #inspect{
            display: none;
            font-family: 'Poppins' ,sans-serif;
            
            flex-grow: 1; 
            padding: 50px; 

        }

        #inspect h3{
            font-size: 25px;            
        }
        
        .circleP{
            width: 20px; 
            height: 20px; 
            background-color: #4287f5; 
            border-radius: 50%; 
            display: inline-block;
            margin-right: 10px; 
            vertical-align: middle; 
        }
        
        .circleU{
             width: 20px; 
            height: 20px; 
            background-color: #ff3d3d; 
            border-radius: 50%; 
            display: inline-block;
            margin-right: 10px; 
            vertical-align: middle; 
            
        }
        
    </style>
    
    <script src="script.js"></script>
    
</head>
<body>

    <div id="sidebar">
        <h5>Menu</h5><br>
        <br><br>
        <h6>TASKS</h6>
        <br>
        <ul>

        <?php 

        $dateNow=date("Y/m/d");
        
        
        $query = "SELECT COUNT(*) as total FROM tasks WHERE NOT dateTime = '$dateNow'"; 

        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['total']; 
        } else {
            $count = 0; 
        }

        echo '<li><a onclick="openUpcoming()">Upcoming &nbsp;&nbsp; <strong>' . $count . '</strong></a></li>';
        ?>
            <br>
            <?php 

        $dateNow=date("Y/m/d");
        
        
        $query = "SELECT COUNT(*) as total FROM tasks WHERE  dateTime = '$dateNow'"; 

        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['total']; 
        } else {
            $count = 0; 
        }

        echo '<li><a onclick="openToday()">Today &nbsp;&nbsp; <strong>' . $count . '</strong></a></li>';
        ?>
        
        <?php 

      
        
        
        $query = "SELECT COUNT(*) as total FROM tasks WHERE tag = '#Personal'"; 

        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['total']; 
        } else {
            $count = 0; 
        }

        
        echo '<br><br><li style="text-align:left;"><div class="circleP"></div> Personal &nbsp; <strong>'.$count.'</strong></li>'
        
        ?>
        
        <?php 

      
        
        
        $query = "SELECT COUNT(*) as total FROM tasks WHERE tag = '#University'"; 

        $result = mysqli_query($connection, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $count = $row['total']; 
        } else {
            $count = 0; 
        }

        
        
       echo' <br><li style="text-align:left;"><div class="circleU"></div>University &nbsp; <strong>'.$count.'</strong></li>';
        ?>
        </ul>

        <br><br><br>

        
    </div>

    <div id="up">
        <h3>Upcoming</h3>
        <br>
        <hr>
        <br>

        <ul>
            <li ><a style="color:#A9ACAC" onclick="addTask()"><i class="fa fa-plus"></i> &nbsp; <strong>Add New Task</strong> </a></li>
           
        </ul>
        

        <ul>
        
            <?php

            $dateNow=date("Y/m/d");

            $query="SELECT * FROM tasks WHERE NOT dateTime='$dateNow'";

            $result=mysqli_query($connection,$query);

            if(mysqli_num_rows($result)==0) {

                echo '<ul>';
                     echo'<br>';
                     echo '<li style="font-size:13px;color:black;"> No Tasks </li>' ;
                 echo '</ul>';
                
 

            }else{
                while ($row = mysqli_fetch_array($result)) {
                    echo '<br>';
                    echo '<hr>';
                    echo '<br>';
                    
                    echo '<li>';
                    echo '<input type="checkbox" class="task-checkbox" id="'.$row['Id'].'">'; 
                    echo '&nbsp;&nbsp;<strong><a onclick="inspectTask(' . $row['Id'] . ')">' . htmlspecialchars($row['taskName']) .'</a></strong>';
                    echo '<br>';
                    echo '<p style="font-size:13px;color:black;">' . htmlspecialchars($row['dateTime']). '</p>' ;
                    echo '<form action="delete.php" method="post">';
                        echo '<input type="hidden" name="Id" value="'.$row['Id'].'"/>';
                        echo '<input type="submit" style="displat:flex-end;background-color:white;border:none;"; value="Elimina" />';
                    echo '</form>';
                    echo '</li>';
                   
                    
                }
    

            }
            
            
            ?>
           
            
        </ul>
        
    </div>

    <div id="to">
        <h3>Today</h3>
        <br>
        <hr>
        <br>

        <ul>
            <li ><a style="color:#A9ACAC" onclick="addTask()"><i class="fa fa-plus"></i> &nbsp; <strong>Add New Task</strong> </a></li>
           
        </ul>
        

        <ul>
        
            <?php

            $query="SELECT * FROM tasks WHERE dateTime='$dateNow'" ;

            $result=mysqli_query($connection,$query);

            if(mysqli_num_rows($result)==0){

               echo '<ul>';
                    echo'<br>';
                    echo '<li style="font-size:13px;color:black;"> No Tasks </li>' ;
                echo '</ul>';
               

            }else{
                while ($row = mysqli_fetch_array($result)) {
                    echo '<br>';
                    echo '<hr>';
                    echo '<br>';
                    
                    echo '<li>';
                    echo '<input type="checkbox" class="task-checkbox" id="'.$row['Id'].'">'; 
                    echo '&nbsp;&nbsp;<strong><a onclick="inspectTask(' . $row['Id'] . ')">' . htmlspecialchars($row['taskName']).'</a></strong> ';
                    echo '<br>';
                    echo '<p style="font-size:13px;color:black;">' . htmlspecialchars($row['dateTime']) . '</p>' ;
                    echo '<form action="delete.php" method="post">';
                        echo '<input type="hidden" name="Id" value="'.$row['Id'].'"/>';
                        echo '<input type="submit" style="displat:flex-end;background-color:white;border:none;"; value="Elimina" />';
                    echo '</form>';
                    echo '</li>';
                   
                    
                }
    

            }
            
            
            ?>
           
            
        </ul>
        
    </div>

    <div id="new">
        <a onclick="closeTask()" ><i style="position: absolute; right: 20px; " class="fa fa-remove"></i></a>
        <h3>Task:</h3>

        <form action="insert.php" method="post">
            <p style="font-size: 13px;">Name Task</p>
            <hr>
            <input type="text" name="name" id="name" placeholder="Title" required><br>
            <br>
            <p style="font-size: 13px;">Description</p>
            <hr>
            <textarea id="description" name="description" rows="5" cols="33">
            
            </textarea>
            <br><br>
            <p style="font-size: 13px;">Date</p>
            <hr>

            <input type="date" name="date" id="date" required><br><br>
            <p style="font-size: 13px;">Tag</p>
            <hr>
            <select id="tag" name="tag">
                
                <option value="#Personal">Personal</option>
                <option value="#University">University</option>
            </select>
   
            <br><br><p style="font-size: 13px;">Link</p>
            <hr>
            <input type="text" name="link" id="link" placeholder="Attach Link">
            
            <br><br><br>

            <input type="submit" value="Save Changes" />

        </form>

    </div>

   


    <?php

        $taskId = isset($_GET['Id']) ? intval($_GET['Id']) : 0;


        $query = "SELECT * FROM tasks WHERE Id = $taskId";

        $result = mysqli_query($connection, $query);
    ?>

    <div id="inspect">
        <a onclick="closeInspection()"><i style="position: absolute; right: 50px; font-size: 35px;" class="fa fa-close"></i></a>
        <h3 id="task-name"></h3>
        <p id="task-tag"></p>
        <p id="task-date"></p>
        <p id="task-description"></p><br>
        <p id="task-link"></p>
    </div>

        

  
    
</body>
</html>