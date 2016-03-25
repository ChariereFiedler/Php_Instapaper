<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Form\NewLinkType;
use AppBundle\Repository\LinkRepository;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Patch;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Intl\Exception\NotImplementedException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class LinkController extends RestController
{

    /**
     * {@inheritdoc}
     */
    public function getTargetedClass():string{
        return "AppBundle:Link";
    }

    /**
     * Display a form view with Symfony form builder
     * @Get("/links/create", name="links_create")
     * @View(template="AppBundle:Link:new.html.twig", templateVar="form")
     * @return FormView
     *
     */
    public function createLinkAction()
    {
        return $this->createFormAndView(NewLinkType::class);
    }

    /**
     * Get a specific link
     * @param Link $link
     * @View(template="AppBundle:Link:show.html.twig")
     * @return Link
     */
    public function getLinkAction(Link $link):Link{
        return $link;
    }

    /**
     * Get all the links which are not archived
     * @View(template="AppBundle:Link:index.html.twig")
     * @return Link[]
     */
    public function getLinksAction(){
        return $this->getRepository()->findBy(array("archived" => false));
    }

    /**
     * Get all the liked links
     * @Get("/links/liked", name="get_liked_links")
     * @return Link[]
     * @View(template="AppBundle:Link:liked.html.twig")
     */
    public function getLikedLinksAction()
    {
        return $this->getRepository()->findBy(array("liked" => true));
    }

    /**
     * Get all the archived links
     * @Get("/links/archived", name="get_archived_links")
     * @View(template="AppBundle:Link:archive.html.twig")
     */
    public function getArchivedLinksAction()
    {
        return $this->getRepository()->findBy(array("archived" => true));
    }



    /**
     * Delete a specific Link
     * @param Link $link
     * @View()
     * @return Link the deleted link
     */
    public function  deleteLinkAction(Link $link):Link {
        $this->getEntityManager()->remove($link);
        $this->getEntityManager()->flush();

        return $link;
    }

    /** Currently not implemented because its requires a deep copy strategy
     * @param Link $link
     * @return Response
     * @View(statusCode=201, template="")
     */
    //TODO: the current copy function not working
    public function copyLinkAction(Link $link) {
        return new NotImplementedException();
        $view = null;

        if(is_null($link)) {
            return $this->handleView($this->view(null, Response::HTTP_BAD_REQUEST));
        }

        $new = $this->getEntityManager()->copy($link, false);
        $this->getEntityManager()->persist($new);
        $this->getEntityManager()->flush();

        return $new;
    }

    //TODO use correctly the constraints validation
    /**
     * @param Link $link
     * @param ConstraintViolationListInterface $validationErrors
     * @View(statusCode=200)
     * @ParamConverter("link", converter="fos_rest.request_body", class="AppBundle\Entity\Link")
     *
     * @Post("/links")
     * @return Link
     */
    public function postLinkAction(Link $link,  ConstraintViolationListInterface $validationErrors):Link{
            $this->getEntityManager()->persist($link);

            $builder = $this->get('link_builder');
            $builder->build($link);

            $this->getEntityManager()->flush();
        return $link;
    }


    //TODO refactor to implement a correct patch action
    /**
     *
     * @View(statusCode=200)
     * @ParamConverter("link", class="AppBundle:Link")
     * @ParamConverter("toUpdate", converter="fos_rest.request_body", class="AppBundle\Entity\Link")
     * @Patch("/links/{link}")
     */
    public function patchLinkAction(Link $link, Link $toUpdate):Link{
        $this->updateWith($link, $toUpdate);
        return $link;
    }

}
