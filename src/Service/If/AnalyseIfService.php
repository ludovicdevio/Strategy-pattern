<?php

declare(strict_types=1);

namespace App\Service\If;

class AnalyseIfService
{
    public function analyserCereal(string $cereal): string
    {
        if(strtolower($cereal) === 'ble') {
            return 'Résultat de l\'analyse du blé';
        }elseif (strtolower($cereal) === 'orge') {
            return 'Résultat de l\'analyse de l\'orge';
        }elseif (strtolower($cereal) === 'seigle') {
            return 'Résultat de l\'analyse du seigle';
        }

        throw new \Exception('Céréale non supportée.');
    }
}
