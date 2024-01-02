$(document).on('click', '#btn_ins', function() {
        
    if ($('#todo').val() == "") {
        alert('Please write todo first');
    } else {
        let todo = $('#todo').val();
        $.ajax({
            type: "POST",
            url: "todo_OOP.php",
            data: {
                todo: todo,
                
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