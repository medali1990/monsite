<?php

namespace oc\platformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ocplatformBundle:Default:index.html.twig', array('name' => $name));
    }
}
