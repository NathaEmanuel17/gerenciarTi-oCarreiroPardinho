<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Meta com o token-->
    <meta name="csrf-token" id="csrf-token" content="{{csrf_token()}}">
    <title>Discografia - Tião Carreteiro e Participações</title>
    <link rel="stylesheet" href="{{url('assets/css/estilo.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <script src="https://kit.fontawesome.com/ae210c5265.js" crossorigin="anonymous"></script>
</head>

<body class="container">

    <section>
        <div>
            <div class="menu_logo">
                <img src="{{url('assets/images/logo.png')}}" class="logo" alt="">
                <h2 class="discografia">Discografia</h2>
            </div>

            <div class="div_fundo">
                <div class="container">
                    <p class="p_informa">Digite uma palavra chave</p>
                    {{-- <form action="{{route('pesquisar')}}" method="post"> --}}
                        <div class="row">
                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <input type="text" id="id_input_pesquisar" class="form-control rounded-pill"
                                        style="padding: 15px; border-color: white;">
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" id="botaopesquisar"
                                    class="btn btn-primary btn_tamanho rounded-pill"
                                    style="padding: 15px;">Procurar</button>
                            </div>
                        </div>
                        {{--
                    </form> --}}
                </div>

                <div class="div_lista_resultados scroller">

                </div>

                <button class="button_add" onclick="mostrar_modal()"><i class="material-icons icon">add</i></button>
            </div>
        </div>
    </section>

    <section>
        <div class="modal" tabindex="-1" id="minha_caixa" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Adicinar Álbum e Faxias</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        
                        
                        <!--inicio form-->
                        <form method="post" action="{{route('adicionar')}}">
                            @csrf
                            @if (isset($erro))
                                @foreach ($erro as $erro )
                                    <p>{{$erro}}</p>
                                @endforeach
                            @endif
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" id="nome_album" name="nome_album" class="form-control"
                                            placeholder="Nome do Álbum">

                                    </div>
                                    <div class="col">
                                        <input type="text" id="ano" name="ano" class="form-control"
                                            placeholder="Ano da album">
                                    </div>
                                </div>

                                <div class="bloco_botao">
                                    <button type="button" id="adicionar" class="btn btn-primary">Adicionar Nova
                                        Faixa
                                    </button>
                                </div>
                                <table class="table table-striped" id="tabela_faixas">
                                    <thead>
                                        <tr>
                                            <th scope="col">Faixa</th>
                                            <th scope="col">Duração</th>
                                            <th scope="col" class="">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" name="nome_faixa[]" class="form-control"
                                                    placeholder="Nome da Faixa">
                                            </td>

                                            <td>
                                                <input type="text" name="duracao[]" class="form-control"
                                                    placeholder="Tempo de duração">
                                            </td>

                                            <td>
                                                <button type="button" name="btndeletar" style="white-space: nowrap;"
                                                    class="btn btn-outline-danger padding">
                                                    <i class="fas fa-trash-alt me-2"></i>Deletar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <!--fim form-->
                    </div>
                </div>
            </div>
    </section>
    <!--fim modal 1-->

    <!--inicio modal 2-->
    <section>
        <div class="modal" tabindex="-1" id="minha_caixa2" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar faixas e remover albuns</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="">
                            <div class="d-none">
                                <input id="id_album">
                            </div>
                            <input type="text" class="form-control" placeholder="Nome do Álbum">
                            <div class="bloco_botao">
                                <button type="button" id="adicionar2" class="btn btn-primary">Adicionar Nova
                                    Faixa</button>
                            </div>
                            <table class="table table-striped" id="tabela_faixas2">
                                <thead>
                                    <tr>
                                        <th scope="col">Faixa</th>
                                        <th scope="col">Duração</th>
                                        <th scope="col" class="">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-none" id="id_album">'id'</td>
                                        <td><input type="text" name="nome_faixa[]" class="form-control"
                                                placeholder="Nome da Faixa"></td>
                                        <td><input type="text" name="duracao[]" class="form-control"
                                                placeholder="Tempo de duração"></td>
                                        <td>
                                            <button type="button" name="btndeletar" style="white-space: nowrap;"
                                                class="btn btn-outline-danger padding">
                                                <i class="fas fa-trash-alt me-2"></i>Deletar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" name="btndeletar" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-2"></i>Deletar Album
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--fim modal 2-->



    <script src="{{url('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('assets/js/script.js')}}"></script>
</body>

</html>