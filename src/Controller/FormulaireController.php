<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonFormType;
use App\Repository\PokemonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{
    /**
     * @Route ("/pokemon")
     */
    public function PokemonListe()
    {
        $pokemons = $this->getDoctrine()
            ->getRepository(Pokemon::class)
            ->findAll();

        return ($this->render('formulaire/pokemon.html.twig',
        [
            'pokemons' => $pokemons
        ]));
    }


    /**
     * @Route("/formulaire", name="formulairePost", methods={"POST"})
     */
    public function traitementFormulaire(Request $request): Response
    {
        $form = $this->createForm(PokemonFormType::class);
        $form->handleRequest($request);

        $data = $form->getData();

        $entityManager = $this->getDoctrine()->getManager();

        $pokemon = new Pokemon();
        $pokemon->setNom($data["Nom"]);
        $pokemon->setDescription($data["Description"]);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($pokemon);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

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
        $form = $this->createForm(PokemonFormType::class);

        return $this->render('formulaire/index.html.twig',
        [
            'controller_name' => 'FormulaireController',
            'monFormulaire' => $form->createView()
        ]);
    }
}
