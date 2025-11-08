<?php

declare(strict_types=1);

namespace App\Service\Pattern;

class AnalyseOrgeService implements AnalyseInterface
{
    public function analyser(): string
    {
        // Logique spécifique pour l'analyse de l'orge
        return 'Résultat de l\'analyse de l\'orge';
    }

    public function supports(string $cereal): bool
    {
        return strtolower($cereal) === 'orge';
    }
}
