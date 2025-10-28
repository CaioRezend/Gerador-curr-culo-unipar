<?php
$conn = mysqli_connect("localhost", "root", "", "generatordb");

if (!$conn) {
    new JsonException("Falha na conexão: " . mysqli_connect_error());
}
?>