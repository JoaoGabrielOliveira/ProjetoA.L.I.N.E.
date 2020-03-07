<?php
    $BancoDados = json_decode(file_get_contents("DB.json"), FALSE);
?>

<!DOCTYPE html>
<html lang="pt-br">
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

    <link rel="icon" type="image/png" href="img/icones/logo.png" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

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


</head>
<body onload="Iniciar(); document.getElementsByClassName('albuns')[0].style.display = 'block';">


    <input type="checkbox" id="checkch">

    <div id="Menu-flutuante">
        <ul class="Menu-lista">
            <li id="home">   <a title="Ir para inicio da pagina" href="#Inicio"><i class="fas fa-home"></i></a></li>
            <li id="sobre">  <a title="Ir para Sobre"            href="#Sobre"><i class="fas fa-portrait"></i></a></li>
            <li id="galeria"><a title="Ir para Galeria"          href="#Galeria"><i class="far fa-images"></i></a></li>
        </ul>
    </div>

    <div id="Menu">
        <div id="Menu-foto">
            <p><img src="img/perfil.jpg"></p>
            <p>Aline F. Peixinho</p>
            <p>Ilustradora e Desinger</p>
    </div>
        

        <ul class="Menu-lista">
            <li><a href="#Inicio"><i class="fas fa-home"></i>Inicio</a></li>
            <li><a href="#Sobre"  ><i style="margin-right: 18px;" class="fas fa-portrait"></i>Sobre</a></li>
            <li><a href="#Galeria"><i class="far fa-images"></i>Galeria</a></li>
        </ul>

        <p>
            <i class='fab fa-facebook-square'></i>
            <i class='fab fa-twitter'></i>
            <i class='fab fa-instagram'></i>
            <i class='fab fa-linkedin'></i>
        </p>
    </div>
    
    <main id="Principal">
        <div id="Inicio">
            <img onload="mudarImagem()" class="back" src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/48490c92520453.5e4d4be7c620b.jpg" alt="">
            <div id="msg">
                <h2>Olá mundo...</h2>
                <h1>Eu sou a Aline</h1>
            </div>

        </div>        

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
                <h2> <?php echo $Album->Titulo ?> </h2>
                </header>

                <div class="Galeria-Imagens">
                    <?php foreach($BancoDados->Galeria->Ilustracoes as $Ilustracao){ if($Ilustracao->Album == $Album->Codigo) {?>
                        <div onclick="SelecionarImagem('<?php echo $Ilustracao->Titulo ?>',
                        '<?php echo $Ilustracao->Data ?>',
                        '<?php echo $Ilustracao->Descricao ?>',
                        '<?php echo $Ilustracao->Imagem ?>')" class="Galeria-Imagens-item">
                        <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400_opt_1/<?php echo $Ilustracao->Imagem ?>" alt=""></div>
                    <?php } } ?> 
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