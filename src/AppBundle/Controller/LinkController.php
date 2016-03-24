<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Link;
use AppBundle\Repository\LinkRepository;
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class LinkController extends  FOSRestController
{

    private function getEntityManager():EntityManager {
        return $this->getDoctrine()->getManager();
    }
    private function getRepository(string $model = "AppBundle:Link"):LinkRepository {
        return $this->getEntityManager()->getRepository($model);
    }


    /**
     * @param Link $link
     * @View()
     * @return Link
     */
    public function getLinkAction(Link $link){
        return $link;
    }

    /**
     * @return Response
     * @View()
     */
    public function getLinksAction(){
        return  $this->getRepository()->findAll();
    }

    /**
     * @param Link $link
     * @return Response
     * @View(statusCode=201)
     *
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
    public function postLinkAction(Link $link,  ConstraintViolationListInterface $validationErrors){
        if(count($validationErrors) == 0) {
            $this->getEntityManager()->persist($link);
            $this->getEntityManager()->flush();
        } else {

        }
        return $link;
    }
}
