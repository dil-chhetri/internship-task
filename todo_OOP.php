<?php

class DBConnection{
    public $db_name;
    public $username;
    public $password;
    public $conn;



    public function connectToDatabase(){
       $this->conn = $conn = new mysqli($this->db_name, $this->username, $this->password);
        if(!$conn -> connect_errno){
            echo "Connected to the database";
        }else{
            echo "Unable to connect to the database";
        }
    }
}

$db_obj = new DBConnection("todo","root","");
$db_obj->connectToDatabase();

class Todo {
    public $todo;
    public $conn;




    
    public function insertToDatabase($todo)
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            $query = "INSERT INTO todo_tbl (`todo`) VALUES (?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $todo);

            if ($stmt->execute()) {
                echo "Data inserted successfully";
            } else {
                echo "Error inserting data";
            }
        } else {
            echo "Http error";
        }
    }

    public function fetchFromDatabase(){
        $query = "SELECT * FROM todo_tbl";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        
    }

    public function deleteFromDatabase($id){
        if($id){
        $query = "DELETE FROM todo_tbl WHERE id = (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param(1, $id);
        if($stmt->execute()){
            echo "Deleted successfully";
        }else{
            echo "Error deleting";
        }
        }else{
            echo "Invalid todo id";
        }
    
    }


    public function updateTodo($todo,$id){
        if($id){
            $query = "UPDATE todo_tbl SET `TODO` = (?) WHERE id = (?) ";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $todo);
            $stmt->bind_param(1, $id);
            if($stmt->execute()){
                echo "Data updated successfully";
            }else{
                echo "Error updating data";
            }
        }else{
            echo "Invalid todo";
        }
    }
}

if(isset($_REQUEST['todo_add'])){

    $todo = $_REQUEST['todo'];
    $insert_obj = new Todo();
    $insert_obj->insertToDatabase($todo);

}else if(isset($_REQUEST['todo_update'])){

    $todo = $_REQUEST['todo'];
    $todo_id = $_REQUEST['todo_id'];
    $update_obj = new Todo($todo);
    $update_obj->updateTodo($todo , $todo_Id);

}else if(isset($_REQUEST['todo_delete'])){

    $todo_id = $_REQUEST['todo_id'];
    $delete_obj = new Todo();
    $delete_obj->deleteFromDatabase($todo_id);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        <div class="form-group">
            <input type="text" name="todo" placeholder="Enter your todo" id="todo" >
        </div>
        <input type="button" value="ADD" name="todo_add" id="btn_ins"/>
    </form>
    <div class="col-md-6">
    <h3>Todo List</h3>
    <div id="todo_list">

    </div>
    </div>

<script>
        $(document).on('click', '#btn_ins', function() {
        
        if ($('#todo').val() == "") {
            alert('Please write todo first');
        } else {
            $todo = $('#todo').val();
            $.ajax({
                type: "POST",
                url: "todo_OOP.php",
                data: {
                    todo: $todo,
                    
                },
                success: function() {
                    $('#todo').val("");
                    fetchTodo();
                }
            });
        }
    });

    $(document).on('click', '#btn_update', function(){
        if($('#todo').val() == ""){
            alert('Todo cannot be empty');
        }else{
            $todo = $('#todo').val();
            $id = $('#todo_id').val();
            $.ajax({
                type: "POST",
                url: "todo_OOP.php",
                data: {
                    id  : $id,
                    todo: $todo,
                },
                success: function() {
                   
                    fetchTodo();
                }
            });
        }
    })
    
    $(document).on('click', "#btn_delete", function(){
        $id = $('#todo_id').val();
        $.ajax({
            type:"POST",
            url : "todo_OOP.php",
            data: {
                id : $id,
            },
            success: function() {
                fetchTodo();
            }
        })
    })

    function fetchTodo() {
                
                $.ajax({
                    url: 'todo_OOP.php',
                    type: 'POST',
                    async: false,
                    data: {
                        fetch : 1,
                    },
                    success: function(response) {
                        $('#todo_list').html(response);
                        
                    }
                });
            }
    $(document).ready(function() {
        setInterval(fetchTodo, 1000);
    });

</script>
</body>
</html>