<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DonneesCRBPO
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\DonneesCRBPORepository")
 */
class DonneesCRBPO
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
     * @ORM\Column(name="theme", type="string", length=255, nullable=true)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="centre", type="string", length=3, nullable=true)
     */
    private $centre;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=2, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="dept", type="string", length=3, nullable=true)
     */
    private $dept;

    /**
     * @var string
     *
     * @ORM\Column(name="localite", type="string", length=30, nullable=true)
     */
    private $localite;

    /**
     * @var string
     *
     * @ORM\Column(name="bg", type="string", length=255, nullable=true)
	 * 
	 * @Assert\Regex(pattern="/[A-Z]+,\s[A-Z][a-z]+/", message=" Le nom du bagueur est de type (NOM, Prenom)")
     */
    private $bg;

    /**
     * @var string
     *
     * @ORM\Column(name="sg", type="string", length=255, nullable=true)
	 * 
	 * @Assert\Regex(pattern="/[A-Z]+,\s[A-Z][a-z]+/", message=" Le nom du bagueur est de type (NOM, Prenom)")
     */
    private $sg;

    /**
     * @var integer
     *
     * @ORM\Column(name="condRepr", type="smallint", nullable=true)
     */
    private $condRepr;

    /**
     * @var integer
     *
     * @ORM\Column(name="circRepr", type="smallint", nullable=true)
     */
    private $circRepr;

    /**
     * @var string
     *
     * @ORM\Column(name="cs", type="string", length=2, nullable=true)
     */
    private $cs;

    /**
     * @var string
     *
     * @ORM\Column(name="nf", type="string", length=10, nullable=true)
     */
    private $nf;

    /**
     * @var string
     *
     * @ORM\Column(name="es", type="string", length=10, nullable=true)
     */
    private $es;

	
	//constructeur
	
	public function __construct($args = null)
	{
		$this->theme= 'PROG PERS';
		
		if(is_array($args) && !empty($args))
		{
			$this->theme	= 			$args[0];
			$this->centre	= 			$args[1];	
			$this->pays		= 			$args[2];
			$this->dept		= 			$args[3];
			$this->localite	= 			$args[4];
			$this->bg		= 			$args[5];
			$this->sg		= 		 	$args[6];
			$this->condRepr	= (integer)	$args[7];
			$this->circRepr	= (integer)	$args[8];
			$this->cs		= 			$args[9];
			$this->nf		= 			$args[10];
			$this->es		= 			$args[11];
		}
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
     * Set theme
     *
     * @param string $theme
     * @return DonneesCRBPO
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    
        return $this;
    }

    /**
     * Get theme
     *
     * @return string 
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set centre
     *
     * @param string $centre
     * @return DonneesCRBPO
     */
    public function setCentre($centre)
    {
        $this->centre = $centre;
    
        return $this;
    }

    /**
     * Get centre
     *
     * @return string 
     */
    public function getCentre()
    {
        return $this->centre;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return DonneesCRBPO
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set dept
     *
     * @param string $dept
     * @return DonneesCRBPO
     */
    public function setDept($dept)
    {
        $this->dept = $dept;
    
        return $this;
    }

    /**
     * Get dept
     *
     * @return string 
     */
    public function getDept()
    {
        return $this->dept;
    }

    /**
     * Set localite
     *
     * @param string $localite
     * @return DonneesCRBPO
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;
    
        return $this;
    }

    /**
     * Get localite
     *
     * @return string 
     */
    public function getLocalite()
    {
        return $this->localite;
    }

    /**
     * Set bg
     *
     * @param string $bg
     * @return DonneesCRBPO
     */
    public function setBg($bg)
    {
        $this->bg = $bg;
    
        return $this;
    }

    /**
     * Get bg
     *
     * @return string 
     */
    public function getBg()
    {
        return $this->bg;
    }

    /**
     * Set sg
     *
     * @param string $sg
     * @return DonneesCRBPO
     */
    public function setSg($sg)
    {
        $this->sg = $sg;
    
        return $this;
    }

    /**
     * Get sg
     *
     * @return string 
     */
    public function getSg()
    {
        return $this->sg;
    }

    /**
     * Set condRepr
     *
     * @param integer $condRepr
     * @return DonneesCRBPO
     */
    public function setCondRepr($condRepr)
    {
        $this->condRepr = $condRepr;
    
        return $this;
    }

    /**
     * Get condRepr
     *
     * @return integer 
     */
    public function getCondRepr()
    {
        return $this->condRepr;
    }

    /**
     * Set circRepr
     *
     * @param integer $circRepr
     * @return DonneesCRBPO
     */
    public function setCircRepr($circRepr)
    {
        $this->circRepr = $circRepr;
    
        return $this;
    }

    /**
     * Get circRepr
     *
     * @return integer 
     */
    public function getCircRepr()
    {
        return $this->circRepr;
    }

    /**
     * Set cs
     *
     * @param string $cs
     * @return DonneesCRBPO
     */
    public function setCs($cs)
    {
        $this->cs = $cs;
    
        return $this;
    }

    /**
     * Get cs
     *
     * @return string 
     */
    public function getCs()
    {
        return $this->cs;
    }

    /**
     * Set nf
     *
     * @param string $nf
     * @return DonneesCRBPO
     */
    public function setNf($nf)
    {
        $this->nf = $nf;
    
        return $this;
    }

    /**
     * Get nf
     *
     * @return string 
     */
    public function getNf()
    {
        return $this->nf;
    }

    /**
     * Set es
     *
     * @param string $es
     * @return DonneesCRBPO
     */
    public function setEs($es)
    {
        $this->es = $es;
    
        return $this;
    }

    /**
     * Get es
     *
     * @return string 
     */
    public function getEs()
    {
        return $this->es;
    }

    /**
     * Set donneesPrincipales
     *
     * @param \Parc\PuffinsBagBundle\Entity\DonneesPrincipales $donneesPrincipales
     * @return DonneesCRBPO
     */
    public function setDonneesPrincipales(\Parc\PuffinsBagBundle\Entity\DonneesPrincipales $donneesPrincipales)
    {
        $this->donneesPrincipales = $donneesPrincipales;
    
        return $this;
    }

    /**
     * Get donneesPrincipales
     *
     * @return \Parc\PuffinsBagBundle\Entity\DonneesPrincipales 
     */
    public function getDonneesPrincipales()
    {
        return $this->donneesPrincipales;
    }
}