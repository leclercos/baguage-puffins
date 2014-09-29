<?php

namespace Parc\PuffinsBagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cartouche
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cartouche
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
     * @ORM\Column(name="userCrea", type="string", length=255)
     */
    private $userCrea;

    /**
     * @var string
     *
     * @ORM\Column(name="dateCrea", type="date")
     */
    private $dateCrea;

    /**
     * @var string
     *
     * @ORM\Column(name="userMaj", type="string", length=255, nullable=true)
     */
    private $userMaj;

    /**
     * @var string
     *
     * @ORM\Column(name="dateMaj", type="date", nullable=true)
     */
    private $dateMaj;

	public function __construct()
	{
		 $this->dateCrea	= new \Datetime();
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
     * Set userCrea
     *
     * @param string $userCrea
     * @return Cartouche
     */
    public function setUserCrea($userCrea)
    {
        $this->userCrea = $userCrea;
    
        return $this;
    }

    /**
     * Get userCrea
     *
     * @return string 
     */
    public function getUserCrea()
    {
        return $this->userCrea;
    }

    /**
     * Set dateCrea
     *
     * @param \Datetime $dateCrea
     * @return Cartouche
     */
    public function setDateCrea($dateCrea)
    {
        $this->dateCrea = $dateCrea;
    
        return $this;
    }

    /**
     * Get dateCrea
     *
     * @return \Datetime 
     */
    public function getDateCrea()
    {
        return $this->dateCrea;
    }

    /**
     * Set userMaj
     *
     * @param string $userMaj
     * @return Cartouche
     */
    public function setUserMaj($userMaj)
    {
        $this->userMaj = $userMaj;
    
        return $this;
    }

    /**
     * Get userMaj
     *
     * @return string 
     */
    public function getUserMaj()
    {
        return $this->userMaj;
    }

    /**
     * Set dateMaj
     *
     * @param \Datetime $dateMaj
     * @return Cartouche
     */
    public function setDateMaj($dateMaj)
    {
        $this->dateMaj = $dateMaj;
    
        return $this;
    }

    /**
     * Get dateMaj
     *
     * @return \Datetime 
     */
    public function getDateMaj()
    {
        return $this->dateMaj;
    }
}
