<?php

require_once 'Veiculo.php';
require_once 'VeiculoNaoEncontradoException.php';

/**
 * Classe: Locadora
 * Responsável: Kenttonny (RA 2026106090029)
 * Descrição: gerencia os veículos disponíveis para aluguel.
 */

class Locadora
{
    private array $veiculos = [];

    public function adicionarVeiculo(Veiculo $veiculo): void
    {
        $this->veiculos[] = $veiculo;
    }

    public function buscarPorPlaca(string $placa): Veiculo
    {
        foreach ($this->veiculos as $veiculo) {

            if ($veiculo->getPlaca() === $placa) {
                return $veiculo;
            }

        }

        throw new VeiculoNaoEncontradoException(
            "Veículo com placa {$placa} não encontrado."
        );
    }

    public function alugar(string $placa, int $dias): float
    {
        if ($dias > Veiculo::LIMITE_DIAS) {
            throw new Exception(
                "O limite máximo é de " . Veiculo::LIMITE_DIAS . " dias."
            );
        }

        $veiculo = $this->buscarPorPlaca($placa);

        if (!$veiculo->isDisponivel()) {
            throw new Exception("Veículo indisponível.");
        }

        $veiculo->setDisponivel(false);

        return $veiculo->calcularAluguel($dias);
    }
}

?>