<?php

namespace App\Controller;

use App\Model\Contractor\UseCase\Create;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contractors", name="contractors")
 * Class ContractorController
 * @package App\Controller
 */
class ContractorController extends AbstractController
{

    private $errors;

    public function __construct(ErrorHandler $errors)
    {
        $this->errors = $errors;
    }

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
    public function create(Request $request, Create\Handler $handler)
    {
        $command = new Create\Command();

        $form = $this->createForm(Create\Form::class, $command, [
            'action' => $this->generateUrl('contractors.create')
        ]);
        $form->handleRequest($request);

        $submittedToken = $request->request->get('_token');

        if ($form->isSubmitted() && $form->isValid() && $this->isCsrfTokenValid('_token', $submittedToken)) {
            try {
                $handler->handle($command);
                return $this->redirectToRoute('contractors');
            } catch (\DomainException $e) {
                $this->errors->handle($e);
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->render('app/contractor/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}