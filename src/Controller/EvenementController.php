<?php

namespace App\Controller;

use App\Entity\Date;
use App\Entity\Employer;
use App\Entity\Evenement;
use App\Entity\Services;
use App\Repository\EvenementRepository;
use App\Repository\ServicesRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    /**
     * @Route("/evenement/add{id}", name="EvenementUpdate")
     * @Route("/evenement/add", name="AddEvenement")
     */
    public function AddEvenement(Request $request,ServicesRepository $Services,EntityManagerInterface $em , $id = null)
    {      
        $Add = false ;
        $Update = false ;
        $Evenement = null;
        if($request->request->all()){
            $count = 0 ;
            $Evenement = new Evenement();
            // pour une modification d'un service deja existant
            if($request->request->get('id')){
                $Evenement = $this->getDoctrine()
                ->getRepository(Evenement::class)
                ->findOneBy(['id'=>$request->request->get('id')]);
                $Update = true ;
               foreach( $Evenement->getServices() as $Item){
                $Evenement->removeService(
                            $this->getDoctrine()
                            ->getRepository(Services::class)
                            ->find($Item));
               }
            }
            $Evenement->setTitre($request->request->get('title'));
            $Evenement->setAdresse($request->request->get('Adresse'));
            $Date = new Date();
            $Date->setCreatedAt(new DateTime(substr($request->request->get('dates'), 0 , 10)));
            $Date->setCreateAtEnd(new DateTime(substr($request->request->get('dates'), -10)));
            $Evenement->setDate($Date);
            //ajout des services
            
            for( $i = 0 ; $i <=  strlen($request->request->get('service')[0]) - 1 ; $i ++){
                if (substr($request->request->get('service')[0], $count , 2) == "" ||substr($request->request->get('service')[0], 0 , 2) == "")
                break;
                $Evenement->addService($Services->findOneBy(['id'=>substr($request->request->get('service')[0], $count , 2)]));
                $count +=3;
            }
            //$Evenement->addService($ListeService);
            $em->persist($Evenement);
            $em->flush();
            $Add = true ;
        }

        if($id != null){
            $Evenement = $this->getDoctrine()
            ->getRepository(Evenement::class)
            ->find($id);
        }
        return $this->render('back_end/evenement/AjoutEvenement.html.twig', [
            'controller_name' => 'EvenementController',
            'Evenement' => $Evenement,'Add' => $Add , 'Update' => $Update , 'Services' =>  $Services->findAll()
        ]);
    }

    /**
     * @Route("/evenement/delete/{id}", name="DeleteEvenement")
     */
    public function DeleteEvenement(EvenementRepository $Evenement , EntityManagerInterface $em , $id = null)
    {  $Remove = false ; 
        if($id != null){
            $EvenementR = $Evenement->findOneBy(['id'=>$id]);
            $em->remove($EvenementR);
            $em->flush();
            $Remove = true ;
        }
        return $this->render('back_end/evenement/ShowEvenement.html.twig', [
            'controller_name' => 'EvenementController',
            'Remove' => $Remove ,
            'Evenements' => $Evenement->findAll()
        ]);
    }

    /**
     * @Route("/evenement/show", name="ShowEvenement")
     */
    public function ShowEvenement(EvenementRepository $Evenement , EntityManagerInterface $em , $id = null)
    {  
        
        return $this->render('back_end/evenement/ShowEvenement.html.twig', [
            'controller_name' => 'EvenementController',
            'Remove' => false,
            'Evenements' => $Evenement->findAll()
        ]);
    }
}
