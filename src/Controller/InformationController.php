<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InformationController extends AbstractController
{
    /**
     * @Route("/information", name="app_information")
     */
    public function index(): Response
    {
        return $this->render('information/index.html.twig', [
            'controller_name' => 'InformationController',
        ]);
    }

    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function inscription(Request $request, EntityManagerInterface $manager) 
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $this->uploadFile($file, $utilisateur);

            $manager->persist($utilisateur);
            $manager->flush(); 
        }
        return $this->render('information/inscription.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @param File $file
     * @param object $object
     * @return object
     */
    public function uploadFile(File $file, object $object) : object
    {
        $filename = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('uploads'), $filename);
        $object->setImage($filename);

       return $object;
    }
}
