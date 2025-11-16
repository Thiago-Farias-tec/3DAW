<?php
include __DIR__ . '/conexao.php';

$sql = "SELECT * FROM horario_funcionamento ORDER BY id ASC";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$linha['dia_semana']}</td>
                <td>{$linha['hora_inicio']}</td>
                <td>{$linha['hora_fim']}</td>
                <td class='acoes'>
                    <button class='editar' onclick=\"window.location.href='adicionar_dia_de_fechamento.html?id={$linha['id']}'\">
                      <i class='fa-solid fa-pen-to-square'></i>
                    </button>
                    <button class='excluir' onclick='excluirHorario({$linha['id']})'>
                      <i class='fa-solid fa-trash-can'></i>
                    </button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum horário cadastrado</td></tr>";
}
?>
