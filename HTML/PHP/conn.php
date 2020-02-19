<?php

$servidor = "localhost";
$usuario = "id12578151_projeto_farmacia";
$senha = "senac123";
$banco = "id12578151_projeto_farmacia";

$conn = new mysqli($servidor, $usuario , $senha, $banco);

if($conn ->connect_error){
    die("Não foi possível conectar :" . $conn->connect_error);
}