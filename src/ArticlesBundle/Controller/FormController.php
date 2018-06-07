<?php

namespace ArticlesBundle\Controller;

use ArticlesBundle\Entity\Formulaire;
use ArticlesBundle\Form\FormulaireType;
use ArticlesBundle\Form\PlagesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{

    public function removeIdAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $rep = $em->getRepository('ArticlesBundle:Formulaire');

        $person = $rep->find($id);

        $em->remove($person);
        $em->flush();

        return $this->redirectToRoute('articles_affiche_articles');
    }

    public function allArticlesAction() // tout afficher
    {
        $em = $this->getDoctrine()->getManager(); //em->entities manager recupere l'entity manager grace a doctrine sert d'intermediaire
        //represente la base de donnee

        $repAuteur = $em->getRepository("ArticlesBundle:Formulaire");
        //recupere le repo liée a l'antité Formulaire

        //grace a la methode findAll herite du Repo
        $articles = $repAuteur->findAll();

        return $this->render('@Articles/formulaire/formulaire.html.twig', array('articles' => $articles ));
    }



    public function addFormAction(Request $request)
    {
        //I use method getDoctrine which is in Controller and use method getManager and I sctock in variable
        $em = $this->getDoctrine()->getManager();

        //I create/intencie a new object Form and i stock in variable article
        $article = new Formulaire();

        // use method createForm who is in controller, who is in Entity Plages and
        // From the abstract representation I go create a form and place my variable article
        $form = $this->createForm(FormulaireType::class, $article);

        // If the used request uses the method Post
        if ($request->isMethod('Post')) {

            //He make the link between the variable of the type Post and our form
            $form->handleRequest($request);
            // and send the form to the request

            //if form is valid
            if ($form->isValid()) {
                // Gonna to prepare in unit work to send
                $em->persist($article);
                
                //Send request in DB
                $em->flush();

                return $this->redirectToRoute('articles_affiche_articles');
            }
        }
        //My variable form call methode createView and i stock in my variable with the table 
        $vars['form'] = $form->createView();
        //And i send my view
        return $this->render('@Articles/formulaire/ajoute_form.html.twig', $vars);
    }


    public function updateFormAction(Request $request, $id)
        //on appelle cette methode pour securiser /app_dev.php/document/form/update/1
    {
        //$id = $request->query->get('id'); //recupere l'id depuis l'url
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('ArticlesBundle:Formulaire');

        $person = $rep->find($id);

        $form = $this->createForm(FormulaireType::class, $person);

        //Si la requête utilisée utilise la méthode Post
        if ($request->isMethod('Post')) {

            //il fait le lien entre les variables de type POST et notre formulaire
            $form->handleRequest($request);
            // envoie le formulaire dans la requete

            //Il faut valider notre objet
            if ($form->isValid()) {
                //je prepare ma requete dans l'unité travail a etre envoyer
                $em->persist($person);
                //j'envoye ma requete a la base de donnée
                
                //Send request in DB
                $em->flush();

                return $this->redirectToRoute('articles_affiche_articles');
            }
        }
        $vars['form'] = $form->createView();
        return $this->render('@Articles/formulaire/modif_form.html.twig',$vars );
    }



    

}