<?php
session_start();
$Session = json_decode(file_get_contents("http://localhost:3000/Session"));
$holder= $Session[0]->id;
$name = $Session[0]->name;
$type = $Session[0]->acountHolder;
$_SESSION['name']= $name;
$_SESSION['id']=$holder;

if($type=="user"){
    header("location:http://localhost/SWE-2-PRO/index.php");
}else{
    header("location:http://localhost/SWE-2-PRO/index5.php");
}