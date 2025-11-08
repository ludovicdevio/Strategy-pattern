<?php

declare(strict_types=1);

namespace App\Service\Pattern;

class AnalyseAvoineService implements AnalyseInterface
{
    public function analyser(): string
    {
        // Logique spécifique pour l'analyse de l'avoine
        return 'Résultat de l\'analyse de l\'avoine';
    }

    public function supports(string $cereal): bool
    {
        return strtolower($cereal) === 'avoine';
    }


}
