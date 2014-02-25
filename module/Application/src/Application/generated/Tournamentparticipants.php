<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Tournamentparticipants
 *
 * @ORM\Table(name="tournamentParticipants", indexes={@ORM\Index(name="tournamentLink_idx", columns={"tournamentId"}), @ORM\Index(name="roomId_idx", columns={"roomId"}), @ORM\Index(name="IDX_BC31C1DEA3040FAD", columns={"participantId"})})
 * @ORM\Entity
 */
class Tournamentparticipants
{
    /**
     * @var integer
     *
     * @ORM\Column(name="appearance", type="integer", nullable=true)
     */
    private $appearance;

    /**
     * @var integer
     *
     * @ORM\Column(name="inRating", type="integer", nullable=true)
     */
    private $inrating;

    /**
     * @var \Participants
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Participants")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="participantId", referencedColumnName="participantId")
     * })
     */
    private $participantid;

    /**
     * @var \Rooms
     *
     * @ORM\ManyToOne(targetEntity="Rooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="roomId", referencedColumnName="roomId")
     * })
     */
    private $roomid;

    /**
     * @var \Tournaments
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Tournaments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tournamentId", referencedColumnName="tournamentId")
     * })
     */
    private $tournamentid;


}
