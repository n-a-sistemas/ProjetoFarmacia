<?php
    session_start();
    require('PHP/conn.php');
    unset($_SESSION["id_qrcode"]);
    $erro = "";
    $tipo = "";
    if(isset($_SESSION['erro_reset'])){
        $erro = $_SESSION['erro_reset'];
        $tipo = "erro_reset";
    }
    if(isset($_SESSION['erro_delete'])){
        $erro = $_SESSION['erro_delete'];
        $tipo = "erro_delete";
    }
    if(!isset($_SESSION['id'])){
        header('Location: index.php');
    }
    if($tipo != ""){
        $session = $tipo;   
    }
    $page = 'tabela_cadastrados.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de emails cadastrados</title>
    <script src="JS/jquery-3.4.1.min.js"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <script type="text/javascript" src="JS/confirmacao.js"></script>
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="CSS/estilos.css" />
    <link rel="icon" href="PHP/uploads/logo.png">
</head>

<body>
    <?php require("./parts/navegacao.php"); ?>

    <div class="container-fluid mt-5">
        <div class="row-fluid">
            <main>
                <div class="card">
                    <?php
                        if($erro != ""){
                            include("./parts/erro.php");
                        }
                    ?>
                    <div class="card-header text-center">
                        <h1>Tabela de todos email cadastrados</h1>
                    </div>
                    <div class="bg-white shadow rounded overflow-hidden">
                        <div class="px-4 pt-0 pb-4">
                            <div class="card-body">
                                <div>
                                    <select id="ativo">
                                        <option value="0">Mostrar emails desabilitados</option>
                                        <option value="1" selected >Mostrar emails ativos</option>
                                    </select>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th></th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Telefone</th>
                                                <th>Contato de Emergência</th>
                                                <th colspan="3"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="JS/tabela.js"></script>
</body>

</html>