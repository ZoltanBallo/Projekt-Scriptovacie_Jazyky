<?php
include_once "../functions.php";
use tours\Functions;
$tours = new Functions();

if(isset($_GET['id'])) {
    $delete = $tours->deleteItem($_GET['id'], $_GET['what']);
    if($delete) {
		header('Location: ../admin.php?what=' . $_GET['what'] . '&data=' . $_GET['data']);
    } else {
        header('Location: error.html');
    }
} else {
    header('Location: ../admin.php');
}
?>