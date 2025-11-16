<?php
include __DIR__ . '/conexao.php';

$sql = "SELECT * FROM clientes ORDER BY data DESC, hora DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($c = $result->fetch_assoc()) {

        $data_br = date("d/m/Y", strtotime($c['data']));

        echo "<tr>
                <td>{$c['nome']}</td>
                <td>{$data_br}</td>
                <td>{$c['hora']}</td>
                <td class='acoes'>
                    <button class='editar' onclick=\"window.location.href='alterar_cliente.html?id={$c['id']}'\">
                        <i class='fa-solid fa-pen-to-square'></i>
                    </button>

                    <button class='excluir' onclick='excluirCliente({$c['id']})'>
                        <i class='fa-solid fa-trash-can'></i>
                    </button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum cliente cadastrado.</td></tr>";
}
?>
