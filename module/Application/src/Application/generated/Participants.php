<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Participants
 *
 * @ORM\Table(name="participants", indexes={@ORM\Index(name="cityIdLinkToCities_idx", columns={"cityId"}), @ORM\Index(name="schoolLink_idx", columns={"schoolId"}), @ORM\Index(name="gradeLink_idx", columns={"gradeId"}), @ORM\Index(name="levelId_idx", columns={"levelId"}), @ORM\Index(name="teacherLink_idx", columns={"teacherId"})})
 * @ORM\Entity
 */
class Participants
{
    /**
     * @var integer
     *
     * @ORM\Column(name="participantId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $participantid;

    /**
     * @var string
     *
     * @ORM\Column(name="participantNames", type="string", length=512, nullable=true)
     */
    private $participantnames;

    /**
     * @var integer
     *
     * @ORM\Column(name="approved", type="integer", nullable=true)
     */
    private $approved;

    /**
     * @var \Cities
     *
     * @ORM\ManyToOne(targetEntity="Cities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cityId", referencedColumnName="cityId")
     * })
     */
    private $cityid;

    /**
     * @var \Grades
     *
     * @ORM\ManyToOne(targetEntity="Grades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gradeId", referencedColumnName="gradeId")
     * })
     */
    private $gradeid;

    /**
     * @var \Levels
     *
     * @ORM\ManyToOne(targetEntity="Levels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="levelId", referencedColumnName="levelId")
     * })
     */
    private $levelid;

    /**
     * @var \Schools
     *
     * @ORM\ManyToOne(targetEntity="Schools")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="schoolId", referencedColumnName="schoolId")
     * })
     */
    private $schoolid;

    /**
     * @var \Teachers
     *
     * @ORM\ManyToOne(targetEntity="Teachers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="teacherId", referencedColumnName="teacherId")
     * })
     */
    private $teacherid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Tournaments", inversedBy="participantid")
     * @ORM\JoinTable(name="participantpoints",
     *   joinColumns={
     *     @ORM\JoinColumn(name="participantId", referencedColumnName="participantId")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="tournamentId", referencedColumnName="tournamentId")
     *   }
     * )
     */
    private $tournamentid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tournamentid = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
