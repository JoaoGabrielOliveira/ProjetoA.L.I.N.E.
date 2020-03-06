<?php

//$BancoDados = json_decode(file_get_contents("DB.json"));


class Sobre {
    public function MostrarTextoPrincipal(){
        echo $BancoDados->Sobre->Texto_principal;
    }
}

class Galeria {
    public function MostrarIlustracoes(){

    }
}

?>