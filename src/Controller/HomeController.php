<?php

namespace App\Controller;

use App\Service\SymfonyDocsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(HttpClientInterface $httpclient): Response
    {
        $docs = new SymfonyDocsService($httpclient);
        var_dump($docs->fetchGitHubInformation());

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
