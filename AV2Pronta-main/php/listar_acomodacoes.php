<?php
require "conexao.php";

$sql = "SELECT id, nome, preco FROM acomodacoes";
$result = $con->query($sql);

$dados = [];

while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
