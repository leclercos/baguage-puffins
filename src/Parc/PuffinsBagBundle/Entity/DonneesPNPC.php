<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DonneesPNPC
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\DonneesPNPCRepository")
 */
class DonneesPNPC
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
     * @ORM\Column(name="primaire", type="string", length=255, nullable=true)
     */
    private $primaire;

    /**
     * @var string
     *
     * @ORM\Column(name="secondaire", type="string", length=255, nullable=true)
     */
    private $secondaire;

    /**
     * @var string
     *
     * @ORM\Column(name="rectrice", type="string", length=255, nullable=true)
     */
    private $rectrice;

    /**
     * @var string
     *
     * @ORM\Column(name="couV", type="string", length=255, nullable=true)
     */
    private $couV;

    /**
     * @var string
     *
     * @ORM\Column(name="couD", type="string", length=255, nullable=true)
     */
    private $couD;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rg", type="boolean", nullable=true)
     */
    private $rg;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pl", type="boolean", nullable=true)
     */
    private $pl;

    /**
     * @var boolean
     *
     * @ORM\Column(name="pr", type="boolean", nullable=true)
     */
    private $pr;

    /**
     * @var boolean
     *
     * @ORM\Column(name="asg", type="boolean", nullable=true)
     */
    private $asg;	
	
	public function __construct($args = null)
	{
		if(is_array($args) && !empty($args))
		{
			if(array_key_exists('primaire',$args)) 	$this->primaire		= 		$args['primaire'];
			if(array_key_exists('secondaire',$args))$this->secondaire	= 		$args['secondaire'];	
			if(array_key_exists('rectrice',$args)) 	$this->rectrice		= 		$args['rectrice'];
			if(array_key_exists('couv',$args)) 		$this->couV			= 		$args['couv'];
			if(array_key_exists('coud',$args)) 		$this->couD			= 		$args['coud'];
			if(array_key_exists('rg',$args)) 		$this->rg			= (bool)$args['rg'];
			if(array_key_exists('pl',$args)) 		$this->pl			= (bool)$args['pl'];
			if(array_key_exists('pr',$args)) 		$this->pr			= (bool)$args['pr'];
			if(array_key_exists('asg',$args)) 		$this->asg			= (bool)$args['asg'];
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
     * Set primaire
     *
     * @param string $primaire
     * @return DonneesPNPC
     */
    public function setPrimaire($primaire)
    {
        $this->primaire = $primaire;
    
        return $this;
    }

    /**
     * Get primaire
     *
     * @return string 
     */
    public function getPrimaire()
    {
        return $this->primaire;
    }

    /**
     * Set secondaire
     *
     * @param string $secondaire
     * @return DonneesPNPC
     */
    public function setSecondaire($secondaire)
    {
        $this->secondaire = $secondaire;
    
        return $this;
    }

    /**
     * Get secondaire
     *
     * @return string 
     */
    public function getSecondaire()
    {
        return $this->secondaire;
    }

    /**
     * Set rectrice
     *
     * @param string $rectrice
     * @return DonneesPNPC
     */
    public function setRectrice($rectrice)
    {
        $this->rectrice = $rectrice;
    
        return $this;
    }

    /**
     * Get rectrice
     *
     * @return string 
     */
    public function getRectrice()
    {
        return $this->rectrice;
    }

    /**
     * Set couV
     *
     * @param string $couV
     * @return DonneesPNPC
     */
    public function setCouV($couV)
    {
        $this->couV = $couV;
    
        return $this;
    }

    /**
     * Get couV
     *
     * @return string 
     */
    public function getCouV()
    {
        return $this->couV;
    }

    /**
     * Set couD
     *
     * @param string $couD
     * @return DonneesPNPC
     */
    public function setCouD($couD)
    {
        $this->couD = $couD;
    
        return $this;
    }

    /**
     * Get couD
     *
     * @return string 
     */
    public function getCouD()
    {
        return $this->couD;
    }

    /**
     * Set rg
     *
     * @param boolean $rg
     * @return DonneesPNPC
     */
    public function setRg($rg)
    {
        $this->rg = $rg;
    
        return $this;
    }

    /**
     * Get rg
     *
     * @return boolean 
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set pl
     *
     * @param boolean $pl
     * @return DonneesPNPC
     */
    public function setPl($pl)
    {
        $this->pl = $pl;
    
        return $this;
    }

    /**
     * Get pl
     *
     * @return boolean 
     */
    public function getPl()
    {
        return $this->pl;
    }

    /**
     * Set pr
     *
     * @param boolean $pr
     * @return DonneesPNPC
     */
    public function setPr($pr)
    {
        $this->pr = $pr;
    
        return $this;
    }

    /**
     * Get pr
     *
     * @return boolean 
     */
    public function getPr()
    {
        return $this->pr;
    }

    /**
     * Set boolean
     *
     * @param string $boolean
     * @return DonneesPNPC
     */
    public function setBoolean($boolean)
    {
        $this->boolean = $boolean;
    
        return $this;
    }

    /**
     * Get boolean
     *
     * @return string 
     */
    public function getBoolean()
    {
        return $this->boolean;
    }

    /**
     * Set asg
     *
     * @param boolean $asg
     * @return DonneesPNPC
     */
    public function setAsg($asg)
    {
        $this->asg = $asg;
    
        return $this;
    }

    /**
     * Get asg
     *
     * @return boolean 
     */
    public function getAsg()
    {
        return $this->asg;
    }
}
