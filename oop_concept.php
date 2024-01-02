<?php 
session_start();

class Todo{
    public $todo;
    public $todoList = [];
    public function __construct($todo){
        $this->todo = $todo;

    }

    public function __destruct()
    {
       $todoList = array_push($this->todoList,$this->todo);
        $_SESSION['todo'] = $todoList;
        echo "Todo added";
    }
    
}


$todo_obj = new Todo("Get work done");
$todo_item []  = $_SESSION['todo'];
if(empty($todo_item)):
foreach($todo_item as $item):
    echo $item."\n";
endforeach;
endif;

?>