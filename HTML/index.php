<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="JS/login.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/estilos.css" />
</head>

<body>
    <header>
        <div class="collapse" id="navbarHeader" style>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-secondary">Farmácia</h4>
                        <p class="text-muted">#</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-secondary">Menu</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="index.php" class="text-secondary">Pagina inicial</a>
                            </li>
                            <li>
                                <a href="contato.php" class="text-secondary">Contato</a>
                            </li>
                            <li>
                                <a href="cadastro.php" class="text-secondary">Cadastro</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark shadows-sm">
            <div class="container d-flex justify-content-between">
                <a href="index.php" class="navbar-brand d-flex align-items-center">
                    <img src="IMG/logo.svg" alt="logo" width="50" height="50" class="d-inline-block align-top">
                    <strong>Fármacia</strong>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false"
                    aria-label="Toggle navigation" id="menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="navbar navbar-dark shadows-sm" id="borda">
            <div class="container d-flex justify-content-between"></div>
        </div>
    </header>
    <div class="container d-flex justify-content-center w-25 mt-5">
        <div class="row">
            <main>
                <div class="d-flex justify-content-center h-100" >
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Login</h3>
                        </div>
                        <div class="card-body">
                            <form action="../PHP/logar.php" method="post"onsubmit="return validaLogin();">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                        required>

                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Senha" name="senha"
                                        id="senha" required>
                                    <button type="button" id="btn">Mostrar senha</button>
                                </div>
                                <div class="row align-items-center remember">
                                    <input type="checkbox">Lembre de mim
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="logar" class="btn float-right">Logar</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                <a href="#">Redefina sua senha</a>
                            </div>
                            <div class="d-flex justify-content-center links">
                                Não é Cadastrado?<a href="cadastro.php">Cadastre-se</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>