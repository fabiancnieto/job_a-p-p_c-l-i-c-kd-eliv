<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity
 */
class Profile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pru_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pruId;

    /**
     * @var string
     *
     * @ORM\Column(name="pru_name", type="string", length=45, nullable=true)
     */
    private $pruName;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id_create", type="integer", nullable=true)
     */
    private $usrIdCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="pru", cascade={"persist"})
     */
    private $users;

    public function __construct()
    {
      $this->users = new ArrayCollection();
      $this->dateCreated = new \DateTime();
    }

    /**
     * Get pruId
     *
     * @return integer
     */
    public function getPruId()
    {
        return $this->pruId;
    }

    /**
     * Set pruName
     *
     * @param string $pruName
     *
     * @return Profile
     */
    public function setPruName($pruName)
    {
        $this->pruName = $pruName;

        return $this;
    }

    /**
     * Get pruName
     *
     * @return string
     */
    public function getPruName()
    {
        return $this->pruName;
    }

    /**
     * Set usrIdCreate
     *
     * @param integer $usrIdCreate
     *
     * @return Profile
     */
    public function setUsrIdCreate($usrIdCreate)
    {
        $this->usrIdCreate = $usrIdCreate;

        return $this;
    }

    /**
     * Get usrIdCreate
     *
     * @return integer
     */
    public function getUsrIdCreate()
    {
        return $this->usrIdCreate;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Profile
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }
}
