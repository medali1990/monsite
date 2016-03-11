<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace oc\platformBundle\Controller;

// N'oubliez pas ce use :
use oc\platformBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
 
  /*public function indexAction($page)
    {
    
    return $this->render('ocplatformBundle:Advert:index.html.twig',array('id'=>$page));
    }

  public function viewAction($id)
    {
    return $this->render('ocplatformBundle:Advert:view.html.twig',array('id'=>$id));
    }


  public function addAction(Request $request){
    $session = $request->getSession();
    $session->getFlashBag()->add('info','Annonce bien enregistrée');
    $session->getFlashBag()->add('info','oui oui elle est bien enregistrée');
    return $this->redirectToRoute('oc_platform_view',array('id'=>5));

  }*/
  public function indexAction($page){
    if($page<1){
      throw new NotFoundHttpException('page"'.$page.'"inexistante.');
    }
    // Notre liste d'annonce en dur
    $listAdverts = array(
      array(
        'title'   => 'Recherche développpeur Symfony2',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );
    return $this->render('ocplatformBundle:Advert:index.html.twig',array('listAdverts'=>$listAdverts));
  }

  public function viewAction($id){

    $repository = $this->getDoctrine()
      ->getManager()
      ->getRepository('ocplatformBundle:Advert')
    ;
      $advert = $repository->find($id);
      if(null == $advert){
          throw new NotFoundHttpException("l'annonce d'id ".$id." n'existe pas");
      }
    return $this->render('ocplatformBundle:Advert:view.html.twig',array('advert'=>$advert));
  }

public function addAction(Request $request)
{
  //creation de l'entité
    $advert = new Advert();
    $advert->setTitle("recherche developpeur symfony 2");
    $advert->setAuthor("Alexandre");
    $advert->setContent("nous recherchons un developpeur symfony 2 debutant");

    $em = $this->getDoctrine()->getManager();
    $em->persist($advert);
    $em->flush();

    if($request->isMethod('POST')){
        $request->getSession()->getFlashBag()->add('notice','Anonce bien enregistrée');
        return $this->redirect($this->generateUrl('ocplatform_view',array('id'=>$advert->getId())));

    }

  return $this->render('ocplatformBundle:Advert:add.html.twig');
}

public function editAction($id, Request $request)
{
  $advert = array(
      'title'   => 'Recherche développpeur Symfony2',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );

  return $this->render('ocplatformBundle:Advert:edit.html.twig',array('advert'=>$advert));
}

public function deleteAction($id)
{
  // Ici, on récupérera l'annonce correspondant à $id

  // Ici, on gérera la suppression de l'annonce en question

  return $this->render('ocplatformBundle:Advert:delete.html.twig');
}

 public function menuAction($limit)
  {
    // On fixe en dur une liste ici, bien entendu par la suite
    // on la récupérera depuis la BDD !
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('ocplatformBundle:Advert:menu.html.twig', array(
      // Tout l'intérêt est ici : le contrôleur passe
      // les variables nécessaires au template !
      'listAdverts' => $listAdverts
    ));
  }

}