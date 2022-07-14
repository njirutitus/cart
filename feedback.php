<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if(isset($_SESSION['error'])){
    echo '<p class="highlighted"style="color:red">'.$_SESSION['error'].'</p>';
    unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
    echo '<p class="success" style="color: green">'.$_SESSION['success'].'</p>';
    unset($_SESSION['success']);
}