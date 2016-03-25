<?php

namespace AppBundle\Controller;

use AppBundle\Repository\LinkRepository;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\FOSRestController;
use  \Doctrine\ORM\EntityRepository;
abstract class RestController extends FOSRestController
{

    protected $clazz;

    public function getTargetedClass():string{
        return "";
    }
    protected function getEntityManager():EntityManager {
        return $this->getDoctrine()->getManager();
    }

    protected function getRepository():EntityRepository {
        return $this->getEntityManager()->getRepository($this->getTargetedClass());
    }

    public function createFormAndView($clazz){
        $form = $this->createForm($clazz);
        return $form->createView();
    }


}
