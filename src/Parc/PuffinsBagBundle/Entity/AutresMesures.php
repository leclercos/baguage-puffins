<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AutresMesures
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\AutresMesuresRepository")
 */
class AutresMesures
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
     * @ORM\Column(name="champ1", type="string", nullable=true)
     */
    private $champ1;

    /**
     * @var string
     *
     * @ORM\Column(name="champ2", type="string", nullable=true)
     */
    private $champ2;

    /**
     * @var string
     *
     * @ORM\Column(name="champ3", type="string", nullable=true)
     */
    private $champ3;

    /**
     * @var string
     *
     * @ORM\Column(name="champ4", type="string", nullable=true)
     */
    private $champ4;

    /**
     * @var float
     *
     * @ORM\Column(name="mesure1", type="float", nullable=true)
     */
    private $mesure1;

    /**
     * @var float
     *
     * @ORM\Column(name="mesure2", type="float", nullable=true)
     */
    private $mesure2;

    /**
     * @var float
     *
     * @ORM\Column(name="mesure3", type="float", nullable=true)
     */
    private $mesure3;

    /**
     * @var float
     *
     * @ORM\Column(name="mesure4", type="float", nullable=true)
     */
    private $mesure4;

	//constructeur
	public function __construct($args = null)
	{
		if(is_array($args) && !empty($args))
		{
			if(array_key_exists('champ1',$args) && $args['champ1']!= null) 
				$this->champ1	 =		 $args['champ1'];
			if(array_key_exists('champ2',$args) && $args['champ2']!= null)
				$this->champ2	 =		 $args['champ2'];
			if(array_key_exists('champ3',$args) && $args['champ3']!= null) 
				$this->champ3	 =		 $args['champ3'];
			if(array_key_exists('champ4',$args) && $args['champ4']!= null) 
				$this->champ4 	 =		 $args['champ4'];
			if(array_key_exists('mesure1',$args) && $args['mesure1']!= null) 
				$this->mesure1 =(float)$args['mesure1'];
			if(array_key_exists('mesure2',$args)  && $args['mesure2']!= null) 
				$this->mesure2 =(float)$args['mesure2'];
			if(array_key_exists('mesure3',$args)  && $args['mesure3']!= null) 
				$this->mesure3 =(float)$args['mesure3'];
			if(array_key_exists('mesure4',$args)  && $args['mesure4']!= null) 
				$this->mesure4 =(float)$args['mesure4'];
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
     * Set champ1
     *
     * @param string $champ1
     * @return AutresMesures
     */
    public function setChamp1($champ1)
    {
        $this->champ1 = $champ1;
    
        return $this;
    }

    /**
     * Get champ1
     *
     * @return string 
     */
    public function getChamp1()
    {
        return $this->champ1;
    }

    /**
     * Set champ2
     *
     * @param string $champ2
     * @return AutresMesures
     */
    public function setChamp2($champ2)
    {
        $this->champ2 = $champ2;
    
        return $this;
    }

    /**
     * Get champ2
     *
     * @return string 
     */
    public function getChamp2()
    {
        return $this->champ2;
    }

    /**
     * Set champ3
     *
     * @param string $champ3
     * @return AutresMesures
     */
    public function setChamp3($champ3)
    {
        $this->champ3 = $champ3;
    
        return $this;
    }

    /**
     * Get champ3
     *
     * @return string 
     */
    public function getChamp3()
    {
        return $this->champ3;
    }

    /**
     * Set champ4
     *
     * @param string $champ4
     * @return AutresMesures
     */
    public function setChamp4($champ4)
    {
        $this->champ4 = $champ4;
    
        return $this;
    }

    /**
     * Get champ4
     *
     * @return string 
     */
    public function getChamp4()
    {
        return $this->champ4;
    }

    /**
     * Set mesure1
     *
     * @param float $mesure1
     * @return AutresMesures
     */
    public function setMesure1($mesure1)
    {
        $this->mesure1 = $mesure1;
    
        return $this;
    }

    /**
     * Get mesure1
     *
     * @return float 
     */
    public function getMesure1()
    {
        return $this->mesure1;
    }

    /**
     * Set mesure2
     *
     * @param float $mesure2
     * @return AutresMesures
     */
    public function setMesure2($mesure2)
    {
        $this->mesure2 = $mesure2;
    
        return $this;
    }

    /**
     * Get mesure2
     *
     * @return float 
     */
    public function getMesure2()
    {
        return $this->mesure2;
    }

    /**
     * Set mesure3
     *
     * @param float $mesure3
     * @return AutresMesures
     */
    public function setMesure3($mesure3)
    {
        $this->mesure3 = $mesure3;
    
        return $this;
    }

    /**
     * Get mesure3
     *
     * @return float 
     */
    public function getMesure3()
    {
        return $this->mesure3;
    }

    /**
     * Set mesure4
     *
     * @param float $mesure4
     * @return AutresMesures
     */
    public function setMesure4($mesure4)
    {
        $this->mesure4 = $mesure4;
    
        return $this;
    }

    /**
     * Get mesure4
     *
     * @return float 
     */
    public function getMesure4()
    {
        return $this->mesure4;
    }
}