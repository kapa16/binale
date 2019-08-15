<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contractors", name="contractors")
 * Class ContractorController
 * @package App\Controller
 */
class ContractorController extends AbstractController
{
    /**
     * @Route("/", name=".index")
     */
    public function index()
    {
        return $this->render('app/contractor/index.html.twig');

    }

    /**
     * @Route("/create", name=".create")
     */
    public function create()
    {
        return $this->render('app/contractor/create.html.twig');
    }
}