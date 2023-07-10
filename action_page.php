<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $txt=test_input($_POST["comment"]);
                
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>