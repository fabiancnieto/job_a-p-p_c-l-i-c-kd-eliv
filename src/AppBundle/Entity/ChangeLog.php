<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChangeLog
 *
 * @ORM\Table(name="change_log", indexes={@ORM\Index(name="fk_changelog_users_fk_idx", columns={"usr_id"})})
 * @ORM\Entity
 */
class ChangeLog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="chl_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $chlId;

    /**
     * @var string
     *
     * @ORM\Column(name="chl_action", type="string", length=45, nullable=true)
     */
    private $chlAction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="chl_date", type="datetime", nullable=true)
     */
    private $chlDate = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="chl_row_before", type="string", length=1000, nullable=true)
     */
    private $chlRowBefore;

    /**
     * @var string
     *
     * @ORM\Column(name="chl_row_after", type="string", length=1000, nullable=true)
     */
    private $chlRowAfter;

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
     * Get chlId
     *
     * @return integer
     */
    public function getChlId()
    {
        return $this->chlId;
    }

    /**
     * Set chlAction
     *
     * @param string $chlAction
     *
     * @return ChangeLog
     */
    public function setChlAction($chlAction)
    {
        $this->chlAction = $chlAction;

        return $this;
    }

    /**
     * Get chlAction
     *
     * @return string
     */
    public function getChlAction()
    {
        return $this->chlAction;
    }

    /**
     * Set chlDate
     *
     * @param \DateTime $chlDate
     *
     * @return ChangeLog
     */
    public function setChlDate($chlDate)
    {
        $this->chlDate = $chlDate;

        return $this;
    }

    /**
     * Get chlDate
     *
     * @return \DateTime
     */
    public function getChlDate()
    {
        return $this->chlDate;
    }

    /**
     * Set chlRowBefore
     *
     * @param string $chlRowBefore
     *
     * @return ChangeLog
     */
    public function setChlRowBefore($chlRowBefore)
    {
        $this->chlRowBefore = $chlRowBefore;

        return $this;
    }

    /**
     * Get chlRowBefore
     *
     * @return string
     */
    public function getChlRowBefore()
    {
        return $this->chlRowBefore;
    }

    /**
     * Set chlRowAfter
     *
     * @param string $chlRowAfter
     *
     * @return ChangeLog
     */
    public function setChlRowAfter($chlRowAfter)
    {
        $this->chlRowAfter = $chlRowAfter;

        return $this;
    }

    /**
     * Get chlRowAfter
     *
     * @return string
     */
    public function getChlRowAfter()
    {
        return $this->chlRowAfter;
    }

    /**
     * Set usr
     *
     * @param \AppBundle\Entity\User $usr
     *
     * @return ChangeLog
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
