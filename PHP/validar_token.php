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
        $email = $_SESSION['email'];
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
            echo $data_criacao . "<br>";
            echo $valido . "<br>";
            list($ano, $mes, $dia) = explode("-", $data_criacao);
            list($dia, $tempo_criacao) = explode(" ", $dia);
            list($horas, $minutos, $segundos) = explode(":", $tempo_criacao);
            echo "$ano $mes $dia - $horas $minutos $segundos";

            //Separando em variaveis a data atual
            $hoje = date("Y m d H i s");
            echo $hoje;
            list($ano_t, $mes_t, $dia_t, $horas_t, $minutos_t, $segundos_t) = explode(" ", $hoje);

            if($ano == $ano_t){
                if($mes == $mes_t){
                    if($dia != $dia_t){
                        $validacao = false;
                    }
                }
                else{
                    $validacao = false;
                }
            }
            else{
                $validacao = false;
            }

            if($validacao){
                $min = $minutos + 30;
                if($min >= 60){
                    $horas++;
                    $min =- 60;
                }

                if($horas == $horas_t){
                    if($min > $minutos_t){
                        $validacao = false;
                    }
                }
                else{
                    $validacao = false;
                }
            }

            echo $validacao;

        }
    }
    else{
        echo "Envie um email e/ou token para prosseguir";
    }
?>