<?php

namespace App\Controller;

use App\Form\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulairePost", methods={"POST"})
     */
    public function traitementFormulaire(Request $request): Response
    {
        $form = $this->createForm(FormType::class);
        $form->handleRequest($request);

        $data = $form->getData();

        var_dump($data);
        die();

        return $this->render('formulaire/index.html.twig',
        [
            'controller_name' => 'FormulaireController',
            'monFormulaire' => $form->createView()
        ]);
    }

    /**
     * @Route("/formulaire", name="formulaire", methods={"GET"})
     */
    public function index(): Response
    {
        $form = $this->createForm(FormType::class);

        return $this->render('formulaire/index.html.twig',
        [
            'controller_name' => 'FormulaireController',
            'monFormulaire' => $form->createView()
        ]);
    }
}
