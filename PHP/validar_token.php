<?php
    include("conn.php");
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    $token = "";
    $email = "";
    if(isset($_POST['token'])){
        $token = $_POST['token'];
    }
    if(isset($_SESSION['email'])){
        $email = 'kaparecido483@gmail.com';
    }
    if($email != "" && $token != ""){
        $sql = "SELECT * FROM token WHERE email ='" . $email . "' AND token ='" . $token . "'";
        $resultado = $conn->query($sql);
        if($resultado->num_rows == 1){
            while($linha = $resultado->fetch_assoc()){
                $data_criacao = $linha['data_criacao'];
                $valido = $linha['valido'];
            }
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

            echo $ano . "-" . $ano_atual . "<br>";
            echo $mes . "-" . $mes_atual . "<br>";
            echo $dia . "-" . $dia_atual . "<br>";
            echo $horas . "-" . $horas_atual . "<br>";
            echo $minutos . "-" . $minutos_atual . "<br>";

            if($ano == $ano_atual){
                if($mes == $mes_atual){
                    if($dia != $dia_atual){
                        $validacao = false;
                        echo "3". "<br>";
                    }
                }
                else{
                    $validacao = false;
                    echo "2". "<br>";
                }
            }
            else{
                $validacao = false;
                echo "1". "<br>";
            }

            if($validacao){
                $min = $minutos + 30;
                if($min >= 60){
                    $horas++;
                    $min =- 60;
                }

                if($horas == $horas_atual){
                    echo $min. "<br>";
                    if($min <= $minutos_atual){
                        $validacao = false;
                        echo "5". "<br>";
                    }
                }
                else{
                    $validacao = false;
                    echo "4". "<br>";
                }
            }

            if($validacao){
                echo "True";
                $_SESSION['token'] = $token;
                header('Location: ../HTML/recuperar_senha.php');
            }
            else{
                echo "False";
            }

        }
    }
    else{
        echo "Envie um email e/ou token para prosseguir";
    }
?>