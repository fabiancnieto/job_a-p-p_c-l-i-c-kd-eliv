<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Profile;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="usr_email_UNIQUE", columns={"usr_email"})}, indexes={@ORM\Index(name="fk_user_profile_fk_idx", columns={"pru_id"})})
 * @ORM\Entity
 * @UniqueEntity(fields="usrEmail", message="This email address is already in use!!")
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usrId;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_first_name", type="string", length=50, nullable=true)
     */
    private $usrFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_last_name", type="string", length=50, nullable=true)
     */
    private $usrLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_full_name", type="string", length=100, nullable=true)
     */
    private $usrFullName;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_email", type="string", length=150, nullable=false)
     */
    private $usrEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_phone_number", type="string", length=45, nullable=true)
     */
    private $usrPhoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_password", type="string", length=200, nullable=false)
     */
    private $usrPassword;
    
    /**
     * @var string
     *
     * @Assert\Length(max=4096)
     */
    private $usrPlainPassword;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usr_state", type="boolean", nullable=true)
     */
    private $usrState = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="usr_grant_list", type="boolean", nullable=true)
     */
    private $usrGrantList;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="usr_creation_date", type="date", nullable=true)
     */
    private $usrCreationDate;

    /**
     * @var \AppBundle\Entity\Profile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Profile", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pru_id", referencedColumnName="pru_id")
     * })
     */
    private $pru;

    public function __construct()
    {
         $this->usrCreationDate = new \DateTime();
    }
    /**
     * Get usrId
     *
     * @return integer
     */
    public function getUsrId()
    {
        return $this->usrId;
    }

    /**
     * Set usrFirstName
     *
     * @param string $usrFirstName
     *
     * @return User
     */
    public function setUsrFirstName($usrFirstName)
    {
        $this->usrFirstName = strtoupper($usrFirstName);

        return $this;
    }

    /**
     * Get usrFirstName
     *
     * @return string
     */
    public function getUsrFirstName()
    {
        return $this->usrFirstName;
    }

    /**
     * Set usrLastName
     *
     * @param string $usrLastName
     *
     * @return User
     */
    public function setUsrLastName($usrLastName)
    {
        $this->usrLastName = strtoupper($usrLastName);

        return $this;
    }

    /**
     * Get usrLastName
     *
     * @return string
     */
    public function getUsrLastName()
    {
        return $this->usrLastName;
    }

    /**
     * Set usrFullName
     *
     * @param string $usrFullName
     *
     * @return User
     */
    public function setUsrFullName($usrFullName = "")
    {
        $this->usrFullName = strtoupper($this->usrFirstName." ".$this->usrLastName);

        return $this;
    }

    /**
     * Get usrFullName
     *
     * @return string
     */
    public function getUsrFullName()
    {
        return $this->usrFullName;
    }

    /**
     * Set usrEmail
     *
     * @param string $usrEmail
     *
     * @return User
     */
    public function setUsrEmail($usrEmail)
    {
        $this->usrEmail = $usrEmail;

        return $this;
    }

    /**
     * Get usrEmail
     *
     * @return string
     */
    public function getUsrEmail()
    {
        return $this->usrEmail;
    }

    /**
     * Set usrPhoneNumber
     *
     * @param string $usrPhoneNumber
     *
     * @return User
     */
    public function setUsrPhoneNumber($usrPhoneNumber)
    {
        $this->usrPhoneNumber = $usrPhoneNumber;

        return $this;
    }

    /**
     * Get usrPhoneNumber
     *
     * @return string
     */
    public function getUsrPhoneNumber()
    {
        return $this->usrPhoneNumber;
    }

    /**
     * Set usrPassword
     *
     * @param string $usrPassword
     *
     * @return User
     */
    public function setUsrPassword($usrPassword)
    {
        $this->usrPassword = $usrPassword;

        return $this;
    }

    /**
     * Get usrPassword
     *
     * @return string
     */
    public function getUsrPassword()
    {
        return $this->usrPassword;
    }

    /**
     * Set usrState
     *
     * @param boolean $usrState
     *
     * @return User
     */
    public function setUsrState($usrState)
    {
        $this->usrState = $usrState;

        return $this;
    }

    /**
     * Get usrState
     *
     * @return boolean
     */
    public function getUsrState()
    {
        return $this->usrState;
    }

    /**
     * Set usrGrantList
     *
     * @param boolean $usrGrantList
     *
     * @return User
     */
    public function setUsrGrantList($usrGrantList)
    {
        $this->usrGrantList = $usrGrantList;

        return $this;
    }

    /**
     * Get usrGrantList
     *
     * @return boolean
     */
    public function getUsrGrantList()
    {
        return $this->usrGrantList;
    }

    /**
     * Set usrCreationDate
     *
     * @param \DateTime $usrCreationDate
     *
     * @return User
     */
    public function setUsrCreationDate($usrCreationDate)
    {
        $this->usrCreationDate = new \DateTime($usrCreationDate);

        return $this;
    }

    /**
     * Get usrCreationDate
     *
     * @return \DateTime
     */
    public function getUsrCreationDate()
    {
        return $this->usrCreationDate;
    }

    /**
     * Set pru
     *
     * @param \AppBundle\Entity\Profile $pru
     *
     * @return User
     */
    public function setPru(\AppBundle\Entity\Profile $pru = null)
    {
        $this->pru = $pru;

        return $this;
    }

    /**
     * Get pru
     *
     * @return \AppBundle\Entity\Profile
     */
    public function getPru()
    {
        return $this->pru;
    }
    
    /**
     * Get salt
     *
     * 
     */
    public function getSalt()
    {
        null;
    }

    /**
     * Set Roles
     *
     * 
     */
    public function setRoles($profile)
    {
        return setPru($profile);
    }
    
    /**
     * Get Roles
     *
     * 
     */
    public function getRoles()
    {
        if($this->pru->getPruId() == 5){
            return array('ROLE_ADMIN');
        } elseif($this->pru->getPruId() == 6){
            return array('ROLE_AGENT');
        } elseif($this->pru->getPruId() == 7){
            return array('ROLE_USER');
        }
    }

    /**
     * Set Plain Password
     *
     * 
     */
    public function setPlainPassword($usrPlainPassword)
    {
        $this->usrPlainPassword = $usrPlainPassword;
        return $this;
    }
    
    /**
     * Get Plain Password
     *
     * 
     */
    public function getPlainPassword()
    {
        return $this->usrPlainPassword;
    }
    
    /**
     * Set Password
     *
     * 
     */
    public function setPassword($usrPassword)
    {
        $this->setUsrPassword($usrPassword);
        return $this;
    }
    
    /**
     * Get Password
     *
     * 
     */
    public function getPassword()
    {
        return $this->getUsrPassword();
    }
    
    /**
     * Get UserName
     *
     * 
     */
    public function getUserName()
    {
        return $this->getUsrEmail();
    }
    
    /**
     * eraseCredentials
     *
     * 
     */
    public function eraseCredentials()
    {
    }

}