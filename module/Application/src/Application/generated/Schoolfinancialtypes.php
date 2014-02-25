<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Schoolfinancialtypes
 *
 * @ORM\Table(name="schoolFinancialTypes")
 * @ORM\Entity
 */
class Schoolfinancialtypes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="schoolFinancialTypeId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $schoolfinancialtypeid;

    /**
     * @var string
     *
     * @ORM\Column(name="schoolFinancialType", type="string", length=256, nullable=true)
     */
    private $schoolfinancialtype;


}
