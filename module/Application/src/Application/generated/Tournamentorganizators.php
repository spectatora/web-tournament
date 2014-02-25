<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Tournamentorganizators
 *
 * @ORM\Table(name="tournamentOrganizators", indexes={@ORM\Index(name="organizatorsRoleName_idx", columns={"tournamentOrganizatorRoleId"}), @ORM\Index(name="universityPerson_idx", columns={"universityRepresentativeId"}), @ORM\Index(name="IDX_9451AE47BFFDBB45", columns={"tournamentId"})})
 * @ORM\Entity
 */
class Tournamentorganizators
{
    /**
     * @var \Tournamentorganizatorroles
     *
     * @ORM\ManyToOne(targetEntity="Tournamentorganizatorroles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tournamentOrganizatorRoleId", referencedColumnName="idtournamentOrganizatorRoles")
     * })
     */
    private $tournamentorganizatorroleid;

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

    /**
     * @var \Universityrepresentative
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Universityrepresentative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="universityRepresentativeId", referencedColumnName="universityRepresentativeId")
     * })
     */
    private $universityrepresentativeid;


}
