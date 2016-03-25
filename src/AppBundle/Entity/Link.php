<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Link
 *
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinkRepository")
 */
class Link
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @Assert\Uuid
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="Url", type="string", length=500)
     */
    private $url;

    /**
     * @var bool
     *
     * @ORM\Column(name="Readed", type="boolean", options={"default"=false})
     */
    private $readed=false;

    /**
     * @var bool
     *
     * @ORM\Column(name="Archived", type="boolean", options={"default"=false})
     */
    private $archived=false;

    /**
     * @var bool
     * @ORM\Column(name="Liked", type="boolean", options={"default"=false})
     */
    private $liked=false;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }




    /**
     * Set title
     *
     * @param string $title
     *
     * @return Link
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Link
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set link
     *
     * @param string $url
     *
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set readed
     *
     * @param boolean $readed
     *
     * @return Link
     */
    public function setReaded($readed)
    {
        $this->readed = $readed;

        return $this;
    }

    /**
     * Get readed
     *
     * @return bool
     */
    public function getReaded()
    {
        return $this->readed;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Link
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return bool
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set liked
     *
     * @param boolean $liked
     *
     * @return Link
     */
    public function setLiked($liked)
    {
        $this->liked = $liked;

        return $this;
    }

    /**
     * Get liked
     *
     * @return boolean
     */
    public function getLiked()
    {
        return $this->liked;
    }
}
