function carregarClientes() {
    fetch('../php/listar_clientes.php')
        .then(res => res.text())
        .then(html => {
            document.querySelector('#tabela-clientes').innerHTML = html;
        })
        .catch(err => {
            alert('Erro ao carregar clientes: ' + err);
        });
}

function excluirCliente(id) {
    if (confirm("Tem certeza que deseja excluir este cliente?")) {
        fetch('../php/excluir_cliente.php?id=' + id)
            .then(res => res.text())
            .then(msg => {
                alert(msg);
                carregarClientes(); 
            })
            .catch(err => alert("Erro ao excluir cliente: " + err));
    }
}

window.onload = carregarClientes;
