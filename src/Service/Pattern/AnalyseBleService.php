<?php

declare(strict_types=1);

namespace App\Service\Pattern;

class AnalyseBleService implements AnalyseInterface
{
    public function analyser(): string
    {
        // Logique spécifique pour l'analyse du blé
        return 'Résultat de l\'analyse du blé';
    }

    public function supports(string $cereal): bool
    {
        return strtolower($cereal) === 'ble';
    }
}
