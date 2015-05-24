<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DonneesLocalisation
 *
 * @ORM\Table()
 *
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\DonneesLocalisationRepository")
 */
class DonneesLocalisation
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
     * @ORM\Column(name="Lieudit", type="string", length=255)
     */
    private $lieudit;
	
	/**
     * @var string
     *
     * @ORM\Column(name="codeIle", type="string", length=7)
	 *
	 * @Assert\Regex(pattern="/[A-Z]{4}[0-9]{3}/", message=" Le code ile doit etre de type AAAA001")
     */
    private $codeIle;
	
	/**
     * @ORM\ManyToOne(targetEntity="Parc\PuffinsBagBundle\Entity\Responsable")
	 * @ORM\JoinColumn(nullable=false)
	 *
	 * @Assert\Valid()
	 */
    private $bagueur;
	
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
	* @ORM\OneToMany(targetEntity="Parc\PuffinsBagBundle\Entity\Colonie", mappedBy="lieudit")
	*/
	private $colonies;
	
	//constructeur
	public function __construct()
	{
		$this->theme="PROG PERS";
		$this->centre="FRP";
		$this->pays="FR";		
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
     * Set lieudit
     *
     * @param string $lieudit
     * @return DonneesLocalisation
     */
    public function setLieudit($lieudit)
    {
        $this->lieudit = $lieudit;
    
        return $this;
    }

    /**
     * Get lieudit
     *
     * @return string 
     */
    public function getLieudit()
    {
        return $this->lieudit;
    }
	
	/**
     * Set theme
     *
     * @param string $theme
     * @return DonneesLocalisation
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
     * @return DonneesLocalisation
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
     * @return DonneesLocalisation
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
     * @return DonneesLocalisation
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
     * @return DonneesLocalisation
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
     * Set codeIle
     *
     * @param string $codeIle
     * @return DonneesLocalisation
     */
    public function setCodeIle($codeIle)
    {
        $this->codeIle = $codeIle;
    
        return $this;
    }

    /**
     * Get codeIle
     *
     * @return string 
     */
    public function getCodeIle()
    {
        return $this->codeIle;
    }

    /**
     * Set bagueur
     *
     * @param \Parc\PuffinsBagBundle\Entity\Responsable $bagueur
     * @return DonneesLocalisation
     */
    public function setBagueur(\Parc\PuffinsBagBundle\Entity\Responsable $bagueur = null)
    {
        $this->bagueur = $bagueur;
    
        return $this;
    }
	
	/**
     * Get bagueur
     *
     * @return \Parc\PuffinsBagBundle\Entity\Responsable 
     */
    public function getBagueur()
    {
        return $this->bagueur;
    }

    /**
     * Add colonies
     *
     * @param \Parc\PuffinsBagBundle\Entity\Colonie $colonies
     * @return DonneesLocalisation
     */
    public function addColonie(\Parc\PuffinsBagBundle\Entity\Colonie $colonies)
    {
        $this->colonies[] = $colonies;
    
        return $this;
    }

    /**
     * Remove colonies
     *
     * @param \Parc\PuffinsBagBundle\Entity\Colonie $colonies
     */
    public function removeColonie(\Parc\PuffinsBagBundle\Entity\Colonie $colonies)
    {
        $this->colonies->removeElement($colonies);
    }

    /**
     * Get colonies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColonies()
    {
        return $this->colonies;
    }
}