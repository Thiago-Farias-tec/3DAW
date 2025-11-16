<?php
require "conexao.php";

if (!isset($_GET['id'])) {
    echo "ID da reserva não informado.";
    exit;
}

$id = intval($_GET['id']);

// busca a reserva
$stmt = $con->prepare("SELECT * FROM reservas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$reserva) {
    echo "Reserva não encontrada.";
    exit;
}

// busca todas acomodações para o select
$res = $con->query("SELECT id, nome, preco FROM acomodacoes ORDER BY nome");
$acomodacoes = [];
while ($row = $res->fetch_assoc()) {
    $acomodacoes[] = $row;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Editar Reserva #<?=htmlspecialchars($reserva['id'])?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2 class="mb-4">Editar Reserva — #<?=htmlspecialchars($reserva['id'])?></h2>

    <form id="formEditar" action="atualizar_reserva.php" method="POST" class="card p-4 shadow">
        <input type="hidden" name="id" value="<?=htmlspecialchars($reserva['id'])?>">

        <div class="mb-3">
            <label class="form-label">Nome do cliente</label>
            <input type="text" class="form-control" name="nome_cliente" required
                   value="<?=htmlspecialchars($reserva['nome_cliente'])?>">
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email_cliente" required
                   value="<?=htmlspecialchars($reserva['email_cliente'])?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone_cliente" required
                   value="<?=htmlspecialchars($reserva['telefone_cliente'])?>">
        </div>

        <hr>
        <div class="mb-3">
            <label class="form-label">Acomodação</label>
            <select name="id_acomodacao" id="id_acomodacao" class="form-control" required>
                <?php foreach($acomodacoes as $a): 
                    $sel = ($a['id'] == $reserva['id_acomodacao']) ? 'selected' : '';
                ?>
                    <option value="<?= $a['id'] ?>" data-preco="<?= $a['preco'] ?>" <?= $sel ?>>
                        <?= htmlspecialchars($a['nome']) ?> — R$ <?= number_format($a['preco'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Data de início</label>
                <input type="date" class="form-control" name="data_inicio" id="data_inicio" required
                       value="<?=htmlspecialchars($reserva['data_inicio'])?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Data de fim</label>
                <input type="date" class="form-control" name="data_fim" id="data_fim" required
                       value="<?=htmlspecialchars($reserva['data_fim'])?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Valor total (R$)</label>
            <input type="text" class="form-control" name="valor_total" id="valor_total" readonly
                   value="<?=number_format($reserva['valor_total'], 2, '.', '')?>">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
            <a href="admin_reservas.html" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

<script src="editar_reserva.js"></script>
</body>
</html>
