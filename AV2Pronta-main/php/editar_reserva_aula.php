<?php
require "conexao.php";


if (!isset($_GET['id'])) {
    echo "ID inválido.";
    exit;
}

$id = intval($_GET['id']);

$stmt = $con->prepare("SELECT * FROM reservas_aulas WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$reserva) {
    echo "Reserva não encontrada.";
    exit;
}

$res = $con->query("SELECT * FROM aulas ORDER BY nome");
$aulas = [];
while ($row = $res->fetch_assoc()) $aulas[] = $row;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Reserva Aula</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container py-5">
<h2>Editar Reserva Aula — #<?=$reserva['id']?></h2>

<form action="atualizar_reserva_aula.php" method="POST" class="card p-4 shadow">
    <input type="hidden" name="id" value="<?=$reserva['id']?>">

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" class="form-control" name="nome_cliente" value="<?=$reserva['nome_cliente']?>" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control" name="email_cliente" value="<?=$reserva['email_cliente']?>" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input type="text" class="form-control" name="telefone_cliente" value="<?=$reserva['telefone_cliente']?>" required>
    </div>

    <div class="mb-3">
        <label>Aula / Serviço</label>
        <select name="id_aula" id="id_aula" class="form-control" required>
            <?php foreach ($aulas as $a): ?>
                <option 
                    value="<?=$a['id']?>" 
                    data-preco="<?=$a['preco']?>"
                    <?=$a['id'] == $reserva['id_aula'] ? 'selected' : ''?>
                >
                    <?=$a['nome']?> — R$ <?=$a['preco']?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Quantidade</label>
        <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" required value="<?=$reserva['quantidade']?>">
    </div>

    <div class="mb-3">
        <label>Valor Total</label>
        <input type="text" name="valor_total" id="valor_total" class="form-control" readonly value="<?=$reserva['valor_total']?>">
    </div>

    <div class="d-flex gap-2">
        <button class="btn btn-primary">Salvar</button>
        <a href="../html/admin_reservas_aulas.html" class="btn btn-secondary">Voltar</a>
    </div>
</form>

</div>

<script src="../js/editar_reserva_aula.js"></script>

</body>
</html>
