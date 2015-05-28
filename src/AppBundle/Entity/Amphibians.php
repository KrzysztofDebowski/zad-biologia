<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Amphibians
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Amphibians
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
     * @ORM\Column(name="amphibians", type="string", length=255)
     */
    private $amphibians;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;


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
     * Set amphibians
     *
     * @param string $amphibians
     * @return Amphibians
     */
    public function setAmphibians($amphibians)
    {
        $this->amphibians = $amphibians;

        return $this;
    }

    /**
     * Get amphibians
     *
     * @return string 
     */
    public function getAmphibians()
    {
        return $this->amphibians;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Amphibians
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }
}
