<?php
namespace Application\Model\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Annotation\Name("areas")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 *
 * @Entity @Table(name="areas")
 */
class Areas
{
	/**
	 * @var integer
	 *
	 * @Column(name="areaId", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	private $areaid;

	/**
	 * @var string
	 *
	 * @Column(name="areaName", type="string", length=256, nullable=true)
	 */
	private $areaname;
	/**
	 * @return the $areaid
	 */
	public function getAreaid() {
		return $this->areaid;
	}

	/**
	 * @return the $areaname
	 */
	public function getAreaname() {
		return $this->areaname;
	}

	/**
	 * @param number $areaid
	 */
	public function setAreaid($areaid) {
		$this->areaid = $areaid;
	}

	/**
	 * @param string $areaname
	 */
	public function setAreaname($areaname) {
		$this->areaname = $areaname;
	}


}
