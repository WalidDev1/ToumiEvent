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
     * @Route("/back/Services/Add{id}", name="ServiceUpdate")
     * @Route("/back/Services/Add", name="ServiceAdd")
     */
    public function AddServices(Request $request,EntityManagerInterface $em , $id = null)
    {
        $Add = false ;
        $Update = false ;
        $Service = new Services();
        
        if($request->request->all()){
            // pour une modification d'un service deja existant
            if($request->request->get('id')){
                function VerifID(Media $a,$b)
                {
                if ($a->getId()===$b)
                  {
                  return 0;
                  }
                  return ($a>$b)?1:-1;
                }
                $Update = true ;
                $Service =  $this->getDoctrine()
                ->getRepository(Services::class)
                ->find($request->request->get('id'));

                $Liste_id = [] ;
                foreach ($Service->getMedia() as $item ) {
                    array_push($Liste_id , $item->getId());
                }
                $liste_Image_Remove = array_diff($Liste_id,$request->request->get('id_File'));
                foreach ($liste_Image_Remove  as $item){
                    $Service->removeMedium(
                        $this->getDoctrine()
                        ->getRepository(Media::class)
                        ->find($item));
                }
            }
            $Service->setTitre($request->request->get('title'));
            $Service->setDecription($request->request->get('description'));
            $Service->setPrix($request->request->get('prix'));
            $Service->setDisponibilite(true);
            if($request->files->get('pro-image') != null){
                    foreach($request->files->get('pro-image') as $item){
                     $media = new Media();
                     $file = md5(uniqid()).'.'.$item->getClientOriginalExtension();
                     $item->move(
                         $this->getParameter('images_directory'),
                         $file
                     );
                    
                        $media->setUrl('/mediaUploaded/'.$file.'(image)');
                     
                     $Service->addMedium($media);
                    }
            }
            $em->persist($Service);
            $em->flush();
            $Add = true ;
        }

         if($id != null){

            $Service =  $this->getDoctrine()
            ->getRepository(Services::class)
            ->find($id);
        
        }
        
      
        return $this->render('back_end/Services/Services.html.twig', [
            'controller_name' => 'BackEndController1',
            'Add' => $Add,
            'Service' => $Service ,
            'Update' => $Update
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

    /**
     * @Route("/back/RemoveServices/{id}", name="DeleteServices")
     */
    public function DeleteServices(ServicesRepository $Services ,$id , EntityManagerInterface $em)
    {
        
           $ServiceFind =  $this->getDoctrine()
           ->getRepository(Services::class)->find($id);
           
           $em->remove($ServiceFind);
           $em->flush();
           
      
        $rep = $Services->findAll();
        return $this->render('back_end/Services/ShowServices.html.twig', [
            'controller_name' => 'BackEndController1',
            'Services'=> $rep,
        ]);
    }
           
}
