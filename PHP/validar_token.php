<?php
    include("conn.php");
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    $token = "";
    $email = "";
    if(isset($_POST['token'])){
        $token = '14bcc269c9b4ede338b5dcce4ba5ad6e';
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
            list($ano_t, $mes_t, $dia_t, $horas_t, $minutos_t, $segundos_t) = explode(" ", $hoje);

            echo $ano . "-" . $ano_t . "<br>";
            echo $mes . "-" . $mes_t . "<br>";
            echo $dia . "-" . $dia_t . "<br>";
            echo $horas . "-" . $horas_t . "<br>";
            echo $minutos . "-" . $minutos_t . "<br>";

            if($ano == $ano_t){
                if($mes == $mes_t){
                    if($dia != $dia_t){
                        $validacao = false;
                        echo "1". "<br>";
                    }
                }
                else{
                    $validacao = false;
                    echo "2". "<br>";
                }
            }
            else{
                $validacao = false;
                echo "3". "<br>";
            }

            if($validacao){
                $min = $minutos + 30;
                if($min >= 60){
                    $horas++;
                    $min =- 60;
                }

                if($horas == $horas_t){
                    echo $min. "<br>";
                    if($min <= $minutos_t){
                        $validacao = false;
                        echo "4". "<br>";
                    }
                }
                else{
                    $validacao = false;
                    echo "5". "<br>";
                }
            }

            if($validacao){
                echo "True";
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