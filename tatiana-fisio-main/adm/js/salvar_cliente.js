function salvarCliente() {
    const form = document.querySelector('#form-cliente');
    const formData = new FormData(form);

    fetch('../php/salvar_cliente.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(msg => {
        alert(msg);
        window.location.href = "clientes.html"; 
    })
    .catch(err => {
        alert("Erro ao salvar cliente: " + err);
    });
}
