<?php
$todos = [];
if(file_exists('todo.json'))
{
    $jsondata = file_get_contents('todo.json');
    $todos= json_decode($jsondata, true);
}
$update = false;
if(isset($_GET['edit']))
 { 
     $update = true;
   $oldValue = $_GET['edit'];
 }else {
     $oldValue ='';
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>PHP CRUD</title>
</head>
<body>
<div class="container">
<div class="row justify-content-center">
    <table class="table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Todo</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <?php 
        foreach ($todos as $todoname => $todo): ?> 
            <tr>
                <td>
                <form action="change_status.php" method="POST">
                    <input type="hidden" name="todo_name" value="<?php echo $todoname; ?>" />
                    <input type="checkbox" <?php echo $todo['completed'] ? 'checked' : '' ?>/>
                </form>
                </td>
                <td><?php echo $todoname ?></td>
                <td>
                <a href="temp.php?edit=<?php echo $todoname; ?>" class="btn btn-info">Edit</a>
                <a href="newtodo.php?delete=<?php echo $todoname; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<div class="row justify-content-center">
    <form action="newtodo.php" method="post">
    <div class="form-group">
    Todo:
    <?php if($update):?>
    <input type="hidden" name="oldTodo" value="<?php echo $oldValue; ?>"/>
    <?php endif; ?>
    <input class="form-control" type="text" name="todo_name" 
     value="<?php echo $oldValue; ?>" placeholder="Enter your todo"/>
    </div>
    <div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
    </div>
    </form>
    </div>
</div>
<script>
    const checkboxes = document.querySelectorAll('input[type=checkbox]');
    checkboxes.forEach(ch => {
        ch.onclick = function(){
            this.parentNode.submit();               //submitting the form whenever the checkbox is checked.
        };
    });
</script>
</body>
</html>