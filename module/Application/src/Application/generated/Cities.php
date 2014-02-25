<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Cities
 *
 * @ORM\Table(name="cities", indexes={@ORM\Index(name="areaLink_idx", columns={"areaId"})})
 * @ORM\Entity
 */
class Cities
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cityId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cityid;

    /**
     * @var string
     *
     * @ORM\Column(name="cityName", type="string", length=256, nullable=true)
     */
    private $cityname;

    /**
     * @var \Areas
     *
     * @ORM\ManyToOne(targetEntity="Areas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="areaId", referencedColumnName="areaId")
     * })
     */
    private $areaid;


}
