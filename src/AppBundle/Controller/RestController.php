<?php

namespace AppBundle\Controller;

use AppBundle\Repository\LinkRepository;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\FOSRestController;
use  \Doctrine\ORM\EntityRepository;
abstract class RestController extends FOSRestController
{

    protected $clazz;


    /**
     * @return string the entity class targeted
     */
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

    //TODO: Externalize to a dedicated service, maybe a manager
    public function updateWith($origin, $partial){

        //TODO: Replace this reflection method with better solution respecting the encapsulation, Try maybe a custom converter
        $reflect = new \ReflectionClass($partial);
        $props = $reflect->getProperties();
        foreach($props as $prop){
            if($partial->{$prop->getName()} !== NULL) {
                $origin->{$prop->getName()} = $prop->getValue($partial);
            }
        }
        $this->getEntityManager()->persist($origin);
        $this->getEntityManager()->flush();
    }


}
