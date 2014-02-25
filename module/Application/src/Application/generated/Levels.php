<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Levels
 *
 * @ORM\Table(name="levels")
 * @ORM\Entity
 */
class Levels
{
    /**
     * @var integer
     *
     * @ORM\Column(name="levelId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $levelid;

    /**
     * @var string
     *
     * @ORM\Column(name="levelName", type="string", length=45, nullable=true)
     */
    private $levelname;


}
