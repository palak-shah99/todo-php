<?php
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
// $oldValue ='';

$todoname = $_POST['todo_name'] ?? '';
$todoname = trim($todoname);
$oldTodo = $_POST['oldTodo'];

if($oldTodo){
    $json = file_get_contents('todo.json');
    $jsonArray = json_decode($json, true);
    unset($jsonArray[$oldTodo]);
    file_put_contents('todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
    header('Location: temp.php');
}

if($todoname){
  if(file_exists('todo.json'))
  {
    $json = file_get_contents('todo.json');
    $jsonArray = json_decode($json, true);
  }else{
    $jsonArray = [];
  }
  $jsonArray[$todoname] = ['completed' => false]; //we are creating a new entry in json data.
    file_put_contents('todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
    header('Location: temp.php');

}
//This is to delete an existing record
if(isset($_GET['delete'])){
  $deleteTodo = $_GET['delete'];
  $json = file_get_contents('todo.json');
  $jsonArray = json_decode($json, true);
  unset($jsonArray[$deleteTodo]);
  file_put_contents('todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
  header('Location:temp.php');
}


?>