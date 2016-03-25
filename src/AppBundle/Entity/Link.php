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
     * @ORM\Column(name="id", type="guid")
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
     * @ORM\Column(name="Read", type="boolean", options={"default"=false})
     */
    private $read=false;

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
     * @var bool
     * @ORM\Column(name="Built", type="boolean", options={"default"=false})
     */
    private $built=false;


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
    public function setTitle(string $title):Link
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
    public function setContent(string $content):Link
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
    public function setUrl(string $url):Link
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getUrl():string
    {
        return $this->url;
    }

    /**
     * Set readed
     *
     * @param boolean $read
     *
     * @return Link
     */
    public function setRead(bool $read):Link
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get readed
     *
     * @return bool
     */
    public function isRead():bool
    {
        return $this->read;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     *
     * @return Link
     */
    public function setArchived(bool $archived):Link
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return bool
     */
    public function isArchived()
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
    public function setLiked(bool $liked):Link
    {
        $this->liked = $liked;

        return $this;
    }

    /**
     * Get liked
     *
     * @return boolean
     */
    public function isLiked()
    {
        return $this->liked;
    }

    /**
     * Set built
     *
     * @param boolean $built
     *
     * @return Link
     */
    public function setBuilt(bool $built):Link
    {
        $this->built = $built;

        return $this;
    }

    /**
     * Get built
     *
     * @return boolean
     */
    public function isBuilt():bool
    {
        return $this->built;
    }
}
