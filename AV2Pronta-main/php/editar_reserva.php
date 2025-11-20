<?php
require "conexao.php";

if (!isset($_GET['id'])) {
    echo "ID da reserva não informado.";
    exit;
}

$id = intval($_GET['id']);

$stmt = $con->prepare("SELECT * FROM reservas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$reserva) {
    echo "Reserva não encontrada.";
    exit;
}

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
<title>Editar Reserva #<?= htmlspecialchars($reserva['id']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4">Editar Reserva — #<?= htmlspecialchars($reserva['id']) ?></h2>

    <form id="formEditar" action="atualizar_reserva.php" method="POST" class="card p-4 shadow">

        <input type="hidden" name="id" value="<?= $reserva['id'] ?>">

        <h4>Dados do Cliente</h4>

        <div class="mb-3">
            <label class="form-label">Nome do cliente</label>
            <input type="text" class="form-control" name="nome_cliente" required
                   value="<?= htmlspecialchars($reserva['nome_cliente']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email_cliente" required
                   value="<?= htmlspecialchars($reserva['email_cliente']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone_cliente" required
                   value="<?= htmlspecialchars($reserva['telefone_cliente']) ?>">
        </div>

        <hr>

        <h4>Informações da Acomodação</h4>

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
                <input type="date" class="form-control" name="data_inicio" required
                       value="<?= $reserva['data_inicio'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Data de fim</label>
                <input type="date" class="form-control" name="data_fim" required
                       value="<?= $reserva['data_fim'] ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Valor total (R$)</label>
            <input type="text" class="form-control" name="valor_total" id="valor_total" readonly
                   value="<?= number_format($reserva['valor_total'], 2, '.', '') ?>">
        </div>

        <hr>

        <h4>Pagamento</h4>

        <div class="mb-3">
            <label class="form-label">Método de pagamento</label>
            <select name="metodo_pagamento" class="form-control" required>
                <option value="pix" <?= ($reserva['metodo_pagamento'] == "pix" ? "selected" : "") ?>>PIX</option>
                <option value="cartao" <?= ($reserva['metodo_pagamento'] == "cartao" ? "selected" : "") ?>>Cartão</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Parcelas</label>
            <input type="number" class="form-control" name="parcelas" min="1"
                   editar_reserva.php
<?php
require "conexao.php";


if (!isset($_GET['id'])) {
    echo "ID da reserva não informado.";
    exit;
}


$id = intval($_GET['id']);


$stmt = $con->prepare("SELECT * FROM reservas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();
$stmt->close();


if (!$reserva) {
    echo "Reserva não encontrada.";
    exit;
}


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
<title>Editar Reserva #<?= htmlspecialchars($reserva['id']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container py-5">
    <h2 class="mb-4">Editar Reserva — #<?= htmlspecialchars($reserva['id']) ?></h2>


    <form id="formEditar" action="atualizar_reserva.php" method="POST" class="card p-4 shadow">


        <input type="hidden" name="id" value="<?= $reserva['id'] ?>">


        <h4>Dados do Cliente</h4>


        <div class="mb-3">
            <label class="form-label">Nome do cliente</label>
            <input type="text" class="form-control" name="nome_cliente" required
                   value="<?= htmlspecialchars($reserva['nome_cliente']) ?>">
        </div>


        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email_cliente" required
                   value="<?= htmlspecialchars($reserva['email_cliente']) ?>">
        </div>


        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone_cliente" required
                   value="<?= htmlspecialchars($reserva['telefone_cliente']) ?>">
        </div>


        <hr>


        <h4>Informações da Acomodação</h4>


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
                <input type="date" class="form-control" name="data_inicio" required
                       value="<?= $reserva['data_inicio'] ?>">
            </div>


            <div class="col-md-6 mb-3">
                <label class="form-label">Data de fim</label>
                <input type="date" class="form-control" name="data_fim" required
                       value="<?= $reserva['data_fim'] ?>">
            </div>
        </div>


        <div class="mb-3">
            <label class="form-label">Valor total (R$)</label>
            <input type="text" class="form-control" name="valor_total" id="valor_total" readonly
                   value="<?= number_format($reserva['valor_total'], 2, '.', '') ?>">
        </div>


        <hr>


        <h4>Pagamento</h4>


        <div class="mb-3">
            <label class="form-label">Método de pagamento</label>
            <select name="metodo_pagamento" class="form-control" required>
                <option value="pix" <?= ($reserva['metodo_pagamento'] == "pix" ? "selected" : "") ?>>PIX</option>
                <option value="cartao" <?= ($reserva['metodo_pagamento'] == "cartao" ? "selected" : "") ?>>Cartão</option>
            </select>
        </div>


        <div class="mb-3">
            <label class="form-label">Parcelas</label>
            <input type="number" class="form-control" name="parcelas" min="1"
                   value="<?= $reserva['parcelas'] ?>">
        </div>


        <div class="mb-3">
            <label class="form-label">Valor por parcela (R$)</label>
            <input type="text" class="form-control" name="valor_parcela"
                   value="<?= $reserva['valor_parcela'] ?>">
        </div>


        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
            <a href="../html/admin_reservas.html" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>


</body>
</html>


atualizar_reserva.php
<?php
require "conexao.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Requisição inválida.";
    exit;
}


$id = intval($_POST['id']);
$nome = $_POST['nome_cliente'];
$email = $_POST['email_cliente'];
$telefone = $_POST['telefone_cliente'];
$id_acomodacao = intval($_POST['id_acomodacao']);
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];


$metodo_pagamento = $_POST['metodo_pagamento'];
$parcelas = $_POST['parcelas'] ?: null;
$valor_parcela = $_POST['valor_parcela'] ?: null;


// Recalcular valor total
$stmt = $con->prepare("SELECT preco FROM acomodacoes WHERE id = ?");
$stmt->bind_param("i", $id_acomodacao);
$stmt->execute();
$preco = $stmt->get_result()->fetch_assoc()['preco'];
$stmt->close();


$days = (strtotime($data_fim) - strtotime($data_inicio)) / (60*60*24);
$valor_total = $days * $preco;


$stmt = $con->prepare("
UPDATE reservas SET
id_acomodacao=?, nome_cliente=?, email_cliente=?, telefone_cliente=?,
data_inicio=?, data_fim=?, valor_total=?,
metodo_pagamento=?, parcelas=?, valor_parcela=?
WHERE id=?
");


$stmt->bind_param(
    "isssssdssis",
    $id_acomodacao, $nome, $email, $telefone,
    $data_inicio, $data_fim, $valor_total,
    $metodo_pagamento, $parcelas, $valor_parcela,
    $id
);


if ($stmt->execute()) {
    header("Location: ../html/admin_reservas.html");
    exit;
} else {
    echo "Erro ao atualizar: " . $stmt->error;
}


o registar aula nao esta envolvido nessa parte


        </div>

        <div class="mb-3">
            <label class="form-label">Valor por parcela (R$)</label>
            <input type="text" class="form-control" name="valor_parcela"
                   value="<?= $reserva['valor_parcela'] ?>">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
            <a href="../html/admin_reservas.html" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

</body>
</html>
