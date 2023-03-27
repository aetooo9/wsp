<?php

$allowed_pages = array('index','home');

$page = $_GET['page'];

if(in_array($page,$allowed_pages)){

require $page;

}else{
    require 'index.php'; 
}
?>