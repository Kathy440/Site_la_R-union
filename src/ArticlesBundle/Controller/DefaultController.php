<?php

namespace ArticlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Articles/components/_page_accueil.htm.twig');
    }

    public function afficheAction()
    {
        $articles = $this->getDoctrine()->getManager(); //articles->entities manager recupere l'entity manager grace a doctrine sert d'intermediaire
        //represente la base de donnee

        $repArticles = $articles->getRepository("ArticlesBundle:cirques");
        //recupere le repo liée a l'antité Article

        //grace a la methode findAll herite du Repo
        $toutLesArticles = $repArticles->findAll();

        return $this->render('@Articles/components/cirques.html.twig', array('cirques' => $toutLesArticles ));
    }

    public function afficheVolcanAction()
    {
        $articles = $this->getDoctrine()->getManager(); 
        
        $repArticlesVolcan = $articles->getRepository("ArticlesBundle:Volcan");
        
        $toutLesArticles = $repArticlesVolcan->findAll();

        return $this->render('@Articles/components/volcans.html.twig', array('volcan' => $toutLesArticles ));
    }

    public function affichePlagesAction()
    {
        // I use method getDoctrine which is in Controller and I use method getManager and I stock in variable article
        $articles = $this->getDoctrine()->getManager();

        //Get back the ripository connected to the entity article and I stock in my variable repArticlesPlages
        $repArticlesPlages = $articles->getRepository("ArticlesBundle:Plages");

        //Thanks to the method findAll which the repository inherits
        $toutLesArticles = $repArticlesPlages->findAll();

        //then we return the view.I create a table where I call my variable
        return $this->render('@Articles/components/plages.html.twig', array('plages' => $toutLesArticles));

    }



}
