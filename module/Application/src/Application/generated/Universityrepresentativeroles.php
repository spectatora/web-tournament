<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Universityrepresentativeroles
 *
 * @ORM\Table(name="universityRepresentativeRoles")
 * @ORM\Entity
 */
class Universityrepresentativeroles
{
    /**
     * @var integer
     *
     * @ORM\Column(name="universityRepresentativeRoleId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $universityrepresentativeroleid;

    /**
     * @var string
     *
     * @ORM\Column(name="universityRepresentativeRoleName", type="string", length=128, nullable=true)
     */
    private $universityrepresentativerolename;


}
