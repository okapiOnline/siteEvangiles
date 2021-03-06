<?php

namespace Meupf\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * CategorieArticle
 *
 * @ORM\Table(name="categoriearticle")
 * @ORM\Entity(repositoryClass="Meupf\PlateformBundle\Repository\CategorieArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategorieArticle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private  $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="post_count", type="integer", nullable=true)
     */
    private $postCount = 0;

    /**
     * @var string
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;



    // ...
    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="categorie", cascade={"remove", "merge"})
     */
    private $articles;


    public function __construct(){
        $this->createdAt         = new \Datetime('now');
        $this->articles   = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CategorieArticle
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set postCount
     *
     * @param integer $postCount
     * @return CategorieArticle
     */
    public function setPostCount($postCount)
    {
        $this->postCount = $postCount;

        return $this;
    }

    /**
     * Get postCount
     *
     * @return integer 
     */
    public function getPostCount()
    {
        return $this->postCount;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return CategorieArticle
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**

     * @ORM\PreUpdate

     */

    public function updateDate()

    {

        $this->setUpdatedAt(new \Datetime());

    }


    public function setUpdatedAt(\Datetime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function increasePostCount()
    {
        $this->postCount++;
    }

    public function decreasePostCount()
    {
        $this->postCount--;
    }

    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
        return $this;
    }


    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }


    public function getArticles()
    {
        return $this->articles;
    }

}
