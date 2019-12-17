<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "projeto_farmacia";

$conn = new mysqli($servidor, $usuario , $senha, $banco);

if($conn ->connect_error){
    die("Não foi possível conectar :" . $conn->connect_error);
}