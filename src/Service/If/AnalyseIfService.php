<?php

declare(strict_types=1);

namespace App\Service\If;

class AnalyseIfService
{
    public function __construct(
        private readonly AnalyseBleService $analyseBleService,
        private readonly AnalyseOrgeService $analyseOrgeService,
        private readonly AnalyseSeigletService $analyseSeigletService,
        private readonly AnalyseAvoineService $analyseAvoineService
    ) {

    }

    /**
     * Manager naïf qui distribue les tâches d'analyse en fonction de la céréale
     * Utilise des conditions if/elseif pour déterminer quel service appeler
     */
    public function analyserCereal(string $cereal): string
    {
        $cerealLower = strtolower($cereal);

        if ($cerealLower === 'ble') {
            return $this->analyseBleService->analyser();
        } elseif ($cerealLower === 'orge') {
            return $this->analyseOrgeService->analyser();
        } elseif ($cerealLower === 'seigle') {
            return $this->analyseSeigletService->analyser();
        } elseif ($cerealLower === 'avoine') {
            return $this->analyseAvoineService->analyser();
        }

        throw new \Exception('Céréale non supportée : ' . $cereal);
    }
}
