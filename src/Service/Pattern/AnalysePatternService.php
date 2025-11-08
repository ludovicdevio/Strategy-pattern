<?php

declare(strict_types=1);

namespace App\Service\Pattern;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class AnalysePatternService
{
    public function __construct(
        #[AutowireIterator(tag: 'app.analyse')]
        private readonly iterable $analyseServices
    ) {

    }



    /**
     * Manager naïf qui distribue les tâches d'analyse en fonction de la céréale
     * Utilise des conditions if/elseif pour déterminer quel service appeler
     */
    public function analyserCereal(string $cereal): string
    {
        foreach ($this->analyseServices as $analyseService) {
            if ($analyseService->supports($cereal)) {
                return $analyseService->analyser();
            }
        }

        throw new \Exception('Céréale non supportée');

    }
}
