<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 01/04/2016
 * Time: 16:31
 */

namespace Meupf\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Meupf\PlateformBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Article {


    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article")
     */
    protected $comments;

    /**
     * @ORM\ManyToOne(targetEntity="CategorieArticle")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=50, unique = true)
     * @Assert\Length(min=10)
     */
    private $title;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\DateTime()
     */
    private  $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $updatedAt;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255, unique = true)
     */
    private $slug;

    /**
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank() 
     */
    private $content;



    /**
     * @ORM\Column(name="online", type="boolean")
     */
    private $online = false;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    public function __construct(){
        $this->createdAt = new \DateTime('now');
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }




    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param mixed $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }




    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }


    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate(){
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @param  $image
     * @return Advert
     */
    public function setImage($image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

   /**
     * @ORM\PrePersist

    public function increase()
    {
        $this->getCategorie()->increasePostCount();
    }



     * @ORM\PreRemove

    public function decrease()
    {
        $this->getCategorie()->decreasePostCount();
    }
    */

} 