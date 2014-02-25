<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Tournamentorganizatorroles
 *
 * @ORM\Table(name="tournamentOrganizatorRoles")
 * @ORM\Entity
 */
class Tournamentorganizatorroles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtournamentOrganizatorRoles", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtournamentorganizatorroles;

    /**
     * @var string
     *
     * @ORM\Column(name="tournamentOrganizatorRoleName", type="string", length=128, nullable=true)
     */
    private $tournamentorganizatorrolename;


}
