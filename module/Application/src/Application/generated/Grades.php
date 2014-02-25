<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Grades
 *
 * @ORM\Table(name="grades")
 * @ORM\Entity
 */
class Grades
{
    /**
     * @var integer
     *
     * @ORM\Column(name="gradeId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gradeid;

    /**
     * @var string
     *
     * @ORM\Column(name="gradeName", type="string", length=45, nullable=true)
     */
    private $gradename;


}
