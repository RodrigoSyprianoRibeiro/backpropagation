<?php

require_once('Arquivo.php');
require_once('Letra.php');

class Util
{
    public static function getLetrasTreinamento() {
        $listaLetras = array();
        foreach (self::getArquivos() as $arquivo) {
            $letra = new Letra();
            $letra->setNome(substr($arquivo->getNome(), 0, 1));
            $letra->setVetorSimbolo($arquivo->getConteudo());
            $letra->converteSimboloParaCodigo();
            $letra->setVetorCodigoGrupoPorNome();
            array_push($listaLetras, $letra);
        }
        return $listaLetras;
    }

    public static function getLetraReconhecimento($vetorSimbolo) {
        $letra = new Letra();
        $letra->setVetorSimbolo($vetorSimbolo);
        $letra->converteSimboloParaCodigo();
        return $letra;
    }

    public static function gerarLetraAleatoria() {
        $arquivos = self::getArquivos();
        $arquivo = $arquivos[array_rand($arquivos, 1)];
        return $arquivo->getConteudo();
    }

    public static function getLetraPorNome($letra) {
        $arquivos = self::getArquivos();
        foreach ($arquivos AS $arquivo) {
            echo "<pre>";
            print_r($arquivo->getNome());
            if ($arquivo->getNome() == $letra.".txt") {
                return $arquivo->getConteudo();
            }
        }
        return null;
    }

    public static function getArquivos() {

        $path = "../letras/";
        $diretorio = dir($path);

        $listaArquivos = array();
        $count = 0;

        while($arquivo = $diretorio->read()){

            if ($count >= 2) {
                $nome = "".$arquivo;
                $caminhoCompleto = $path.$arquivo;
                $arquivo = new Arquivo();
                $arquivo->setNome($nome);
                $arquivo->setCaminho($caminhoCompleto);
                $arquivo->setConteudo();
                array_push($listaArquivos, $arquivo);
            }
            $count++;
        }
        $diretorio -> close();

        return $listaArquivos;
    }
}