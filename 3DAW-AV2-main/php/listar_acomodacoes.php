<?php

require "conexao.php";


$sql = "SELECT id, nome, descricao, preco, imagem FROM acomodacoes";
$result = $con->query($sql);

$dados = [];

while ($row = $result->fetch_assoc()) {
    $row["nome_formatado"] = $row["nome"] . " — R$ " . $row["preco"];
    $dados[] = $row;
}


header('Content-Type: application/json');
echo json_encode($dados);

?>