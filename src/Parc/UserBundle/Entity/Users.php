<?php
namespace Parc\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="users")
*/
	class Users extends BaseUser
	{
		/**
		* @ORM\Id
		* @ORM\Column(type="integer")
		* @ORM\GeneratedValue(strategy="AUTO")
		*/
		protected $id;
		
		/**
		 * @var string
		 * @ORM\Column(name="nom", type="string", length=255, nullable=true)
		 */
		protected $nom;
		
		/**
		 * @var string
		 * @ORM\Column(name="lieudit", type="string", length=255, nullable=true)
		 */
		protected $lieudit;
		
		/**
		 * @var string
		 */
		protected $roleStr;
		
		 /**
		 * @var boolean
		 *
		 * @ORM\Column(name="mdpChanged", type="boolean", nullable=true)
		 */
		private $mdpChanged;
		
		public function __construct()
		{
			 $this->mdpChanged = false;
			parent::__construct();
			// your own logic
		}
		
		/**
		 * Set nom
		 *
		 * @param string $nom
		 * @return Users
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
     * @return Users
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
     * Set roleStr
     *
     * @param string $roleStr
     * @return Users
     */
    public function setRoleStr($roleStr)
    {
        $this->roleStr = $roleStr;
    
        return $this;
    }

    /**
     * Get roleStr
     *
     * @return string 
     */
    public function getRoleStr()
    {
        return $this->roleStr;
    }
	
	 public function isMdpChanged()
    {
        return $this->mdpChanged;
    }
	
	public function setMdpChanged($boolean)
    {
        $this->mdpChanged = (Boolean) $boolean;

        return $this;
    }
}