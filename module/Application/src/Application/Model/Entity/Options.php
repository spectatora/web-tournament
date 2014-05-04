<?php
namespace Application\Model\Entity;


/**
 * @Annotation\Name("options")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 *
 * @Entity @Table(name="options")
 */
class Options
{
    /**
     * @Annotation\Exclude()
     *
     * @Id @GeneratedValue @Column(type="integer")
     */
    protected $optionId;

    /**
     * @Annotation\Exclude()
     *
     * @Column(type="string")
     */
    protected $optionName;

    /**
     * @Annotation\Exclude()
     * 
     * @Column(type="string")
     */
    protected $optionValue;
    
    /**
     * @Annotation\Exclude()
     * 
     * @Column(type="string")
     */
    protected $optionCategory;
	/**
	 * @return the $optionId
	 */
	public function getOptionId() {
		return $this->optionId;
	}

	/**
	 * @return the $optionName
	 */
	public function getOptionName() {
		return $this->optionName;
	}

	/**
	 * @return the $optionValue
	 */
	public function getOptionValue() {
		return $this->optionValue;
	}

	/**
	 * @return the $optionCategory
	 */
	public function getOptionCategory() {
		return $this->optionCategory;
	}

	/**
	 * @param field_type $optionId
	 */
	public function setOptionId($optionId) {
		$this->optionId = $optionId;
	}

	/**
	 * @param field_type $optionName
	 */
	public function setOptionName($optionName) {
		$this->optionName = $optionName;
	}

	/**
	 * @param field_type $optionValue
	 */
	public function setOptionValue($optionValue) {
		$this->optionValue = $optionValue;
	}

	/**
	 * @param field_type $optionCategory
	 */
	public function setOptionCategory($optionCategory) {
		$this->optionCategory = $optionCategory;
	}


    
}
