function carregarReservasExperiencias() {
    fetch("../php/listar_reservas_experiencias.php")
        .then(r => r.json())
        .then(lista => {
            let html = "";

            lista.forEach(r => {
                html += `
                    <tr>
                        <td>${r.id}</td>
                        <td>${r.nome_cliente}</td>
                        <td>${r.email_cliente}</td>
                        <td>${r.telefone_cliente}</td>
                        <td>${r.nome_experiencia}</td>
                        <td>${r.quantidade}</td>
                        <td>R$ ${r.valor_total}</td>
                        <td>
                            <a href="../php/editar_reserva_experiencia.php?id=${r.id}" class="btn btn-warning btn-sm">Editar</a>
                            <button class="btn btn-danger btn-sm" onclick="excluir(${r.id})">Excluir</button>
                        </td>
                    </tr>
                `;
            });

            document.getElementById("listaExperiencias").innerHTML = html;
        });
}

carregarReservasExperiencias();

function excluir(id) {
    if (!confirm("Deseja excluir esta reserva?")) return;

    fetch("../php/excluir_reserva_experiencia.php?id=" + id)
        .then(r => r.text())
        .then(msg => {
            alert(msg);
            carregarReservasExperiencias();
        });
}
