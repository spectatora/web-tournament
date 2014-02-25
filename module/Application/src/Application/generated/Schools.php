<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Schools
 *
 * @ORM\Table(name="schools", indexes={@ORM\Index(name="cityId_idx", columns={"cityId"}), @ORM\Index(name="financialType_idx", columns={"financialTypeId"})})
 * @ORM\Entity
 */
class Schools
{
    /**
     * @var integer
     *
     * @ORM\Column(name="schoolId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $schoolid;

    /**
     * @var string
     *
     * @ORM\Column(name="schoolName", type="string", length=256, nullable=true)
     */
    private $schoolname;

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
     * @var \Schoolfinancialtypes
     *
     * @ORM\ManyToOne(targetEntity="Schoolfinancialtypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="financialTypeId", referencedColumnName="schoolFinancialTypeId")
     * })
     */
    private $financialtypeid;


}
