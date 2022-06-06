/* Método para adicionar atividades na tabela de atividades */
$('#adicionar').click(function (e) {
    // variaveis com os inputs
    var nome_faixa = '<input type="text" name="nome_faixa[]" class="form-control" placeholder="Nome da Faixa">';
    var tempo_faixa = '<input type="text" name="duracao[]" class="form-control" placeholder="Tempo de duração">';
    var botaoDeletar = '<button type="button" name="btndeletar" class="btn btn-outline-danger  padding" style="white-space: nowrap;" ><i class="fas fa-trash-alt me-2"></i>Deletar</button>';

    var linhaTabela = '<tr><td>' + nome_faixa + '</td><td>' + tempo_faixa + '</td><td>' + botaoDeletar + '</td></tr>';
    // adicionando linha a tabela
    $("#tabela_faixas").append(linhaTabela);
});

/* metodo para remover atividades na tabela de atividades */
$("#tabela_faixas").on('click', 'button[name="btndeletar"]', function () {
    $(this).closest('tr').remove();
});

/*---------------------------------------------*/
/* Método para adicionar atividades na tabela de atividades */
$('#adicionar2').click(function (e) {
    console.log('estams aqui');
    // variaveis com os inputs
    var nome_faixa = '<input type="text" name="nome_faixa[]" class="form-control" placeholder="Nome da Faixa">';
    var tempo_faixa = '<input type="text" name="duracao[]" class="form-control" placeholder="Tempo de duração">';
    var botaoDeletar = '<button type="button" name="btndeletar" class="btn btn-outline-danger  padding" style="white-space: nowrap;" ><i class="fas fa-trash-alt me-2"></i>Deletar</button>';

    var linhaTabela = '<tr><td>' + nome_faixa + '</td><td>' + tempo_faixa + '</td><td>' + botaoDeletar + '</td></tr>';
    // adicionando linha a tabela
    $("#tabela_faixas2").append(linhaTabela);
});

/* metodo para remover atividades na tabela de atividades */
$("#tabela_faixas2").on('click', 'button[name="btndeletar"]', function () {
    $(this).closest('tr').remove();
});

function mostrar_modal() {
    let minha_modal = new bootstrap.Modal(document.getElementById("minha_caixa")).show();
}
function mostrar_modal2(id) {
    let minha_modal2 = new bootstrap.Modal(document.getElementById("minha_caixa2")).show();
    console.log(id);
    $('#id_album').val(id);
}
$('#botaopesquisar').click(function (e) {
    var valor_input = $(id_input_pesquisar).val();
    if (valor_input == '') {
        var retorno = null;
        $.ajax({
            url: "/pesquisar",
            type: "POST",
            data: {
                "_token": $('#csrf-token')[0].content,
            },
            dataType: "json",
            beforeSend: function () {
                retorno = null;
            },
            success: function (response) {
                retorno = response;
                console.log(retorno);
                //Código para carregar a tabela vai ser aqui
                //código pra limpar a tabela
                var containerPesquisa = $('.div_lista_resultados');
                containerPesquisa.empty();
                for (i = 0; i < retorno.albuns.length; i++) {
                    faixas = '';
                    album = ' <span class="fw-bolder">Álbum: ' + retorno.albuns[i].nome + ', ' + retorno.albuns[i].ano + '</span><button type="button" class="btn btn-secondary" onclick="mostrar_modal2(' + retorno.albuns[i].id + ') " style="float: right;"><i class="fa-solid fa-pen-to-square"></i></button><table><thead><tr><td width="8%">Nº</td><td width="100%">Faixa</td><td>Duração</td></tr></thead><tbody>'
                    
                    for (j = 0; j < retorno.faixas.length; j++) {
                        if (retorno.albuns[i].id == retorno.faixas[j].album_id) {
                            faixas += '<tr><td>' + retorno.faixas[j].id + '</td><td>' + retorno.faixas[j].nome + '</td><td>' + retorno.faixas[j].duracao + '</td></tr>';
                        }
                    }
                    finaltabela = '</tbody></table>'
                    albumFaixas = album + faixas + finaltabela;

                    containerPesquisa.append(albumFaixas);
                }

            },
            error: function (response) {

            },
            complete: function () {

            },
        });
    } else {
        var retorno = null;
        $.ajax({
            url: "/buscarAlbum",
            type: "POST",
            data: {
                "_token": $('#csrf-token')[0].content,
                'input_pequisa': valor_input
            },
            dataType: "json",
            beforeSend: function () {
                retorno = null;
            },
            success: function (response) {
                retorno = response;
                console.log(retorno);

                var containerPesquisa = $('.div_lista_resultados');
                containerPesquisa.empty();

                for (i = 0; i < 1; i++) {
                    faixas = '';
                    album = ' <span class="fw-bolder">Álbum: ' + retorno.albuns.nome + ', ' + retorno.albuns.ano + '</span><button type="button" class="btn btn-secondary" onclick="mostrar_modal2('+retorno.albuns.id+')" style="float: right;"><i class="fa-solid fa-pen-to-square"></i></button><table><thead><tr><td width="8%">Nº</td><td width="100%">Faixa</td><td>Duração</td></tr></thead><tbody>'

                    for (j = 0; j < retorno.faixas.length; j++) {
                        if (retorno.albuns.id == retorno.faixas[j].album_id) {
                            faixas += '<tr><td>' + retorno.faixas[j].id + '</td><td>' + retorno.faixas[j].nome + '</td><td>' + retorno.faixas[j].duracao + '</td></tr>';
                        }
                    }

                    finaltabela = '</tbody></table>'
                    albumFaixas = album + faixas + finaltabela;
                    containerPesquisa.append(albumFaixas);
                }


            },
            error: function (response) {

            },
            complete: function () {

            },
        });
    }
})

