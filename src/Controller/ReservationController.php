<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation{id}?{idRes}", name="Action")
     * @Route("/reservation", name="reservation")
     */
    public function ShowReservation(Int $id = -1 ,Int $idRes = -1,Request $request, \Swift_Mailer $mailer, ReservationRepository $Reservation ,EntityManagerInterface $em )
    {
        if($id != -1 && $idRes != -1){
            $Res = $Reservation->findOneBy(['id' => $idRes]);
            if($id == 0){
                if($request->request->all()){
                $Res->setStatut(false);
                $message = (new \Swift_Message('Refus de resersavtion'))
                ->setFrom('walidsoussidev@gmail.com')
                ->setTo($Res->getClient()->getUser()->getEmail())
                ->setBody(
                    $this->renderView(
                        // templates/emails/RefusMail.html.twig
                        'emails/RefusMail.html.twig',
                        [
                        'Motif' => $request->request->get('Motif')
                        ]
                    ),
                    'text/html'
                );
            }
            }else{
                $Res->setStatut(true);
                $message = (new \Swift_Message('Resersavtion accepter'))
                ->setFrom('walidsoussidev@gmail.com')
                ->setTo($Res->getClient()->getUser()->getEmail())
                ->setBody(
                    $this->renderView(
                        // templates/emails/RefusMail.html.twig
                        'emails/ReservationValider.html.twig',
                        ['Services' => $Res->getEvenement()->getServices(),
                        'Reservation' => $Res
                        ]
                    ),
                    'text/html'
                );
            }
            $em->persist($Res);
            $em->flush();
            $mailer->send($message);
        }

        return $this->render('back_end/reservation/index.html.twig', [
            'controller_name' => 'Reservation',
            'Reservations' => $Reservation->findAll()
        ]);
    }

}
