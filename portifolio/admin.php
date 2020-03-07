<?php
    $BancoDadosOriginal = json_decode(file_get_contents("DB.json"), FALSE);
    $BancoDadosNovo = $BancoDadosOriginal;

    

    array_push($BancoDadosNovo->Galeria->Ilustracoes, );

    print_r($BancoDadosOriginal->Galeria->Ilustracoes[0]);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $Solicitacao = $_REQUEST['Solicitacao'];
        switch($Solicitacao){

            case "a001":
                $S_Texto = $_REQUEST['Sobre-TextoPrincipal'];
                if (empty($S_Texto)) {
                    echo "Texte area está vazio.";
                } else {                    
                    $BancoDadosNovo->Sobre->Texto_principal = $S_Texto;
                    $codigo;
                    $NovosDados =  json_encode($BancoDadosNovo);
                    try {
                        file_put_contents ("DB.json", $NovosDados);
                        $codigo = "<script>alert('Dados enviados com sucesso!');</script>";
                    }

                    catch(Exception $e){
                        $codigo = "<script>alert('Ocorreu um erro não esperado.');</script>";
                    }

                    finally {
                        echo $codigo;
                        $Solicitacao = "";
                        $_REQUEST['Sobre-TextoPrincipal'] = "";
                    }
                }
            break;

            case "a002":
                $S_Titulo = $_REQUEST['Sobre-Habilidade-Titulo'];
                $S_Nivel = $_REQUEST['Sobre-Habilidade-Nivel'];
                $S_Link = $_REQUEST['Sobre-Habilidade-Link'];
                $S_Texto = $_REQUEST['Sobre-Habilidade-Texto'];

               print_r($BancoDadosOriginal->Galeria->Ilustracoes);
            break;

        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina Administrativa</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">

    <style>
        #Sobre,#Ilustracoes {
            text-align: center;
        }

        #Sobre,#Ilustracoes form {
            padding:1%;
            margin: 5% 0;
        }

        #Sobre-Skills input[type=text], input[type=number], input[type=url] {
            width: 275px;
        }
          
        textarea {
            width: 80%;
            height: 150px;

            margin: 2% 10%;
            padding: 1%;

            resize:none;
            background: #f8f8f8;

            font-size: 100%;
            text-align: justify;
            text-indent: 5%;
            word-spacing: 0.1rem;
            line-height: 1.5rem;

        }

        input[type=submit], input[type=button] {
            border: none;
            padding: 1%;
            margin: 0% 3%;
            width: 20%;
        }

        input[type=submit].Positivo, input[type=button].Positivo {
            background-color: #4CAF50;
            border:5px solid #46a049;
        }

        input[type=submit].Positivo:hover, input[type=button].Positivo:hover {
            background-color: #46a049;
        }

        input[type=submit].Negativo, input[type=button].Negativo {background-color: #f44336; border:5px solid #da190b; }
        .Negativo:hover {background: #da190b;}

    </style>

    <script>
        var S_TextoPrincipal = "<?php echo $BancoDadosNovo->Sobre->Texto_principal; ?>";

        function Voltar(dado){
            switch(dado){
                case 0:
                    document.getElementById('Sobre-TextoPrincipal').value = S_TextoPrincipal;
                    document.getElementById('Sobre-TextoPrincipal').focus();
                break;
            }

        }

        function VerificarAlteracao(id){
            var Texto = document.getElementById(id);

            if( Texto.value != S_TextoPrincipal){
                Texto.style.border = "1px solid #f44336";
            }

            else {
                Texto.style.border = "1px solid #4CAF50";
            }
        }

        function MostrarImagem(){
            document.getElementById('Sobre-Imagem-Exibir').src = "https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/" + document.getElementById('Sobre-Habilidade-Link').value;
        }
    </script>
</head>
<body>

    <main id="Principal">
        <header>    
            <h1>Pagina Administrativa</h1>
        </header>

        <div id="Sobre">

            <form id="Sobre-Texto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2>Texto Principal</h2>
                <textarea onfocusout="VerificarAlteracao('Sobre-TextoPrincipal')" name="Sobre-TextoPrincipal" id="Sobre-TextoPrincipal">
                    <?php echo $BancoDadosOriginal->Sobre->Texto_principal; ?>
                </textarea>
                <input type="submit" value="Salvar" class="Positivo">
                <input type="button" value="Cancelar" onclick="Voltar(0)" class="Negativo">
                <input type="hidden" name="Solicitacao" value="a001">
            </form>


            <form id="Sobre-Skills" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2>Habilidades - Novo Skill</h2>
                
                <div>Titulo:<input name="Sobre-Habilidade-Titulo" type="text"> </div>
                <div>Nivel:<input name="Sobre-Habilidade-Nivel" type="number"> </div>
                <div>Link da Imagem:<input onfocusout="MostrarImagem()" name="Sobre-Habilidade-Link" type="url"> </div>
                <textarea name="Sobre-Habilidade-Texto" id="Sobre-Habilidade-new">
                    
                </textarea>

                <input type="submit" value="Salvar" class="Positivo">
                <input type="button" value="Cancelar" onclick="Voltar(0)" class="Negativo">
                <input type="hidden" name="Solicitacao" value="a002">
            </form>

            <!--
            <form style="border:1px solid black;"id="Sobre-Habilidades" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2>Habilidades</h2>

                <?php
                    foreach($BancoDadosOriginal->Sobre->Habilidades[0]->Softwares as $Software){
                ?>

                <div class="Skill"style="margin:2% 0;padding:3%;">
                    <p> Titulo:<input type="text" name="[softwares]" id="habilidade_titulo_<?php echo $Software->Codigo ?>" value="<?php echo $Software->Titulo ?>"> </p>
                    <p> Nivel:<input  type="number" name="[softwares]" id="habilidade_nivel_<?php echo $Software->Codigo ?>" value="<?php echo $Software->Nivel ?>"> </p>
                    <textarea  name="[softwares]" id="habilidade_texto_<?php echo $Software->Codigo ?>">
                        <?php echo $Software->Texto ?>
                    </textarea>

                <input type="submit" value="Salvar" class="Positivo">
                <input type="button" value="Cancelar" onclick="Voltar(0)" class="Negativo">
                <input type="hidden" name="Solicitacao" value="a002">
                    
                </div>

                <?php } ?>
            </form>
            -->
            
        </div>

        <div id="Ilustracoes"> 
            <form id="Sobre-Skills" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <h2>Adicionar Ilustração</h2>
                
                <div>Titulo:<input name="Sobre-Habilidade-Titulo" type="text"> </div>
                <div>Data:<input name="Sobre-Habilidade-Nivel" type="date"> </div>
                <div>Link da Imagem:<input onfocusout="MostrarImagem()" name="Sobre-Habilidade-Link" id="Sobre-Habilidade-Link" type="url"> </div>
                <img id="Sobre-Imagem-Exibir" width="200px" height="auto" src="" alt="">
                <textarea name="Sobre-Habilidade-Texto" id="Sobre-Habilidade-new">
                    
                </textarea>

                <input type="submit" value="Salvar" class="Positivo">
                <input type="button" value="Cancelar" onclick="Voltar(0)" class="Negativo">
                <input type="hidden" name="Solicitacao" value="a002">
            </form>
        </div>
    </main>

    <footer>
        <div>&copy; Direitos Autorais a Hyper, 2020</div>
        <div>Cedido a <b>Aline F. Peixinho </b></div>
        <div>Prezada amiga</div>
    </footer>
    
</body>
</html>