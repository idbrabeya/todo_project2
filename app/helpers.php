<?php 

 function todoname(){
    return App\Models\Todo::all();
 }
 function users(){
   return App\Models\User::all();
}
function tasks(){
   return App\Models\Task::all();
}
?>