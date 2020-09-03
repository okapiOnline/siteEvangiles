<?php
/**
 * Created by PhpStorm.
 * User: becom
 * Date: 10/05/2016
 * Time: 19:46
 */

namespace Meupf\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Categorie
 *
 * @ORM\Table(name="Categoriemedia")
 * @ORM\Entity(repositoryClass="Meupf\PlateformBundle\Repository\CategorieMediaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategorieMedia {

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
     * @ORM\OneToMany(targetEntity="Media", mappedBy="categorie", cascade={"remove", "merge"})
     */
    private $medias;


    public function __construct(){
        $this->createdAt         = new \Datetime('now');
        $this->medias   = new ArrayCollection();
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
     * @return Categorie
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
     * @return Categorie
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
     * @return Categorie
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

    public function addMedia(Media $media)
    {
        $this->medias[] = $media;
        return $this;
    }


    public function removeMedia(Media $media)
    {
        $this->medias->removeElement($media);
    }


    public function getMedias()
    {
        return $this->medias;
    }

} 