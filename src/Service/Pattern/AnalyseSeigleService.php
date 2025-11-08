<?php

declare(strict_types=1);

namespace App\Service\Pattern;

class AnalyseSeigleService implements AnalyseInterface
{
    public function analyser(): string
    {
        // Logique spécifique pour l'analyse du seigle
        return 'Résultat de l\'analyse du seigle';
    }

    public function supports(string $cereal): bool
    {
        return strtolower($cereal) === 'seigle';
    }
}
