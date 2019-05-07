<?php
declare(strict_types=1);

class Calculatrice
{
    public function add(float $a, float $b): float
    {
        return $a + $b;
    }

    public function sub(float $a, float $b): float
    {
        return $a - $b;
    }

    public function mul(float $a, float $b): float
    {
        return $a * $b;
    }

    /**
     * @param float $a
     * @param float $b
     * @return float
     * @throws Exception
     */
    public function div(float $a, int $b): float
    {
        if ($b == 0) {
            throw new Exception('Division par 0');
        }
        return $a / $b;
    }

    public function avg(array $nb): float
    {
        return array_sum($nb) / count($nb);
    }

}