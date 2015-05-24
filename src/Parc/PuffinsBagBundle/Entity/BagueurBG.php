<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BagueurBG
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\BagueurBGRepository")
 */
class BagueurBG
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCRBPO", type="string", length=255, nullable=true)
     */
    private $nomCRBPO;

    /**
     * @ORM\ManyToOne(targetEntity="Parc\PuffinsBagBundle\Entity\Responsable")
	 * @ORM\JoinColumn(nullable=false)
	 *
	 * @Assert\Valid()
	 */
    private $responsable;


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
     * Set nom
     *
     * @param string $nom
     * @return BagueurBG
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
     * Set prenom
     *
     * @param string $prenom
     * @return BagueurBG
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nomCRBPO
     *
     * @param string $nomCRBPO
     * @return BagueurBG
     */
    public function setNomCRBPO($nomCRBPO)
    {
        $this->nomCRBPO = $nomCRBPO;
    
        return $this;
    }

    /**
     * Get nomCRBPO
     *
     * @return string 
     */
    public function getNomCRBPO()
    {
        //return strtoupper($this->nom).', '.ucfirst($this->prenom);
		return $this->nomCRBPO;
    }

    /**
     * Set responsable
     *
     * @param \Parc\PuffinsBagBundle\Entity\Responsable $responsable
     * @return BagueurBG
     */
    public function setResponsable(\Parc\PuffinsBagBundle\Entity\Responsable $responsable = null)
    {
        $this->responsable = $responsable;
    
        return $this;
    }
	
	/**
     * Get responsable
     *
     * @return \Parc\PuffinsBagBundle\Entity\Responsable 
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
}
