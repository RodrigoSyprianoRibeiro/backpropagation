<?php

class RedesNeurais
{
    public $geracaoAtual;
    public $quantidadeGeracoes; // Quantidade de vezes que vai efetuar o treinamento.
    public $taxaAprendizado; // 0 < $taxaAprendizado <= 1

    public $tamanhoVetorX; // Tamanho do vetor de entrada. (Vetor da letra)
    public $vetorX; // Vetor de entrada. (Letras)
    public $vetorT; // Vetor de saída esperado. (Grupo da letra)

    public $tamanhoVetorZ; // Tamanho do vetor intermediário.
    public $vetorZ_in; // Vetor intermediário de entrada. (Soma ponderada vetorX e matrizV)
    public $vetorZ; // Vetor intermediário de saída. (Valor do Z após passar pela função de ativação)

    public $tamanhoVetorY; // Tamanho do vetor de saída. (Letras esperadas na saída)
    public $vetorY_in; // Último vetor de entrada. (Soma ponderada vetorZ e matrizW)
    public $vetorY; // Último vetor de saída, com resultado final. (Valor do Y após passar pela função de ativação)

    public $vetorErroK; // Vetor que armazena diferença de erro, para ajuste de peso da matrizW.

    public $vetorErroJ_in; // Vetor que armazena diferença de erro com a soma ponderada.
    public $vetorErroJ; // Vetor que armazena diferença de erro, para ajuste de peso da matrizV.

    public $matrizV; // Matriz com os pesos. (Para a soma ponderada vetorX e matrizV)
    public $matrizVDelta; // Matriz com os pesos atualizados.

    public $matrizW; // Matriz com os pesos. (Para a soma ponderada vetorZ e matrizW)
    public $matrizWDelta; // Matriz com os pesos atualizados.

    function __construct($dados) {
        $this->geracaoAtual = 1;
        $this->quantidadeGeracoes = (int) ($dados['quantidade_geracoes'] - 1);
        $this->taxaAprendizado = (float) ($dados['taxa_aprendizagem'] / 100);

        $this->tamanhoVetorX = 63;
        $this->vetorX = array();
        $this->vetorT = array();

        $this->tamanhoVetorZ = (int) $dados['tamanho_vetor_intermediario'];
        $this->vetorZ_in = array();
        $this->vetorZ = array();

        $this->tamanhoVetorY = 7;
        $this->vetorY_in = array();
        $this->vetorY = array();

        $this->vetorErroK = array();

        $this->vetorErroJ_in = array();
        $this->vetorErroJ = array();

        $this->matrizV = array();
        $this->matrizVDelta = array();

        $this->matrizW = array();
        $this->matrizWDelta = array();
    }


    public function iniciarTreinamento($letrasTreinamento) {

        $this->matrizV = $this->iniciarMatriz($this->tamanhoVetorX, $this->tamanhoVetorZ);
        $this->matrizW = $this->iniciarMatriz($this->tamanhoVetorZ, $this->tamanhoVetorY);

        while ($this->quantidadeGeracoes > 0) {

            foreach ($letrasTreinamento AS $letra) {

                $this->vetorX = $letra->getVetorCodigo();
                $this->vetorT = $letra->getVetorCodigoGrupo();

                // Propagação
                $this->propagacao();

                // Retropropagação
                $this->retropropagacao();
            }
            $this->geracaoAtual++;
            $this->quantidadeGeracoes--;
        }
    }

    public function reconhecerLetra($letra) {

        $this->vetorX = $letra->getVetorCodigo();

        // Propagação
        $this->propagacao();

        // Resultado
        return $letra->getNomePorCodigoGrupo($this->vetorY);
    }

    public function propagacao() {
        $this->vetorZ_in = $this->somaPonderada($this->vetorX, $this->matrizV, $this->tamanhoVetorZ);
        $this->vetorZ = $this->funcaoAtivacao($this->vetorZ_in);
        $this->vetorY_in = $this->somaPonderada($this->vetorZ, $this->matrizW, $this->tamanhoVetorY);
        $this->vetorY = $this->funcaoAtivacao($this->vetorY_in);
    }

    public function retropropagacao() {
        $this->vetorErroK = $this->atualizarVetorErroK();
        $this->matrizWDelta = $this->guardarPesosAtualizados($this->vetorErroK, $this->vetorZ);

        $this->vetorErroJ_in = $this->somaPonderadaErro($this->vetorErroK, $this->matrizW, $this->tamanhoVetorZ);

        $this->vetorErroJ = $this->atualizarVetorErroJ();
        $this->matrizVDelta = $this->guardarPesosAtualizados($this->vetorErroJ, $this->vetorX);

        $this->matrizV = $this->atualizarMatriz($this->tamanhoVetorX, $this->tamanhoVetorZ, $this->matrizV, $this->matrizVDelta);
        $this->matrizW = $this->atualizarMatriz($this->tamanhoVetorZ, $this->tamanhoVetorY, $this->matrizW, $this->matrizWDelta);
    }

