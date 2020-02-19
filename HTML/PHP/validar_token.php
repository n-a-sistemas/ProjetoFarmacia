<?php
    require("conn.php");
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    $token = "";
    $email = "";
    $retornar = false;

    if(isset($_POST['token'])){
        $token = $_POST['token'];
    }
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }
    if(isset($_GET['retornar'])){
        $retornar = $_GET['retornar'];
    }

    if(!$retornar && $email != "" && $token != ""){
        $sql = "SELECT * FROM token WHERE email ='" . $email . "' AND token ='" . $token . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $data_criacao = $linha['data_criacao'];
                $valido = $linha['valido'];
            }
            if($valido){
                $validacao = true;
                //Separando em variaveis a data que vem do token no banco
                //echo $data_criacao . "<br>";
                //echo $valido . "<br>";
                list($ano, $mes, $dia) = explode("-", $data_criacao);
                list($dia, $tempo_criacao) = explode(" ", $dia);
                list($horas, $minutos, $segundos) = explode(":", $tempo_criacao);
                //echo "$ano $mes $dia - $horas $minutos $segundos" . "<br>";

                //Separando em variaveis a data atual
                $hoje = date("Y m d H i s");
                //echo $hoje . "<br>";
                list($ano_atual, $mes_atual, $dia_atual, $horas_atual, $minutos_atual, $segundos_atual) = explode(" ", $hoje);

                //echo $ano_atual . "-" . $ano . "<br>";
                //echo $mes_atual . "-" . $mes . "<br>";
                //echo $dia_atual . "-" . $dia . "<br>";
                //echo $horas_atual . "-" . $horas . "<br>";
                //echo $minutos_atual . "-" . $minutos . "<br>";
                
                if($ano == $ano_atual){
                    if($mes == $mes_atual){
                        if($dia != $dia_atual){
                            $validacao = false;
                            //echo "3". "<br>";
                        }
                    }
                    else{
                        $validacao = false;
                        //echo "2". "<br>";
                    }
                }
                else{
                    $validacao = false;
                    //echo "1". "<br>";
                }

                if($validacao){
                    $min = $minutos + 30;
                    if($min >= 60){
                        $horas++;
                        $min -= 60;
                    }
                    //echo "<br>Horas:". $horas . ", Minutos:". $min ."<br>";
                    /*
                    if($horas >= $horas_atual){
                        echo $min. "<br>";
                        if($min >= $minutos_atual){
                            $validacao = false;
                            echo "5". "<br>";
                        }
                    }
                    */
                    if($horas_atual <= $horas){
                        //echo $min. "<br>";
                        if($minutos_atual >= $min){
                            $validacao = false;
                            //echo "5". "<br>";
                        }
                    }
                    else{
                        $validacao = false;
                        //echo "4". "<br>";
                    }
                }

                if($validacao){
                    $_SESSION['token'] = $token;
                    $_SESSION['erro_senha'] = "";
                }
                else{
                    $erro = "O token foi expirou, tente novamente";
                    $_SESSION['erro_senha'] = $erro;
                    $_SESSION['email'] = "";
                }
            }
            else{
                $erro = "O token não é mais valido, tente novamente";
                $_SESSION['erro_senha'] = $erro;
                $_SESSION['email'] = "";
            }
        }
        else{
            $erro = "Email e/ou token não cadastrados no sistema, tente novamente";
            $_SESSION['erro_senha'] = $erro;
        }
    }
    else if($retornar){
        $_SESSION['email'] = "";
        $_SESSION['erro_senha'] = "";
    }
    else{
        $erro = "Envie um email e/ou token para prosseguir";
        $_SESSION['erro_senha'] = $erro;
        $_SESSION['email'] = "";
    }
    header('Location: ../recuperar_senha.php');
?>