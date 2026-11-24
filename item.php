<?php
/**
 * Classe: Item (abstrata)
 * Responsável: Rodrigo Trajano de Carvalho Júnior (RA 2026106090036)
 * Descrição: contrato comum de tudo que pode ser alugado na locadora.
 */
abstract class Item
{
    const LIMITE_DIAS = 30;          // constante com uso real (validada na Locadora)
    private static int $totalItens = 0; // membro estático: conta os itens criados

    private int $id;
    private string $nome;
    private float $diaria;
    private bool $disponivel = true;

    public function __construct(int $id, string $nome, float $diaria)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->diaria = $diaria;
        self::$totalItens++;
    }

    // Cada subclasse calcula do seu jeito (polimorfismo)
    abstract public function calcularAluguel(int $dias): float;

    public static function getTotalItens(): int
    {
        return self::$totalItens;
    }

    public function getId(): int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getDiaria(): float { return $this->diaria; }
    public function isDisponivel(): bool { return $this->disponivel; }
    public function setDisponivel(bool $disponivel): void { $this->disponivel = $disponivel; }
}
