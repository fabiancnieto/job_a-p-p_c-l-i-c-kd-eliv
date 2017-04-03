<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agent
 *
 * @ORM\Table(name="agent", indexes={@ORM\Index(name="fk_agent_user_fk_idx", columns={"usr_id"})})
 * @ORM\Entity
 */
class Agent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="agt_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $agtId;

    /**
     * @var string
     *
     * @ORM\Column(name="agt_email", type="string", length=150, nullable=false)
     */
    private $agtEmail;

    /**
     * @var boolean
     *
     * @ORM\Column(name="agt_state", type="boolean", nullable=true)
     */
    private $agtState;


    /**
     * Get agtId
     *
     * @return integer
     */
    public function getAgtId()
    {
        return $this->agtId;
    }

    /**
     * Set agtEmail
     *
     * @param string $agtEmail
     *
     * @return Agent
     */
    public function setAgtEmail($agtEmail)
    {
        $this->agtEmail = $agtEmail;

        return $this;
    }

    /**
     * Get agtEmail
     *
     * @return string
     */
    public function getAgtEmail()
    {
        return $this->agtEmail;
    }

    /**
     * Set agtState
     *
     * @param boolean $agtState
     *
     * @return Agent
     */
    public function setAgtState($agtState)
    {
        $this->agtState = $agtState;

        return $this;
    }

    /**
     * Get agtState
     *
     * @return boolean
     */
    public function getAgtState()
    {
        return $this->agtState;
    }

}
