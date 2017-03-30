<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegisterLog
 *
 * @ORM\Table(name="register_log", indexes={@ORM\Index(name="fk_register_log_user_idx", columns={"usr_id"})})
 * @ORM\Entity
 */
class RegisterLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="reg_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $regId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="request_date", type="datetime", nullable=true)
     */
    private $requestDate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="response_date", type="datetime", nullable=true)
     */
    private $responseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=45, nullable=true)
     */
    private $hash;

    /**
     * @var \AppBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usr_id", referencedColumnName="usr_id")
     * })
     */
    private $usr;



    /**
     * Get regId
     *
     * @return integer
     */
    public function getRegId()
    {
        return $this->regId;
    }

    /**
     * Set requestDate
     *
     * @param \DateTime $requestDate
     *
     * @return RegisterLog
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * Get requestDate
     *
     * @return \DateTime
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

    /**
     * Set responseDate
     *
     * @param \DateTime $responseDate
     *
     * @return RegisterLog
     */
    public function setResponseDate($responseDate)
    {
        $this->responseDate = $responseDate;

        return $this;
    }

    /**
     * Get responseDate
     *
     * @return \DateTime
     */
    public function getResponseDate()
    {
        return $this->responseDate;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return RegisterLog
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set usr
     *
     * @param \AppBundle\Entity\User $usr
     *
     * @return RegisterLog
     */
    public function setUsr(\AppBundle\Entity\User $usr = null)
    {
        $this->usr = $usr;

        return $this;
    }

    /**
     * Get usr
     *
     * @return \AppBundle\Entity\User
     */
    public function getUsr()
    {
        return $this->usr;
    }
}
