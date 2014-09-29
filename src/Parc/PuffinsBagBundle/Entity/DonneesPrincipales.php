<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DonneesPrincipales
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\DonneesPrincipalesRepository")
 */
class DonneesPrincipales
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
	 *
	 * @Assert\NotBlank(message="La valeur est obligatoire", groups={"importer"})
     */
    private $lieudit;
	
	/**
     * @var string
     *
     * @ORM\Column(name="bg", type="string", length=255, nullable=true)
	 * 
	 * @Assert\NotBlank(message="La valeur est obligatoire", groups={"importer"})
	 * @Assert\Regex(pattern="/[A-Z]+,\s[A-Z][a-z]+/", message="Format incorrect", groups={"importer"})
     */
    private $bg;

    /**
     * @var string
     *
     * @ORM\Column(name="sg", type="string", length=255, nullable=true)
	 * 
	 * @Assert\Regex(pattern="/[A-Z]+,\s[A-Z][a-z]+/", message=" Format incorrect")
     */
    private $sg;
	
    /**
     * @var string
     *
     * @ORM\Column(name="espece", type="string", length=6)
	 *
	 * @Assert\NotBlank(message="La valeur est obligatoire", groups={"importer"})
     */
    private $espece;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=1)
	 *
	 * @Assert\NotBlank(message="La valeur est obligatoire", groups={"importer"})
	 * @Assert\Regex(pattern="/(B|C|R)/", message="L'action doit etre B, C ou R", groups={"importer"})
     */
    private $action;
	
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
     * @ORM\Column(name="bague", type="string", length=10)
	 * 
	 * @Assert\Regex(pattern="/[A-Z]{2}[0-9]+/", message="Format incorrect", groups={"importer"})
	 * @Assert\Regex(pattern="/[a-zA-Z0-9]+\s[a-zA-Z0-9]+/", match=false, message="Pas d'espace")
     */
    private $bague;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="colonie", type="string", length=255, nullable=true)
     */
    private $colonie;

    /**
     * @var string
     *
     * @ORM\Column(name="secteur", type="string", length=255, nullable=true)
     */
    private $secteur;
	
    /**
     * @var string
     *
     * @ORM\Column(name="terrier", type="string", length=20, nullable=true)
     */	 
    private $terrier;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
	 * 
	 * @Assert\Date()
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure", type="time")
	 * 
	 * @Assert\Time()
     */
    private $heure;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=4)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=5)
     */
    private $age;

	// Associations
	
	/**
	 * @ORM\ManyToOne(targetEntity="Parc\PuffinsBagBundle\Entity\DonneesLocalisation")
	 * @ORM\JoinColumn(nullable=false)
	 *
	 * @Assert\Valid()
	 */
	private $donneesLocalisation;
	
	/**
	 * @ORM\OneToOne(targetEntity="Parc\PuffinsBagBundle\Entity\DonneesComplementaires", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(nullable=false)
	 *
	 * @Assert\Valid()
	 */
	private $donneesComplementaires;
	
	/**
	 * @ORM\OneToOne(targetEntity="Parc\PuffinsBagBundle\Entity\DonneesPNPC", cascade={"remove"})
	 * @ORM\JoinColumn(nullable=true)
	 *
	 * @Assert\Valid()
	 */
	private $donneesPNPC;
	
	/**
	 * @ORM\OneToOne(targetEntity="Parc\PuffinsBagBundle\Entity\AutresMesures", cascade={"remove"})
	 * @ORM\JoinColumn(nullable=true)
	 *
	 * @Assert\Valid()
	 */
	private $autresMesures;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Parc\PuffinsBagBundle\Entity\Cartouche", cascade={"persist", "remove"})
	 * @ORM\JoinColumn(nullable=true)
	 *
	 * @Assert\Valid()
	 */
	private $cartouche;
	
	private $sauvegarder;
	
	//constructeur
	public function __construct($args = null)
	{
		$this->date = new \Datetime();
		$this->heure= new \Datetime();
		//$this->cartouche = new Cartouche()
	}	
	/**
     * Set id
     *
     * @param integer $id
     * @return DonneesPrincipales
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
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
     * Set espece
     *
     * @param string $espece
     * @return DonneesPrincipales
     */
    public function setEspece($espece)
    {
        $this->espece = $espece;
    
        return $this;
    }

    /**
     * Get espece
     *
     * @return string 
     */
    public function getEspece()
    {
        return $this->espece;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return DonneesPrincipales
     */
    public function setAction($action)
    {
        $this->action = $action;
    
        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set bague
     *
     * @param string $bague
     * @return DonneesPrincipales
     */
    public function setBague($bague)
    {
        $this->bague = $bague;
    
        return $this;
    }

    /**
     * Get bague
     *
     * @return string 
     */
    public function getBague()
    {
        return $this->bague;
    }

    /**
     * Set terrier
     *
     * @param string $terrier
     * @return DonneesPrincipales
     */
    public function setTerrier($terrier)
    {
        $this->terrier = $terrier;
    
        return $this;
    }

    /**
     * Get terrier
     *
     * @return string 
     */
    public function getTerrier()
    {
        return $this->terrier;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return DonneesPrincipales
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set heure
     *
     * @param \DateTime $heure
     * @return DonneesPrincipales
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    
        return $this;
    }

    /**
     * Get heure
     *
     * @return \DateTime 
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return DonneesPrincipales
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set age
     *
     * @param string $age
     * @return DonneesPrincipales
     */
    public function setAge($age)
    {
        $this->age = $age;
    
        return $this;
    }

    /**
     * Get age
     *
     * @return string 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set donneesComplementaires
     *
     * @param \Parc\PuffinsBagBundle\Entity\DonneesComplementaires $donneesComplementaires
     * @return DonneesPrincipales
     */
    public function setDonneesComplementaires(\Parc\PuffinsBagBundle\Entity\DonneesComplementaires $donneesComplementaires)
    {
        $this->donneesComplementaires = $donneesComplementaires;
    
        return $this;
    }

    /**
     * Get donneesComplementaires
     *
     * @return \Parc\PuffinsBagBundle\Entity\DonneesComplementaires 
     */
    public function getDonneesComplementaires()
    {
        return $this->donneesComplementaires;
    }

    /**
     * Set donneesPNPC
     *
     * @param \Parc\PuffinsBagBundle\Entity\DonneesPNPC $donneesPNPC
     * @return DonneesPrincipales
     */
    public function setDonneesPNPC(\Parc\PuffinsBagBundle\Entity\DonneesPNPC $donneesPNPC = null)
    {
        $this->donneesPNPC = $donneesPNPC;
    
        return $this;
    }

    /**
     * Get donneesPNPC
     *
     * @return \Parc\PuffinsBagBundle\Entity\DonneesPNPC 
     */
    public function getDonneesPNPC()
    {
        return $this->donneesPNPC;
    }

    /**
     * Set autresMesures
     *
     * @param \Parc\PuffinsBagBundle\Entity\AutresMesures $autresMesures
     * @return DonneesPrincipales
     */
    public function setAutresMesures(\Parc\PuffinsBagBundle\Entity\AutresMesures $autresMesures = null)
    {
        $this->autresMesures = $autresMesures;
    
        return $this;
    }

    /**
     * Get autresMesures
     *
     * @return \Parc\PuffinsBagBundle\Entity\AutresMesures 
     */
    public function getAutresMesures()
    {
        return $this->autresMesures;
    }
	
	public function construct($valeurs,$has_pnpc,$has_autrem)
	{
		//$dater=$valeurs['date'];
		//$datef=format($dater,'m/d/Y');
			
		if(array_key_exists('lieudit',$valeurs)) 	$this->lieudit    = $valeurs['lieudit'];
		if(array_key_exists('bg',$valeurs))			$this->bg		  = $valeurs['bg'];
		if(array_key_exists('sg',$valeurs))			$this->sg		  = $valeurs['sg'];
		if(array_key_exists('espece',$valeurs))		$this->espece     = $valeurs['espece'];
		if(array_key_exists('action',$valeurs))		$this->action     = $valeurs['action'];
		
		if(array_key_exists('circrepr',$valeurs))	$this->circRepr   = (int)$valeurs['circrepr'];
		if(array_key_exists('bague',$valeurs))		$this->bague      = $valeurs['bague'];		
		if(array_key_exists('colonie',$valeurs))	$this->colonie    = $valeurs['colonie'];
		if(array_key_exists('secteur',$valeurs))	$this->secteur    = $valeurs['secteur'];
		if(array_key_exists('terrier',$valeurs))	$this->terrier    = $valeurs['terrier'];		
		if(array_key_exists('sexe',$valeurs))		$this->sexe       = $valeurs['sexe'];
		if(array_key_exists('age',$valeurs))		$this->age        = $valeurs['age'];
		
		if(array_key_exists('condrepr',$valeurs) and $valeurs['condrepr']!= null)
			$this->condRepr   = (int)$valeurs['condrepr'];
		if(array_key_exists('circrepr',$valeurs) and $valeurs['circrepr']!= null)
			$this->circRepr   = (int)$valeurs['circrepr'];
		// format de l'heure	
		if(array_key_exists('heure',$valeurs)){
			$heure=str_ireplace('H',':',$valeurs['heure']);
			$this->heure = new \Datetime($heure);
		}
		// format de la date
		if(array_key_exists('date',$valeurs)){
			$date_val=$valeurs['date'];
			//$date_val=html_entity_decode($date_val);
			$date_str = str_replace('-','/',$date_val);
			$date_str = str_replace('.','/',$date_val);
			$date1=explode('/',$date_str);
			//$date1=explode('',$valeurs['date']);
			if (count($date1)==3 ){
				$date=''.$date1[1].'/'.$date1[0].'/'.$date1[2].''; // Format mm/jj/aaaa
			}else{ $date='12/31/9999';}
			$this->date = new \Datetime($date);
		}
		$this->donneesComplementaires 	= new DonneesComplementaires($valeurs);
		
		if ($has_pnpc) 		$this->donneesPNPC		= new DonneesPNPC($valeurs);
		if ($has_autrem)	$this->autresMesures	= new AutresMesures($valeurs);
		
		//$this->cartouche = new Cartouche();
		return $this;
	}

    /**
     * Set condRepr
     *
     * @param integer $condRepr
     * @return DonneesPrincipales
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
     * @return DonneesPrincipales
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
     * Set colonie
     *
     * @param string $colonie
     * @return DonneesPrincipales
     */
    public function setColonie($colonie)
    {
        $this->colonie = $colonie;
    
        return $this;
    }

    /**
     * Get colonie
     *
     * @return string 
     */
    public function getColonie()
    {
        return $this->colonie;
    }

    /**
     * Set secteur
     *
     * @param string $secteur
     * @return DonneesPrincipales
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;
    
        return $this;
    }

    /**
     * Get secteur
     *
     * @return string 
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set donneesLocalisation
     *
     * @param \Parc\PuffinsBagBundle\Entity\DonneesLocalisation $donneesLocalisation
     * @return DonneesPrincipales
     */
    public function setDonneesLocalisation(\Parc\PuffinsBagBundle\Entity\DonneesLocalisation $donneesLocalisation = null)
    {
        $this->donneesLocalisation = $donneesLocalisation;
    
        return $this;
    }

    /**
     * Get donneesLocalisation
     *
     * @return \Parc\PuffinsBagBundle\Entity\DonneesLocalisation 
     */
    public function getDonneesLocalisation()
    {
        return $this->donneesLocalisation;
    }

    /**
     * Set lieudit
     *
     * @param string $lieudit
     * @return DonneesPrincipales
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
     * Set bg
     *
     * @param string $bg
     * @return DonneesPrincipales
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
     * @return DonneesPrincipales
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
	
	public function setSauvegarder($sauvegarder)
    {
        $this->sauvegarder = $sauvegarder;
    
        return $this;
    }
	
    public function getSauvegarder()
    {
        return $this->sauvegarder;
    }
	

    /**
     * Set cartouche
     *
     * @param \Parc\PuffinsBagBundle\Entity\Cartouche $cartouche
     * @return DonneesPrincipales
     */
    public function setCartouche(\Parc\PuffinsBagBundle\Entity\Cartouche $cartouche = null)
    {
        $this->cartouche = $cartouche;
    
        return $this;
    }

    /**
     * Get cartouche
     *
     * @return \Parc\PuffinsBagBundle\Entity\Cartouche 
     */
    public function getCartouche()
    {
        return $this->cartouche;
    }
}