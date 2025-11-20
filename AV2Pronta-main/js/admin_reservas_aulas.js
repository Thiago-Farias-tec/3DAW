function carregarReservasAulas() {
    fetch("../php/listar_reservas_aulas.php")
        .then(r => r.json())
        .then(dados => {

            let html = "";

            dados.forEach(r => {
                html += `
                    <tr>
                        <td>${r.id}</td>
                        <td>${r.nome_cliente}</td>
                        <td>${r.email_cliente}</td>
                        <td>${r.telefone_cliente}</td>
                        <td>${r.nome_aula}</td>
                        <td>${r.quantidade}</td>
                        <td>R$ ${r.valor_total}</td>
                        <td>
                            <a href="../php/editar_reserva_aula.php?id=${r.id}" class="btn btn-warning btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm" onclick="excluir(${r.id})">Excluir</button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById("listaAulas").innerHTML = html;
        });
}

carregarReservasAulas();

function excluir(id) {
    if (!confirm("Excluir esta reserva?")) return;

    fetch("../php/excluir_reserva_aula.php?id=" + id)
        .then(r => r.text())
        .then(msg => {
            alert(msg);
            carregarReservasAulas();
        });
}
