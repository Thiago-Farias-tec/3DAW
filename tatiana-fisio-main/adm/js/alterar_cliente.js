
const params = new URLSearchParams(window.location.search);
const id = params.get("id");


function carregarCliente() {
    fetch("../php/carregar_cliente.php?id=" + id)
        .then(res => res.json())
        .then(cliente => {
            document.querySelector("#nome").value = cliente.nome;
            document.querySelector("#data").value = cliente.data;
            document.querySelector("#hora").value = cliente.hora;
        })
        .catch(err => alert("Erro ao carregar cliente: " + err));
}


function alterarCliente() {
    const form = document.querySelector("form");
    const dados = new FormData(form);
    dados.append("id", id); 

    fetch("../php/alterar_cliente.php", {
        method: "POST",
        body: dados
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        window.location.href = "clientes.html"; 
    })
    .catch(err => alert("Erro ao alterar cliente: " + err));
}

window.onload = carregarCliente;
