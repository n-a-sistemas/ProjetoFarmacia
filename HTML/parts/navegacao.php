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

<nav>
    <ul>
       <?php if(!$login){ echo "<li><a href='http://localhost:8080/ProjetoFarmacia/HTML/index.php'>Home</a></li>";} ?>

        <?php if($login){ echo "<li><a href='http://localhost:8080/ProjetoFarmacia/HTML/meuperfil.php'>Meu Perfil</a></li>";} ?>

        <?php if(!$login){ echo "<li><a href='http://localhost:8080/ProjetoFarmacia/HTML/cadastro.php'>Cadastro</a></li>";} ?>

        <li><a href="#">Contato</a></li>

        <?php //if($adm){ echo "<li><a href='http://localhost:8080/ProjetoFarmacia/HTML/" . "CONTATO ADM" . ">Contato ADM</a></li>";} ?>

        <?php if($login){ echo "<li><a href='http://localhost:8080/ProjetoFarmacia/PHP/sair.php'>Logout</a></li>";} ?>

        <?php //if($adm){ echo "<li><a href='http://localhost:8080/ProjetoFarmacia/HTML/" . "PENDENTES" . ">Pendentes</a></li>";} ?>
    </ul>
</nav>