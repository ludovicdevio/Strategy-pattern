<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\Pattern\AnalysePatternService;

final class DemoController extends AbstractController
{
    public function __construct(private readonly AnalysePatternService $analysePatternService)
    {
    }

    #[Route('/demo', name: 'app_demo')]
    public function index(): Response
    {
        $cereals= [
            'Ble',
            'Orge',
            'seigle',
            'Avoine',
            'Mais'
        ];
        //Les analyses de céréales sont en cours...
        $analyses =  [];

        foreach ($cereals as $cereal){
            try{
            $analyse = $this->analysePatternService->analyserCereal($cereal);
            $analyses[] = [
                'cereal' => $cereal,
                'result' => $analyse,
                'success' => true,
            ];

            } catch (\Exception $e) {
                $analyses[] = [
                    'cereal' => $cereal,
                    'result' => $e->getMessage(),
                    'success' => false,
                ];
            }
        }


        return $this->render('demo/index.html.twig', [
            'controller_name' => 'DemoController',
            'analyses' => $analyses,
        ]);
    }
}
