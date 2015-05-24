<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Responsable
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Responsable
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

	//constructeur
	public function __construct($args = null)
	{
		$this->nomCRBPO = strtoupper($this->nom).', '.ucfirst($this->prenom);
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
     * Set nom
     *
     * @param string $nom
     * @return Responsable
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
     * @return Responsable
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
     * @return Responsable
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
        return strtoupper($this->nom).', '.ucfirst($this->prenom);
    }
}
