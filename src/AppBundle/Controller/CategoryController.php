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
     * @View(template="AppBundle:Category:show.html.twig")
     * @return Category
     */
    public function getCategoryAction(Category $entity):Category{
        return $entity;
    }

    /**
     * @return Response
     * @View(template="AppBundle:Category:index.html.twig")
     */
    public function getCategoriesAction(){
        return $this->getRepository()->findAll();
    }

    /**
     * @Get("/categories/menu")
     * @View(template="AppBundle:Category:menu.html.twig")
     */
    public function getMenuAction(){
        return $this->getRepository()->findAll();
    }

    /**
     * @param Category $link
     * @View()
     * @return Category
     */
    public function  deleteCategoryAction(Category $entity):Category {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }


    //TODO: manage correctly the status code
    /**
     * @param Category $entity
     * @return Category
     * @View(statusCode=200)
     * @ParamConverter("entity", converter="fos_rest.request_body", class="AppBundle\Entity\Category")
     *
     * @Post("/categories")
     */
    public function postCategoryAction(Category $entity):Category{
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        return $entity;
    }
}
