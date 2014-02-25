<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Tournaments
 *
 * @ORM\Table(name="tournaments")
 * @ORM\Entity
 */
class Tournaments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tournamentId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tournamentid;

    /**
     * @var string
     *
     * @ORM\Column(name="tournamentName", type="string", length=256, nullable=true)
     */
    private $tournamentname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="eventDate", type="date", nullable=true)
     */
    private $eventdate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Participants", mappedBy="tournamentid")
     */
    private $participantid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participantid = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
