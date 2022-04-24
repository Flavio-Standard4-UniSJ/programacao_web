
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>api-climatempo</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">home</a></li>
                <li><a href="#">previsão do tempo</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
             <?php

                $token = "c2dae76c84d31907876458fd3492c7a7";
                $base_url = "http://apiadvisor.climatempo.com.br/";

                /*  registrar id da cidade no token do webmaster  */
                #$headers = ['Content-Type: application/x-www-form-urlencoded', 'localeId[]=5959'];
                #$url = $base_url."api-manager/user-token/".$token."/locales";
                
                if(isset($_POST['verificar'])){
                    /*  previsao disponivel no plano gratuito  */
                    $url = $base_url."/api/v1/anl/synoptic/locale/BR?token=".$token;

                    $ch = curl_init();

                    curl_setopt_array($ch, [
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_CUSTOMREQUEST => "GET"
                        #CURLOPT_HTTPHEADER => $headers
                    ]);

                    $retorno = json_decode(curl_exec($ch));

                    echo $retorno == null ? "A previsão do tempo ainda não está disponível!" : $retorno[0]->date."<br>".$retorno[0]->text;
                }else{
                    ?>
                        <h2>api climatempo</h2>
                        <p>saiba como está o tempo na sua cidade</p>
                        <form method="POST" action=""><p>
                            <button type="submit" name="verificar">verificar</button>
                        </form>  
                    <?php
                }

            ?>
        </section>    
    </main>    
</body>
</html>