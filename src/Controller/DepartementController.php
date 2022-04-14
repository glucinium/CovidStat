<?php

namespace App\Controller;

use App\Service\CallApiService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DepartementController extends AbstractController
{
    /**
     * @Route("/departement/{department}", name="departement")
     */
    public function index(string $department, CallApiService $callApiService, ChartBuilderInterface $chartBuilder): Response
    {
        $label = [];
        $hosp = [];
        $rea = [];

        for ($i = 1; $i < 8; ++$i) {
            $date = new DateTime('- '.$i.' month');
            $datas = $callApiService->getDataByDepartmentByDate($department, $date->format('d-m-Y'));

            $label[] = $datas[0]['date'];
            $hosp[] = $datas[0]['hosp'];
            $rea[] = $datas[0]['rea'];
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
                'labels' => array_reverse($label),
                'datasets' => [
                    [
                        'label' => 'Nouvelles Hospitalisations',
                        'borderColor' => 'rgb(255, 99, 132)',
                        'data' => array_reverse($hosp),
                        'cubicInterpolationMode' => 'monotone',
                    ],
                    [
                        'label' => 'Nouvelles entrées en Réa',
                        'borderColor' => 'rgb(46, 41, 78)',
                        'data' => array_reverse($rea),
                        'cubicInterpolationMode' => 'monotone',
                    ],
                ],
            ]);

        //$chart->setOptions([/* ... */]);

        return $this->render('departement/index.html.twig', [
            'controller_name' => 'DepartementController',
            'data' => $callApiService->getDepartmentData($department),
            'chart' => $chart,
        ]);
    }
}
