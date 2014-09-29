<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DonneesComplementaires
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\DonneesComplementairesRepository")
 */
class DonneesComplementaires
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
     * @ORM\Column(name="nature", type="string", length=255, nullable=true)
     */
    private $nature;

    /**
     * @var string
     *
     * @ORM\Column(name="rmqTerrier", type="string", length=255, nullable=true)
     */
    private $rmqTerrier;

    /**
     * @var string
     *
     * @ORM\Column(name="periodeJN", type="string", length=255, nullable=true)
     */
    private $periodeJN;

    /**
     * @var string
     *
     * @ORM\Column(name="stade", type="string", length=255, nullable=true)
     */
    private $stade;
	
	/**
     * @var string
     *
     * @ORM\Column(name="ptd", type="string", length=255, nullable=true)
	 *
	 * @Assert\Regex(pattern="/[A-Z]{2}[0-9]+/", message="Format type bague")
	 * @Assert\Regex(pattern="/[a-zA-Z0-9]+\s[a-zA-Z0-9]+/", match=false, message="Format bague incorrecte")
     */
    private $ptd;
	
	/**
     * @var string
	 *
     * @ORM\Column(name="pr1", type="string", length=255, nullable=true)
	 *
     * @Assert\Regex(pattern="/[A-Z]{2}[0-9]+/", message="Format type bague")
	 * @Assert\Regex(pattern="/[a-zA-Z0-9]+\s[a-zA-Z0-9]+/", match=false, message="Format bague incorrecte")
     */
    private $pr1;
	
	/**
     * @var string
     *
     * @ORM\Column(name="pr2", type="string", length=255, nullable=true)
	 *
     * @Assert\Regex(pattern="/[A-Z]{2}[0-9]+/", message="Format type bague")
	 * @Assert\Regex(pattern="/[a-zA-Z0-9]+\s[a-zA-Z0-9]+/", match=false, message="Format bague incorrecte")
     */
    private $pr2;

    /**
     * @var string
     *
     * @ORM\Column(name="lp", type="float", length=255, nullable=true)
     */
    private $lp;
	
	/**
     * @var string
     *
     * @ORM\Column(name="memo", type="text", nullable=true)
     */
    private $memo;

    /**
     * @var float
     *
     * @ORM\Column(name="bc", type="float", nullable=true)
     */
    private $bc;

    /**
     * @var float
     *
     * @ORM\Column(name="bh", type="float", nullable=true)
     */
    private $bh;

    /**
     * @var float
     *
     * @ORM\Column(name="lt", type="float", nullable=true)
     */
    private $lt;

    /**
     * @var float
     *
     * @ORM\Column(name="ma", type="float", nullable=true)
     */
    private $ma;
	
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
	
	public function __construct($args = null)
	{
		$this->nature = 'Naturel';
		
		if(is_array($args) && !empty($args))
		{
			if(array_key_exists('nature',$args)) 	$this->nature		= 		 $args['nature'];
			if(array_key_exists('rmqterrier',$args))$this->rmqTerrier	= 		 $args['rmqterrier'];
			if(array_key_exists('periodejn',$args))	$this->periodeJN	= 		 $args['periodejn'];
			if(array_key_exists('stade',$args)) 	$this->stade		= 		 $args['stade'];
			if(array_key_exists('ptd',$args)) 		$this->ptd			= 		 $args['ptd'];
			if(array_key_exists('pr1',$args)) 		$this->pr1			= 		 $args['pr1'];
			if(array_key_exists('pr2',$args)) 		$this->pr2			= 		 $args['pr2'];
			if(array_key_exists('memo',$args)) 		$this->memo			= 		 $args['memo'];
			if(array_key_exists('bc',$args)) 		$this->bc			= (double)str_replace(',','.',$args['bc']);
			if(array_key_exists('lp',$args)) 		$this->lp			= (double)str_replace(',','.',$args['lp']);
			if(array_key_exists('bh',$args)) 		$this->bh			= (double)str_replace(',','.',$args['bh']);
			if(array_key_exists('lt',$args)) 		$this->lt			= (double)str_replace(',','.',$args['lt']);
			if(array_key_exists('ma',$args)) 		$this->ma			= (double)str_replace(',','.',$args['ma']);
			if(array_key_exists('cs',$args)) 		$this->cs			= 		 $args['cs'];
			if(array_key_exists('nf',$args)) 		$this->nf			= 		 $args['nf'];
			if(array_key_exists('es',$args)) 		$this->es			= 		 $args['es'];
			/*
			$this->nature		= 		 $args[15];
			$this->rmqTerrier	= 		 $args[16];
			$this->periodeJN	= 		 $args[17];
			$this->stade		= 		 $args[18];
			$this->lp			= (float)$args[19];
			$this->memo			= 		 $args[20];
			$this->bc			= (float)$args[21];
			$this->bh			= (float)$args[22];
			$this->lt			= (float)$args[23];
			$this->ma			= (float)$args[24];*/
		}
	}

    /**
     * Set nature
     *
     * @param string $nature
     * @return DonneesComplementaires
     */
    public function setNature($nature)
    {
        $this->nature = $nature;
    
        return $this;
    }

    /**
     * Get nature
     *
     * @return string 
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * Set rmqTerrier
     *
     * @param string $rmqTerrier
     * @return DonneesComplementaires
     */
    public function setRmqTerrier($rmqTerrier)
    {
        $this->rmqTerrier = $rmqTerrier;
    
        return $this;
    }

    /**
     * Get rmqTerrier
     *
     * @return string 
     */
    public function getRmqTerrier()
    {
        return $this->rmqTerrier;
    }

    /**
     * Set periodeJN
     *
     * @param string $periodeJN
     * @return DonneesComplementaires
     */
    public function setPeriodeJN($periodeJN)
    {
        $this->periodeJN = $periodeJN;
    
        return $this;
    }

    /**
     * Get periodeJN
     *
     * @return string 
     */
    public function getPeriodeJN()
    {
        return $this->periodeJN;
    }

    /**
     * Set stade
     *
     * @param string $stade
     * @return DonneesComplementaires
     */
    public function setStade($stade)
    {
        $this->stade = $stade;
    
        return $this;
    }

    /**
     * Get stade
     *
     * @return string 
     */
    public function getStade()
    {
        return $this->stade;
    }

    /**
     * Set lp
     *
     * @param string $lp
     * @return DonneesComplementaires
     */
    public function setLp($lp)
    {
        $this->lp = $lp;
    
        return $this;
    }

    /**
     * Get lp
     *
     * @return string 
     */
    public function getLp()
    {
        return $this->lp;
    }

    /**
     * Set bc
     *
     * @param float $bc
     * @return DonneesComplementaires
     */
    public function setBc($bc)
    {
        $this->bc = $bc;
    
        return $this;
    }

    /**
     * Get bc
     *
     * @return float 
     */
    public function getBc()
    {
        return $this->bc;
    }

    /**
     * Set bh
     *
     * @param float $bh
     * @return DonneesComplementaires
     */
    public function setBh($bh)
    {
        $this->bh = $bh;
    
        return $this;
    }

    /**
     * Get bh
     *
     * @return float 
     */
    public function getBh()
    {
        return $this->bh;
    }

    /**
     * Set lt
     *
     * @param float $lt
     * @return DonneesComplementaires
     */
    public function setLt($lt)
    {
        $this->lt = $lt;
    
        return $this;
    }

    /**
     * Get lt
     *
     * @return float 
     */
    public function getLt()
    {
        return $this->lt;
    }

    /**
     * Set ma
     *
     * @param float $ma
     * @return DonneesComplementaires
     */
    public function setMa($ma)
    {
        $this->ma = $ma;
    
        return $this;
    }

    /**
     * Get ma
     *
     * @return float 
     */
    public function getMa()
    {
        return $this->ma;
    }

    /**
     * Set memo
     *
     * @param string $memo
     * @return DonneesComplementaires
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    
        return $this;
    }

    /**
     * Get memo
     *
     * @return string 
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set donneesPrincipales
     *
     * @param \Parc\PuffinsBagBundle\Entity\DonneesPrincipales $donneesPrincipales
     * @return DonneesComplementaires
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
     * Set pr1
     *
     * @param string $pr1
     * @return DonneesComplementaires
     */
    public function setPr1($pr1)
    {
        $this->pr1 = $pr1;
    
        return $this;
    }

    /**
     * Get pr1
     *
     * @return string 
     */
    public function getPr1()
    {
        return $this->pr1;
    }

    /**
     * Set pr2
     *
     * @param string $pr2
     * @return DonneesComplementaires
     */
    public function setPr2($pr2)
    {
        $this->pr2 = $pr2;
    
        return $this;
    }

    /**
     * Get pr2
     *
     * @return string 
     */
    public function getPr2()
    {
        return $this->pr2;
    }

    /**
     * Set cs
     *
     * @param string $cs
     * @return DonneesComplementaires
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
     * @return DonneesComplementaires
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
     * @return DonneesComplementaires
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
     * Set ptd
     *
     * @param string $ptd
     * @return DonneesComplementaires
     */
    public function setPtd($ptd)
    {
        $this->ptd = $ptd;
    
        return $this;
    }

    /**
     * Get ptd
     *
     * @return string 
     */
    public function getPtd()
    {
        return $this->ptd;
    }
}