<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Transaction;
use App\Entity\Vote;
use App\Entity\VoteMode;
use Beelab\PaypalBundle\Paypal\Exception;
use Beelab\PaypalBundle\Paypal\Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PaymentController extends AbstractController
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    
    public function payment(Service $service, Request $request): Response
    {
        
        if($request->getMethod() == "POST")
        {
            if($request->get("mpage") !== null)
            { 
                $votemodeId= $request->get("voteid");
                $candidateId = $request->get("candid");


            }
            else{
                $rq = $request->get("vote");
            $votemodeId= $rq["numberOfVote"];
            $candidateId = $rq["candidate"];

            }
            
            $em = $this->getDoctrine()->getManager();
            $votemode = $this->getDoctrine()->getRepository(VoteMode::class)->find($votemodeId);
            $candidate = $this->getDoctrine()->getRepository(Candidate::class)->find($candidateId);
            $user = $this->getUser();
            //die($user);
            $subscription = $this->getDoctrine()->getRepository(Subscription::class)->findOneBy(["user"=>$user->getId()]);
            
            $vote = new Vote();
            $vote->setCandidate($candidate);
            $vote->setNumberOfVote($votemode->getQuantity());
            $vote->setSubscription($subscription);
            $em->persist($vote);
            $em->flush();

            //$votemode = 
            
            //die(print_r($request->get("vote")));
           

        //$amount = 100;  // get an amount, e.g. from your cart
        $transaction = new Transaction($votemode->getPrice());
        try {
                $response = $service->setTransaction($transaction, ['noShipping' => 1])->start();
                $this->getDoctrine()->getManager()->persist($transaction);
                $this->getDoctrine()->getManager()->flush();

                return $this->redirect($response->getRedirectUrl());
            } catch (Exception $e) {
                throw new HttpException(503, 'Payment error', $e);
            }
        }
    }

    public function canceledPayment(Request $request)
    {
        $token = $request->query->get('token');
        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->findOneBy(["token"=>$token]);
        if (null === $transaction) {
            throw $this->createNotFoundException(sprintf('Transaction with token %s not found.', $token));
        }
        $transaction->cancel(null);
        $this->getDoctrine()->getManager()->flush();

        return new Response(); // or a Response...
    }
    
    public function completedPayment(Service $service, Request $request)
    {
        $token = $request->query->get('token');
        $transaction = $this->getDoctrine()->getRepository(Transaction::class)->findOneBy(["token"=>$token]);
        if (null === $transaction) {
            throw $this->createNotFoundException(sprintf('Transaction with token %s not found.', $token));
        }
        $service->setTransaction($transaction)->complete();
        $this->getDoctrine()->getManager()->flush();
        if (!$transaction->isOk()) {
            return new Response(var_dump($transaction)); // or a Response (in case of error)
        }
        $this->session->set("payOk","ok");

        return $this->redirectToRoute("vote"); // or a Response (in case of success)
    }
    
}
