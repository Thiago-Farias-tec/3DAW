<?php
require "conexao.php";

$sql = "SELECT r.*, a.nome AS nome_acomodacao FROM reservas r JOIN acomodacoes a ON a.id = r.id_acomodacao
ORDER BY r.id DESC
";

$res = $con->query($sql);

$dados = [];

while ($row = $res->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
