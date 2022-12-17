<?php
$conn=mysqli_connect('db','root','example','eventmanagement');
if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
}
?>