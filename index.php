<?php
session_start();
$todo_list = [];
if($REQUEST_METHOD == 'POST'){
$todo = $_REQUEST['todo'];
$todo_list.array_push($todo);
}
else if(isset($_REQUEST['todo_del'])){
    $todo_list.array_pop($_REQUEST['index']);
}
$_SESSION['todo'] = $todo_list;

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
            <input type="submit" value="ENTER" name="todo_btn">
        </div>
        </form>  
        </div>
        <div class="col-md-6">
            <h3>Todo List</h3>
            <?php 
            $todo_db = $_SESSION['todo'];
            foreach($todo_db as $list): ?>
                <div class="card"><?= $list ?>
                <input type="hidden" name="index" value="<?= $list ?>">
                <button class="btn-del" value="<?= $list ?>"  name="todo_del">Delete Todo</button>
                </div>
            <?php endforeach ?>
            
        </div>
    </div>
  
</body>
</html>