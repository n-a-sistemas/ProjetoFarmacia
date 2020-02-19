<?php
    $login = false;
    $adm = false;
    if(isset($_SESSION['id'])){
        $login = true;
    }
    if(isset($_SESSION['adm'])){
        $adm = $_SESSION['adm'];
    }
?>
    <header>
        <div class="collapse" id="navbarHeader" style>
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-secondary">Farmácia</h4>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-secondary">Menu</h4>
                        <ul class="list-unstyled">
                            <?php if(!$login){ echo "<li><a class='text-secondary' href='https://projetofarmacia.000webhostapp.com/index.php'>Home</a></li>";} ?>

                            <?php if($login){ echo "<li><a class='text-secondary' href='https://projetofarmacia.000webhostapp.com/meuperfil.php'>Meu Perfil</a></li>";} ?>

                            <?php if(!$login){ echo "<li><a class='text-secondary' href='https://projetofarmacia.000webhostapp.com/cadastro.php'>Cadastro</a></li>";} ?>

                            <li><a class='text-secondary' href="https://projetofarmacia.000webhostapp.com/contato.php">Contato</a></li>

                            <?php if($adm){ echo "<li><a class='text-secondary' href='https://projetofarmacia.000webhostapp.com/contato_adm.php'>Contato ADM</a></li>";} ?>

                            <?php if($adm){ echo "<li><a class='text-secondary' href='https://projetofarmacia.000webhostapp.com/tabela_cadastrados.php'>Tabela de emails cadastrados</a></li>";} ?>
                            
                            <?php if($login){ echo "<li><a class='text-secondary' href='https://projetofarmacia.000webhostapp.com/PHP/sair.php'>Logout</a></li>";} ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark shadows-sm">
            <div class="container d-flex justify-content-between">
                <a href="index.php" class="navbar-brand d-flex align-items-center">
                    <img src="IMG/logo.svg" alt="logo" width="50" height="50" class="d-inline-block align-top">
                    <strong id="fmc">Fármacia</strong>
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