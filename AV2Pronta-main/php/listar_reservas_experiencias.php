<?php
require "conexao.php";

$sql = "SELECT re.*, e.nome AS nome_experiencia FROM reservas_experiencias re JOIN experiencias e ON e.id = re.id_experiencia ORDER BY re.id DESC";

$res = $con->query($sql);
$dados = [];

while ($row = $res->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode($dados);
