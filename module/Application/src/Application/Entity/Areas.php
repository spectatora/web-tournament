<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Areas
 *
 * @ORM\Table(name="areas")
 * @ORM\Entity
 */
class Areas
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="areaId", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $areaid;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="areaName", type="string", length=256, nullable=true)
	 */
	private $areaname;


}
