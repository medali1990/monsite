<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace oc\platformBundle\Controller;

// N'oubliez pas ce use :
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
  public function viewAction($id){
    $content=$this->get('templating')->render('ocplatformBundle:Advert:view.html.twig',array('nom'=>$id));

 	return new Response($content);
  	//return new Response('salut '.$id);

  }

  public function viewSlugAction($nom,$prenom,$date){
  	return new Response("nom".$nom." et prenom".$prenom." et date de naissance ".$date);
  }


  public function indexAction()
  {
    $content = $this->get('templating')->render('ocplatformBundle:Advert:index.html.twig',array('nom' => 'med'));
    return new Response($content);
  }

  public function byeAction(){
  	$content = $this->get('templating')->render('ocplatformBundle:Advert:bye.html.twig',array('nom'=>'med'));
  	return new Response($content);
  }
}