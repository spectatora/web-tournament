<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Universityrepresentative
 *
 * @ORM\Table(name="universityRepresentative", indexes={@ORM\Index(name="representativeRole_idx", columns={"universityRepresentativeRole"})})
 * @ORM\Entity
 */
class Universityrepresentative
{
    /**
     * @var integer
     *
     * @ORM\Column(name="universityRepresentativeId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $universityrepresentativeid;

    /**
     * @var string
     *
     * @ORM\Column(name="universityRepresentativeNames", type="string", length=512, nullable=true)
     */
    private $universityrepresentativenames;

    /**
     * @var \Universityrepresentativeroles
     *
     * @ORM\ManyToOne(targetEntity="Universityrepresentativeroles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="universityRepresentativeRole", referencedColumnName="universityRepresentativeRoleId")
     * })
     */
    private $universityrepresentativerole;


}
