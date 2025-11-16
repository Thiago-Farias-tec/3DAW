function carregarHorarios() {
    fetch('../php/listar_horarios.php')
        .then(res => res.text())
        .then(html => {
            document.querySelector('#tabela-horarios').innerHTML = html;
        })
        .catch(err => alert('Erro ao carregar horários: ' + err));
}

function excluirHorario(id) {
    if (confirm('Tem certeza que deseja excluir este horário?')) {
        fetch('../php/excluir_horario.php?id=' + id)
            .then(res => res.text())
            .then(msg => {
                alert(msg);
                carregarHorarios();
            })
            .catch(err => alert('Erro ao excluir: ' + err));
    }
}

window.onload = carregarHorarios;
