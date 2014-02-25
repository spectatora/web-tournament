<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Teachers
 *
 * @ORM\Table(name="teachers", indexes={@ORM\Index(name="teacher_school_id_idx", columns={"schoolId"})})
 * @ORM\Entity
 */
class Teachers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="teacherId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $teacherid;

    /**
     * @var string
     *
     * @ORM\Column(name="teacherNames", type="string", length=256, nullable=true)
     */
    private $teachernames;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=512, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=256, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=256, nullable=true)
     */
    private $phone;

    /**
     * @var \Schools
     *
     * @ORM\ManyToOne(targetEntity="Schools")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="schoolId", referencedColumnName="schoolId")
     * })
     */
    private $schoolid;


}
