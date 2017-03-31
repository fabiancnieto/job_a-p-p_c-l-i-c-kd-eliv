<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrackLogin
 *
 * @ORM\Table(name="track_login", indexes={@ORM\Index(name="fk_tracklogin_user_idx", columns={"usr_id"})})
 * @ORM\Entity
 */
class TrackLogin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="trk_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $trkId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pru_id", type="integer", nullable=true)
     */
    private $pruId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="trk_date", type="datetime", nullable=true)
     */
    private $trkDate = 'CURRENT_TIMESTAMP';

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
     * Get trkId
     *
     * @return integer
     */
    public function getTrkId()
    {
        return $this->trkId;
    }

    /**
     * Set pruId
     *
     * @param integer $pruId
     *
     * @return TrackLogin
     */
    public function setPruId($pruId)
    {
        $this->pruId = $pruId;

        return $this;
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
     * Set trkDate
     *
     * @param \DateTime $trkDate
     *
     * @return TrackLogin
     */
    public function setTrkDate($trkDate)
    {
        $this->trkDate = $trkDate;

        return $this;
    }

    /**
     * Get trkDate
     *
     * @return \DateTime
     */
    public function getTrkDate()
    {
        return $this->trkDate;
    }

    /**
     * Set usr
     *
     * @param \AppBundle\Entity\User $usr
     *
     * @return TrackLogin
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
