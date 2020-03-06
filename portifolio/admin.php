<?php
    require_once 'classe.php';

    $BancoDados = json_decode(file_get_contents("DB.json"), FALSE);
    $Galeria_Album = 0;

    $Imagem_Nome = "";
    $Imagem_Data = "";
    $Imagem_Texto = "";
    $Imagem_IMG = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aline e seu Fantastico Presente de Aniversário    </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="inicio.css">
    <link rel="stylesheet" href="galeria.css">
    <link rel="stylesheet" href="sobre.css">
    <link rel="stylesheet" href="menu.css">
    <script> 
        function mudarImagem(){
            var Imagem = "https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/4bc29492520453.5e4d4be7c884f.jpg";
            /*
            setInterval(function(){
                document.getElementsByClassName('back')[0].src = Imagem;
                }, 3000);
            */
        }

        function MostrarMenu(){
            document.getElementById('Menu-flutuante').style.opacity = 1;
            
            setTimeout(function(){ document.getElementById('Menu-flutuante').style.opacity = 0; }, 3000);
        }
        
        function Iniciar(){
            var Albuns = document.getElementsByClassName('albuns');

            for (let i = 0; i < Albuns.length; i++) {
                Albuns[i].style.display = "none";
            }
        }

        function SelecionarAlbum(album){
            Iniciar();
            document.getElementsByClassName('albuns')[album].style.display = "block";
        }

        function SelecionarImagem(titulo,data,texto,url){
            var lightbox = document.getElementById('lightbox');
            lightbox.style.opacity = 1;
            lightbox.style.zIndex = 3;

            document.getElementById('imagem-titulo').innerText = titulo;
            document.getElementById('imagem-data').innerText = data;
            document.getElementById('imagem-texto').innerText = texto;

            document.getElementById('Galeria-Imagem').src = "https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/" + url ;
            

            document.querySelector("html").style.overflowY = "hidden";
        }

        function SairImagem(){
            document.getElementById('lightbox').style.opacity = 0;
            document.getElementById('lightbox').style.zIndex = -1;

            document.querySelector("html").style.overflowY = "auto";
        }
    </script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>
<body onload="Iniciar(); document.getElementsByClassName('albuns')[0].style.display = 'block';">

    <main id="Principal">
        <div style="margin-top: 5vh;" id="Sobre">
            <header>
                <h1>Sobre</h1>
                <h2>Aline Peixinho</h2>
            </header>

            <section>
                <article>
                <?php echo $BancoDados->Sobre->Texto_principal; ?>
                </article>
            </section>

            <section>
                <?php
                    foreach ( $BancoDados->Sobre->Habilidades[1]->Outros_Textos as $Valor){
                        $Titulo = $Valor->Titulo;
                        $Texto = $Valor->Texto;
                ?>
                <h2><?php echo $Titulo ?></h2>
                <article>
                <?php echo $Texto ?>
                </article>
                <?php 
                }
                ?>
            </section>

            <section>
                <h2>Habilidades</h2> 
                
                <div class="grid">
                    <?php 
                        foreach ( $BancoDados->Sobre->Habilidades[0]->Softwares as $Valor){
                            $Titulo = $Valor->Titulo;
                            $Texto = $Valor->Texto;
                            $Nivel = $Valor->Nivel;
                            $Imagem = $Valor->Imagem;
                    ?>
                    <div class="caixa">
                        <div class="conteudo">
                            <img src="<?php echo $Imagem ?>" alt="">
                            <p><?php echo $Titulo ?></p>
                            <p><?php echo $Nivel ?>%</p>
                            <p style="text-align: justify;"><?php echo $Texto ?></p>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </section>                
        </div>

        <div id="Galeria">
            <header>
                <h1>Galeria</h1>
                <ul>
                    <?php
                        foreach($BancoDados->Galeria->Albuns as $Valor){
                            $Galeria_Album = $Valor->Codigo;
                            echo "<li onclick='SelecionarAlbum($Valor->Codigo)'>$Valor->Titulo</li>";
                        }
                    ?>
                    
                </ul>
            </header>
                
            <?php
                foreach($BancoDados->Galeria->Albuns as $Album){
            ?>
            <div class="albuns">
                <header>
                <h2>Ilustrações</h2>
                </header>   
                <div class="Galeria-Imagens">
                    <div onclick="SelecionarImagem('Teen Boo','10 de fevereiro de 2019','Um fan-art da personagem de Monstros SA (Monster Inc.)','4bc29492520453.5e4d4be7c884f.jpg')" class="Galeria-Imagens-item"><img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/4bc29492520453.5e4d4be7c884f.jpg" alt=""></div>
                </div>
            </div>

            <?php 
                }

            ?>

        </div>
    </main>

    <footer>
        <div>&copy; Direitos Autorais a Hyper, 2020</div>
        <div>Cedido a <b>Aline F. Peixinho </b></div>
        <div>Prezada amiga</div>
    </footer>

    <div id="lightbox">
        <span onclick="SairImagem()"><i class="fas fa-times-circle"></i></span>
        <img id="Galeria-Imagem" src="https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/2be73292516591.5e4d56fc2beb6.png" alt="">

        <ul>
            <li><h1 id="imagem-titulo">Teen Boo</h1></li>
            <li><h2 id="imagem-data">10 de Fevereiro de 2019</h2></li>
            <li><p id="imagem-texto"></p></li>
        </ul>
        
        
        

    </div>
    
</body>
</html>