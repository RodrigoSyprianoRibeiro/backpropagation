<?php

class Letra
{
    public $nome;
    public $vetorCodigo;
    public $vetorSimbolo;
    public $vetorCodigoGrupo;

    public $codigosGrupos = array('A' => array(1, -1, -1, -1, -1, -1, -1),
                               'B' => array(-1, 1, -1, -1, -1, -1, -1),
                               'C' => array(-1, -1, 1, -1, -1, -1, -1),
                               'D' => array(-1, -1, -1, 1, -1, -1, -1),
                               'E' => array(-1, -1, -1, -1, 1, -1, -1),
                               'J' => array(-1, -1, -1, -1, -1, 1, -1),
                               'K' => array(-1, -1, -1, -1, -1, -1, 1));

    function converteSimboloParaCodigo() {
        foreach ($this->vetorSimbolo AS $simbolo) {
            $this->vetorCodigo[] = ($simbolo == '#') ? 1 : (($simbolo == '.') ? -1 : 0);
        }
    }

    function converteCodigoParaSimbolo() {
        foreach ($this->vetorCodigo AS $codigo) {
            $this->vetorSimbolo[] = ($codigo == 1) ? '#' : (($codigo == -1) ? '.' : '@');
        }
    }

    function setVetorCodigoGrupoPorNome() {
        $this->vetorCodigoGrupo = $this->codigosGrupos[$this->nome];
    }

    function getNomePorCodigoGrupo($vetorCodigoGrupo) {
        foreach ($vetorCodigoGrupo AS $indice => $codigo) {
            $vetorCodigoGrupo[$indice] = round($codigo);
        }
        foreach ($this->codigosGrupos AS $indice => $codigoGrupo) {
            if ($codigoGrupo == $vetorCodigoGrupo) {
                return $indice;
            }
        }
        return false;
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getVetorCodigo() {
        return $this->vetorCodigo;
    }

    function setVetorCodigo($vetorCodigo) {
        $this->vetorCodigo = $vetorCodigo;
    }

    function getVetorSimbolo() {
        return $this->vetorSimbolo;
    }

    function setVetorSimbolo($vetorSimbolo) {
        $this->vetorSimbolo = $vetorSimbolo;
    }

    function getVetorCodigoGrupo() {
      return $this->vetorCodigoGrupo;
    }

    function setVetorCodigoGrupo($vetorCodigoGrupo) {
      $this->vetorCodigoGrupo = $vetorCodigoGrupo;
    }
}