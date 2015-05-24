<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colonie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Parc\PuffinsBagBundle\Entity\ColonieRepository")
 */
class Colonie
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
     * @ORM\Column(name="colonie", type="string", length=255)
     */
    private $colonie;
	
	/**
     * @ORM\ManyToOne(targetEntity="Parc\PuffinsBagBundle\Entity\DonneesLocalisation", inversedBy="colonies")
	 * @ORM\JoinColumn(nullable=false)
	 */
    private $lieudit;

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
     * Set colonie
     *
     * @param string $colonie
     * @return Colonie
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
     * Set lieudit
     *
     * @param \Parc\PuffinsBagBundle\Entity\DonneesLocalisation $lieudit
     * @return Colonie
     */
    public function setLieudit(\Parc\PuffinsBagBundle\Entity\DonneesLocalisation $lieudit)
    {
        $this->lieudit = $lieudit;
    
        return $this;
    }

    /**
     * Get lieudit
     *
     * @return \Parc\PuffinsBagBundle\Entity\DonneesLocalisation 
     */
    public function getLieudit()
    {
        return $this->lieudit;
    }
}