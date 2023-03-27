<?php

if(empty($_SESSION['token'])){

$_SESSION['token']=bin2hex(rand(32,32));

}


?>