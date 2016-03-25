<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\NewCategoryType;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Patch;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class CategoryController extends RestController
{

    public function getTargetedClass():string{
        return "AppBundle:Category";
    }


    /**
     * @Get("/categories/create", name="categories_create")
     * @View(template="AppBundle:Category:new.html.twig", templateVar="form")
     * @return Category
     *
     */
    public function createCategoryAction()
    {
        return $this->createFormAndView(NewCategoryType::class);
    }

    /**
     * @param Category $Category
     * @View()
     * @return Category
     */
    public function getCategoryAction(Category $link):Category{
        return $link;
    }

    /**
     * @return Response
     * @View(template="AppBundle:Link:index.html.twig")
     */
    public function getCategoriesAction(){
        return $this->getRepository()->findAll();
    }



    /**
     * @param Category $link
     * @View()
     * @return Category
     */
    public function  deleteLinkAction(Category $link):Category {
        $this->getEntityManager()->remove($link);
        $this->getEntityManager()->flush();

        return $link;
    }


    //TODO: manage correctly the status code
    /**
     * @param Category $link
     * @param ConstraintViolationListInterface $validationErrors
     * @return Category
     * @internal param $C
     * @View(statusCode=200)
     * @ParamConverter("link", converter="fos_rest.request_body", class="AppBundle:Category")
     *
     * @Post("/categories")
     */
    public function postLinkAction(Category $link,  ConstraintViolationListInterface $validationErrors):Category{
        $this->getEntityManager()->persist($link);
        $this->getEntityManager()->flush();

        return $link;
    }


    /**
     *
     * @View(statusCode=200)
     * @ParamConverter("link", class="AppBundle:Category")
     * @ParamConverter("toUpdate", converter="fos_rest.request_body", class="AppBundle:Category")
     * @Patch("/links/{link}")
     */
    public function patchLinkAction(Category $link, Category $toUpdate):Category{

        //TODO: Replace this reflection method with better solution respecting the encapsulation
        // Try maybe a custom converter
        $reflect = new \ReflectionClass($toUpdate);
        $props = $reflect->getProperties();
        foreach($props as $prop){
            if($toUpdate->{$prop->getName()} !== NULL) {
                $link->{$prop->getName()} = $prop->getValue($toUpdate);
            }
        }
        $this->getEntityManager()->persist($link);
        $this->getEntityManager()->flush();
        return $link;
    }

}
