<?php 
$conn = mysqli_connect("localhost", "root", "", "generatordb");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
echo "Conexão bem-sucedida!";
?>