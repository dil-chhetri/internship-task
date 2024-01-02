<?php 

$username = "root";
$db_name = "todo";
$password = "";

$conn = new mysqli($username, $db_name, $password);

if($conn){
    echo "Connected to the database";

}else{
    echo "Unable to connect to the database";
}

if(isset($_REQUEST['add_todo'])){
    $value = $_REQUEST['todo'];
    $query = "INSERT INTO todo_tbl `list` VALUES ($value)";
    $result = mysqli_query($conn , $query);
    if($result > 1){
        echo "Data inserted into the table";
    }else{
        echo "Error inserting the data";
    }

}else if(isset($_REQUEST['del_btn'])){
    $list_id = $_REQUEST['del_btn'];
    $query = "DELETE FROM todo_tbl WHERE id='$list_id'";
    $result = mysqli_query($conn, $query);
    if($result > 1){
        echo "Data deleted successfully";
    }else{
        echo "Error deleting data";
    }
}elseif(isset($_REQUEST['upt_btn'])){
    $list_id = $_REQUEST['todo_id'];

        if($list_id){
            $todo = $_REQUEST['new_todo'];
            $query = "SET `todo` = $todo WHERE id=' $list_id '";
            $result = mysqli_query($conn, $query);
            if($result > 1){
                echo 'Data updated successfully';
            }else{
                echo 'Error deleting data';
            }

        }else{
            echo 'Invalid Todo';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="col-md-12">
        <div class="col-md-6">
        <form action="post">
        <div class="form-group">
            <input type="text" name="todo" id="" placeholder="Enter TODO">
        </div>
        <div class="btn-group">
            <input type="submit" value="ENTER" name="add_todo">
        </div>
        </form>  
        </div>
        <div class="col-md-6">
            <h3>Todo List</h3>
            <?php 
                $todo_fetch = "SELECT * FROM todo_tbl";
                $result = mysqli_query($conn ,$todo_fetch);
            foreach($result as $item):?>
                <div class="card"><?= $item ?>
                    <button class="btn-del" value="<?=$item['id']?>" type="btn" name="del_btn">Delete</button>
                    <button class="btn_upd" value="<?= $item['id'] ?>" name="upt_btn">Update </button>
                </div>
            <?php endforeach ?>
            
        </div>
    </div>
  
</body>
</html>