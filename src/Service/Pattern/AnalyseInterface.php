<?php

declare(strict_types=1);

namespace App\Service\Pattern;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.analyse')]
interface AnalyseInterface
{
    public function analyser(): string;
    public function supports(string $cereal): bool;
}
