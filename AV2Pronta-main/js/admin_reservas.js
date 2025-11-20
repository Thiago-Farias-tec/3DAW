function carregarReservas() {
    fetch("../php/listar_reservas.php")
        .then(r => r.json())
        .then(dados => {
            let html = "";

            dados.forEach(res => {
                html += `
    <tr>
        <td>${res.id}</td>
        <td>${res.nome_cliente}</td>
        <td>${res.email_cliente}</td>
        <td>${res.telefone_cliente}</td>
        <td>${res.nome_acomodacao}</td>
        <td>${res.data_inicio}</td>
        <td>${res.data_fim}</td>
        <td>R$ ${res.valor_total}</td>

        <td>${res.metodo_pagamento ?? ''}</td>
        <td>${res.parcelas ?? ''}</td>
        <td>${res.valor_parcela ?? ''}</td>

        <td>
            <a href="../php/editar_reserva.php?id=${res.id}" class="btn btn-warning btn-sm">Editar</a>
            <button class="btn btn-danger btn-sm" onclick="excluir(${res.id})">Excluir</button>
        </td>
    </tr>
`;

            });

            document.getElementById("listaReservas").innerHTML = html;
        });
}

carregarReservas();


function excluir(id) {
    if (!confirm("Tem certeza que deseja excluir esta reserva?")) return;

    fetch("../php/excluir_reserva.php?id=" + id)
        .then(r => r.text())
        .then(msg => {
            alert(msg);
            carregarReservas();
        });
}
