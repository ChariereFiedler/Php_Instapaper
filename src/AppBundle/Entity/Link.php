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
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255, nullable=true)
     */
    public $title;

    /**
     * @var string
     *
     * @ORM\Column(name="Content", type="text", nullable=true)
     */
    public $content;

    /**
     * @var string
     *
     * @ORM\Column(name="Resume", type="text", nullable=true)
     */
    private $resume;

    /**
     * @var string
     *
     * @ORM\Column(name="Url", type="string", length=500)
     */
    public $url;

    /**
     * @var string
     *
     * @ORM\Column(name="ImgUrl", type="string", length=500, options={"default"=""})
     */
    private $imgUrl="";

    /**
     * @var bool
     *
     * @ORM\Column(name="Read", type="boolean", options={"default"=false})
     */
    public $read=false;

    /**
     * @var bool
     *
     * @ORM\Column(name="Archived", type="boolean", options={"default"=false})
     */
    public $archived=false;

    /**
     * @var bool
     * @ORM\Column(name="Liked", type="boolean", options={"default"=false})
     */
    public $liked=false;

    /**
     * @var bool
     * @ORM\Column(name="Built", type="boolean", options={"default"=false})
     */
    public $built=false;

    /**
     * @var bool
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="links")
     */
    public $category;


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
     * Set resume
     *
     * @param string $resume
     *
     * @return Link
     */
    public function setResume(string $resume):Link
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get resume
     *
     * @return string
     */
    public function getResume()
    {
        return $this->resume;
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
     * Set imgUrl
     *
     * @param string imgUrl
     *
     * @return Link
     */
    public function setImgUrl(string $imgUrl):Link
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string
     */
    public function getImgUrl():string
    {
        return $this->imgUrl;
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

    /**
     * Get read
     *
     * @return boolean
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Get archived
     *
     * @return boolean
     */
    public function getArchived()
    {
        return $this->archived;
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

    /**
     * Get built
     *
     * @return boolean
     */
    public function getBuilt()
    {
        return $this->built;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Link
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
