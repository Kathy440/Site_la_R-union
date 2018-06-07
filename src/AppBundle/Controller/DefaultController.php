<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, $email)
    {

        $this->get('security.authorization_checker')->isGranted("ROLE_ADMIN");
        $this->denyAccessUnlessGranted("ROLE_ADMIN",$this->getUser(),"Ceci est reserver au admin");

        /*@ var User $user */
        $user = $this->getUser();
        $user->hasRole("ROLE_ADMIN");

        $user= new User();


        $userManager = $this->get('fos_user.user_manager');
        $userManager->findUserByUserEmail($email);
        if(!$user){
            $user = $userManager->createUser();
        }
        $user->addRole("ROLE_ADMIN");



        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
