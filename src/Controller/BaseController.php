<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Subscription;
use App\Entity\Vote;
use App\Entity\VoteMode;
use App\Form\SubscriptionType;
use App\Form\VoteType;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BaseController extends AbstractController
{
    private $session;
    private $serializer;

    public function __construct(SessionInterface $session, SerializerInterface $serializer)
    {
        $this->session = $session;
        $this->serializer  = $serializer;
    }

    /**
     * @Route("/base/number")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('base/base.html.twig', [
            'number' => $number,
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function index():Response
    {
        return $this->render('base/home.html.twig', [
            
        ]);
    }
    /**
     * @Route("/subscribe", name="subscription")
     */
    public function subscribe(Request $request):Response
    {
        

        $subscriber = new Subscription();
        $form = $this->createForm(SubscriptionType::class,$subscriber);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
           // $subscriber->setUser();
           return $this->redirectToRoute('allmovies');
            

        }
        return $this->render('base/subscription.html.twig', [
            'subscriptionForm' => $form->createView(),
        ]);

    }
    /**
     * @Route("/plan",name="plan")
     */
    public function plan():Response
    {
        if ($this->isGranted('ROLE_USER') == false) {
            // show some error message, throw exception etc...
            return $this->redirectToRoute('app_register');
        }
        
        return $this->render('base/plan.html.twig',[]
        );
    }

    /**
     * @Route("/allmovies", name="allmovies")
     */
    public function list():Response
    {
        //die(var_dump($this->getUser()));
        return $this->render('base/list.html.twig',[]
        );
    }

    /**
     * @Route("watch", name="video")
     */
    public function video(Request $request):Response
    {
        $vote = new Vote();
        $form = $this->createForm(VoteType::class,$vote);

        $votemode = $this->getDoctrine()->getRepository(VoteMode::class)->findAll();
        $candidate = $this->getDoctrine()->getRepository(Candidate::class)->findAll();
        
        return $this->render('base/myhome.html.twig',["voteForm"=>$form->createView(), "votemode"=>$votemode, "candidate"=>$candidate]  
    );
    }
     /**
     * @Route("api/watch", name="apivideo")
     */
    public function apivideo(Request $request):Response
    {
        $vote = new Vote();
        $form = $this->createForm(VoteType::class,$vote);

        $votemode = $this->getDoctrine()->getRepository(VoteMode::class)->findAll();
        $candidate = $this->getDoctrine()->getRepository(Candidate::class)->findAll();
        
        return $this->render('base/myhome.html.twig',["voteForm"=>$form->createView(), "votemode"=>$votemode, "candidate"=>$candidate]  
    );
    }

    /**
     * @Route("/vote",name="vote")
     */
    public function vote(Request $request):Response
    {
        $successTxt = null;
        if($this->session->get("payOk"))
        {
            //insert vote to db
            $successTxt= "Paiement effectue avec succes";

        }
        $this->session->clear();
        $votemode = $this->getDoctrine()->getRepository(VoteMode::class)->findAll();
        $candidate = $this->getDoctrine()->getRepository(Candidate::class)->findAll();
        $candidateArray = array_chunk($candidate,5);
        return $this->render('base/vote.html.twig',["votemode"=>$votemode, "candidate"=>$candidate,
         "candidateArray"=>$candidateArray, "successTxt"=>$successTxt]);
    }

    /**
     * @Route("api/candidates",name="candidates")
     */
    public function apiCandidate(Request $request):Response
    {
                
        //$votemode = $this->getDoctrine()->getRepository(VoteMode::class)->findAll();
        $candidate = $this->getDoctrine()->getRepository(Candidate::class)->findAll();
        //$candidateArray = array_chunk($candidate,5);
        $json = $this->serializer ->serialize(
            $candidate,
            'json', null
        );
        
        return new Response($json);
    }

    /**
     * @Route("api/votemodes",name="votemodes")
     */
    public function apiVotemodes(Request $request):Response
    {
                
        //$votemode = $this->getDoctrine()->getRepository(VoteMode::class)->findAll();
        $votemode = $this->getDoctrine()->getRepository(VoteMode::class)->findAll();
        //$candidateArray = array_chunk($candidate,5);
        $json = $this->serializer ->serialize(
            $votemode,
            'json', null
        );
        return new Response($json);
    }
    
    /**
     * @Route("/artist/{id}", name="artist")
     */
    public function infoArtist(Request $request, int $id):Response{
        $artist = $this->getDoctrine()->getRepository(Candidate::class)->find($id);
        $votemode = $this->getDoctrine()->getRepository(VoteMode::class)->findAll();
        return $this->render('base/artist.html.twig',['artist'=>$artist,'votemode'=>$votemode]);
    }
    /**
     * @Route("/api/votejury",name="votejury")
     */
    public function voteJury(Request $request):Response{
        $txt = "test";

        if($request->getMethod() == "POST"){
            $data = json_decode($request->getContent(),true);
            $txt = "success";

        }

        return new Response($txt);
    }

}