    public function iniciarMatriz($tamanhoVetor1, $tamanhoVetor2) {
        $matriz = array();
        for ($x = 0; $x < $tamanhoVetor1; $x++) {
            for ($y = 0; $y < $tamanhoVetor2; $y++) {
                $matriz[$x][$y] = $this->gerarPesosAleatorios();
            }
        }
        return $matriz;
    }

    public function atualizarMatriz($tamanhoVetor1, $tamanhoVetor2, $matriz, $matrizDelta) {
        $matrizNova = array();
        for ($x = 0; $x < $tamanhoVetor1; $x++) {
            for ($y = 0; $y < $tamanhoVetor2; $y++) {
                $matrizNova[$x][$y] = $matriz[$x][$y] + $matrizDelta[$x][$y];
            }
        }
        return $matrizNova;
    }

    public function somaPonderada($vetorEntrada, $matrizPesos, $tamanhoVetorSaida) {
        $vetorSaida = array();
        for ($j = 0; $j < $tamanhoVetorSaida; $j++) {
            $tamanhoVetorEntrada = count($vetorEntrada);
            $vetorSaida[$j] = 0;
            for ($i = 0; $i < $tamanhoVetorEntrada; $i++) {
                $vetorSaida[$j] += round($vetorEntrada[$i] * $matrizPesos[$i][$j], 4);
            }
        }
        return $vetorSaida;
    }

    public function somaPonderadaErro($vetorErro, $matrizPesos, $tamanhoVetorSaida) {
        $vetorSaida = array();
        for ($j = 0; $j < $tamanhoVetorSaida; $j++) {
            $tamanhoVetorErro = count($vetorErro);
            $vetorSaida[$j] = 0;
            for ($i = 0; $i < $tamanhoVetorErro; $i++) {
                $vetorSaida[$j] += round($vetorErro[$i] * $matrizPesos[$j][$i], 4);
            }
        }
        return $vetorSaida;
    }

    public function funcaoAtivacao($vetorEntrada) {
        $vetorSaida = array();
        $tamanhoVetorEntrada = count($vetorEntrada);
        for ($i = 0; $i < $tamanhoVetorEntrada; $i++) {
            $vetorSaida[$i] = $this->funcaoBipolar($vetorEntrada[$i]);
        }
        return $vetorSaida;
    }

    public function atualizarVetorErroK() {
        $vetorErro = array();
        $tamanhoVetorT = count($this->vetorT);
        for ($k = 0; $k < $tamanhoVetorT; $k++) {
            $vetorErro[$k] = round(($this->vetorT[$k] - $this->vetorY[$k]) * $this->funcaoBipolarLinha($this->vetorY[$k]), 4);
        }
        return $vetorErro;
    }

    public function atualizarVetorErroJ() {
        $vetorErro = array();
        $tamanhoVetorErro = count($this->vetorErroJ_in);
        for ($j = 0; $j < $tamanhoVetorErro; $j++) {
            $vetorErro[$j] = round($this->vetorErroJ_in[$j] * $this->funcaoBipolarLinha($this->vetorZ[$j]), 4);
        }
        return $vetorErro;
    }

    public function guardarPesosAtualizados($vetorErro, $vetorEntrada) {
        $matrizDelta = array();
        $tamanhoVetorEntrada = count($vetorEntrada);
        for ($j = 0; $j < $tamanhoVetorEntrada; $j++) {
            $tamanhoVetorErro = count($vetorErro);
            for ($i = 0; $i < $tamanhoVetorErro; $i++) {
                $matrizDelta[$j][$i] = round($this->taxaAprendizado * $vetorErro[$i] * $vetorEntrada[$j], 4);
            }
        }
        return $matrizDelta;
    }

    public function funcaoBipolar($x) {
      return round((2 / (1 + pow(2.718, -($x)))) -1, 4);
    }

    public function funcaoBipolarLinha($x) {
        return round(0.5 * ((1 + $x) * (1 - $x)), 4);
    }

    public function gerarPesosAleatorios() {
        $numero = (rand(1, 5) / 10);
        $numeroComSinal = rand(0, 1) ? $numero : $numero * (-1);
        return $numeroComSinal;
    }
}