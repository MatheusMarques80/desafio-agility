<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Agility</title>
  </head>
  <body>
    <div class="container">
        <h1 id="titulo">Lista de usuários</h1>
        <div class="row">
            <div class="col col-2">
                <h5>Pesquisar por</h5>
            </div>
            <div class="col col-3">
                <input type="text" class="form-control" placeholder="Nome" aria-label="Nome" id="name">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Cliente" aria-label="Cliente" id="customer">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" placeholder="E-mail" aria-label="E-mail" id="email">
            </div>
            <div class="col-1">
                <button type="button" class="btn btn-primary" id="filtrarUsuarios">Buscar</button>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cliente</th>
                        <th>E-mail</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="dadosTabela"></tbody>
            </table>
        </div>
        <div class="d-flex align-items-center" class="loadingTable">
            <strong class="loadingTable">Carregando...</strong>
            <div class="spinner-border ms-auto loadingTable" role="status" aria-hidden="true"></div>
        </div>
    </div>
  </body>
</html>
<style>
    #titulo {
        margin-top: 5%;
        margin-bottom: 10%;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"
></script>
<script>
    $(document).ready(function () {
        function  getUsuarios () {
            $.ajax({
                method: "GET",
                url: "{{route('listaUsuarios')}}",
                data: {
                    name: $("#name").val(),
                    customer: $("#customer").val(),
                    email: $("#email").val()
                },
                beforeSend: function (data) {
                  $('#dadosTabela').html('');
                  $('.loadingTable').show();
                },
                success: function(data) {
                    $('.loadingTable').hide();
                },
            }).done(function( res ) {
                res.forEach(function (res, index) {
                    $('#dadosTabela').append(
                        "<tr class='" + (res.customer == 'Agility' ? 'table-info' : '') + "'>" +
                        "<td>" + res.name + "</td>" +
                        "<td>" + res.customer + "</td>" +
                        "<td>" + res.email + "</td>" +
                        "<td>" + (res.status == 1 ? 'Ativo' : 'Inativo') + "</td>" +
                        "</tr>"
                    );
                });
                $('.loadingTable').hide();
            });
        }

        getUsuarios();

        $("#filtrarUsuarios").click(function () {
            getUsuarios();
        })
    });
</script>