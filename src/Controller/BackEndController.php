<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Services;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BackEndController extends AbstractController
{
    /**
     * @Route("/back/Dashboard", name="back_end")
     */
    public function index()
    {
        return $this->render('back_end/Dashboard.html.twig', [
            'controller_name' => 'BackEndController1',
        ]);
    }

     /**
     * @Route("/back/Services/Add", name="ServiceAdd")
     */
    public function AddServices(Request $request,EntityManagerInterface $em)
    {
        $Add = false ;
        if($request->request->get('title') != null){
            $Service = new Services();
            $Service->setTitre($request->request->get('title'));
            $Service->setDecription($request->request->get('description'));
            $Service->setPrix($request->request->get('prix'));
            $Service->setDisponibilite(true);
            if($request->request->get('files') != null){
               
                foreach (explode(",",$request->request->get('files')) as $val) {
                    $media = new Media();
                    $Service->addMedium($media->setUrl($val));
                }
                
            }
            
            $em->persist($Service);
            $em->flush();
            $Add = true ;
        }
        
        return $this->render('back_end/Services.html.twig', [
            'controller_name' => 'BackEndController1',
            'Add' => $Add, 
        ]);
    }

     /**
     * @Route("/back/Services", name="ServiceShow")
     */
    public function ShowServices(ServicesRepository $Services)
    {
        $rep = $Services->findAll();
        return $this->render('back_end/Services/ShowServices.html.twig', [
            'controller_name' => 'BackEndController1',
            'Services'=> $rep,
        ]);
    }

           
}
