<?php
require_once('config.php');

$record = new Config();

if (isset($_GET['id']) && isset($_GET['req'])) {
    if ($_GET['req']=='delete') {
        $record -> setId($_GET['id']);
        $record -> delete();
        echo "<script> alert('Los datos fueron borrados satisfactoriamente');document.location='facturas.php'</script>";
    }
}

?>