<?php

namespace Parc\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Document
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	/**
	* @Assert\File(maxSize="10000000")
	*/
	public $fichier;
	
    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var \Dateate
     *
     * @ORM\Column(name="dateAjout", type="date")
	 *
	 * @Assert\Date()
     */
    private $dateAjout;

	public function __construct($args = null)
	{
		$this->dateAjout = new \Datetime();	
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
     * Get fichier
     *
     * @return fichier
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     * @return Document
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Document
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Document
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Document
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Document
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    
        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set dateAjout
     *
     * @param string $dateAjout
     * @return Document
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    
        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return string 
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }
	
	public function getAbsolutePath()
	{
		//return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
		return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
	}
	
	public function getWebPath()
	{
		return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
	}
	
	protected function getUploadRootDir()
	{
		// le path absolu du répertoire où les documents uploadés doivent être sauvegardés
		return __DIR__.'/../../../../web/'.$this->getUploadDir();
	}
	protected function getUploadDir()
	{
		return 'Resources/documents';
	}
	
	/**
	* @ORM\PrePersist()
	* @ORM\PreUpdate()
	*/
	public function preUpload()
	{
		if (null !== $this->fichier) {
		
			$type = $this->fichier->guessExtension();
			$this->type = $type;
			if(null !== $this->nom)
			{
				$this->nom= $this->nom.'.'.$type;
			}
			else $this->nom = $this->fichier->getClientOriginalName();
			
			$this->path = $type;
		}
	}
	
	/**
	* @ORM\PostPersist()
	* @ORM\PostUpdate()
	*/
	public function upload()
	{
		if (null === $this->fichier) return;
		
		//$this->type = $this->fichier->guessExtension();
		$this->fichier->move($this->getUploadRootDir(), $this->id.'.'.$this->fichier->guessExtension());
		//$this->fichier->move($this->getUploadRootDir(), $this->path);
		unset($this->fichier);
	}
	
	/**
	* @ORM\PreRemove()
	*/
	public function storeFilenameForRemove()
	{
		$this->filenameForRemove = $this->getAbsolutePath();
	}
	
	/**
	* @ORM\PostRemove()
	*/
	public function removeUpload()
	{
		if ($this->filenameForRemove) {
			unlink($this->filenameForRemove);
		}
	}
	
}
