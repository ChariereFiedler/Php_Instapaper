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
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class LinkController extends RestController
{

    public function getTargetedClass():string{
        return "AppBundle:Link";
    }

    /**
     * @Get("/links/create", name="links_create")
     * @View(template="AppBundle:Link:new.html.twig", templateVar="form")
     * @return Link
     *
     */
    public function createLinkAction()
    {
        return $this->createFormAndView(NewLinkType::class);
    }

    /**
     * @param Link $link
     * @View()
     * @return Link
     */
    public function getLinkAction(Link $link):Link{
        return $link;
    }

    /**
     * @return Response
     * @View(template="AppBundle:Link:index.html.twig")
     */
    public function getLinksAction(){
        return $this->getRepository()->findAll();
    }



    /**
     * @param Link $link
     * @View()
     * @return Link
     */
    public function  deleteLinkAction(Link $link):Link {
        $this->getEntityManager()->remove($link);
        $this->getEntityManager()->flush();

        return $link;
    }

    /**
     * @param Link $link
     * @return Response
     * @View(statusCode=201, template="")
     */
    //TODO: the current copy function not working
    public function copyLinkAction(Link $link) {
        $view = null;

        if(is_null($link)) {
            return $this->handleView($this->view(null, Response::HTTP_BAD_REQUEST));
        }

        $new = $this->getEntityManager()->copy($link, false);
        $this->getEntityManager()->persist($new);
        $this->getEntityManager()->flush();

        return $new;
    }

    //TODO: manage correctly the status code
    /**
     * @param Link $link
     * @param ConstraintViolationListInterface $validationErrors
     * @return Link
     * @internal param $C
     * @View(statusCode=200)
     * @ParamConverter("link", converter="fos_rest.request_body", class="AppBundle\Entity\Link")
     *
     * @Post("/links")
     */
    public function postLinkAction(Link $link,  ConstraintViolationListInterface $validationErrors):Link{
            $this->getEntityManager()->persist($link);
            $this->getEntityManager()->flush();
        return $link;
    }


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
