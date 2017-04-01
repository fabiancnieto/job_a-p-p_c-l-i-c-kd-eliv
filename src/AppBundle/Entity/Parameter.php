<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parameter
 *
 * @ORM\Table(name="parameter")
 * @ORM\Entity
 */
class Parameter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="par_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $parId;

    /**
     * @var string
     *
     * @ORM\Column(name="par_string_value", type="string", length=45, nullable=true)
     */
    private $parStringValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="par_numeric_value", type="integer", nullable=true)
     */
    private $parNumericValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="par_state", type="integer", nullable=true)
     */
    private $parState;



    /**
     * Get parId
     *
     * @return integer
     */
    public function getParId()
    {
        return $this->parId;
    }

    /**
     * Set parStringValue
     *
     * @param string $parStringValue
     *
     * @return Parameter
     */
    public function setParStringValue($parStringValue)
    {
        $this->parStringValue = $parStringValue;

        return $this;
    }

    /**
     * Get parStringValue
     *
     * @return string
     */
    public function getParStringValue()
    {
        return $this->parStringValue;
    }

    /**
     * Set parNumericValue
     *
     * @param integer $parNumericValue
     *
     * @return Parameter
     */
    public function setParNumericValue($parNumericValue)
    {
        $this->parNumericValue = $parNumericValue;

        return $this;
    }

    /**
     * Get parNumericValue
     *
     * @return integer
     */
    public function getParNumericValue()
    {
        return $this->parNumericValue;
    }

    /**
     * Set parState
     *
     * @param integer $parState
     *
     * @return Parameter
     */
    public function setParState($parState)
    {
        $this->parState = $parState;

        return $this;
    }

    /**
     * Get parState
     *
     * @return integer
     */
    public function getParState()
    {
        return $this->parState;
    }
}
