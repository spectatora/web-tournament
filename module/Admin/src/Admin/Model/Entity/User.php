<?php
namespace Admin\Model\Entity;

use Zend\Form\Annotation;
use Admin\Model\PasswordAwareInterface;
use Zend\Crypt\Password\PasswordInterface;

/**
 * @Annotation\Name("users")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 *
 * @Entity @Table(name="users")
 */
class User implements PasswordAwareInterface
{
    /**
     * @Annotation\Exclude()
     *
     * @Id @GeneratedValue @Column(type="integer")
     */
    protected $userId;

    /**
     * @Annotation\Exclude()
     *
     * @Column(type="string")
     */
    protected $role;

    /**
    * @Annotation\Type("Zend\Form\Element\Email")
    * @Annotation\Validator({"name":"EmailAddress"})
    * @Annotation\Options({"label":"Email:"})
    * @Annotation\Attributes({"type":"email","required": true,"placeholder": "Email Address..."})
    * @Annotation\Flags({"priority": "500"})
    *
    * @Column(type="string")
    */
    protected $email;

    /**
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Options({"label":"Password:", "priority": "400"})
     * @Annotation\Flags({"priority": "400"})
     *
     * @Column(type="string")
     */
    protected $password;

    
    /**
     * @Annotation\Exclude()
     * @var PasswordInterface
     */
    protected $adapter;

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->userId;
    }

    /**
     * @return the $role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param field_type $id
     */
    public function setId($id)
    {
        $this->userId = $id;
    }

    /**
     * @param field_type $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @param field_type $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Gets the current password hash
     *
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $this->hashPassword($password);
    }

    /**
     * Verifies if the provided password matches the stored one.
     *
     * @param string $password clear text password
     * @return boolean
     */
    public function verifyPassword($password)
    {
        return $this->adapter->verify($password, $this->password);
    }

    /**
     * Hashes a password
     * @param string $password
     * @return string
     */
    private function hashPassword($password)
    {
        return $this->adapter->create($password);
    }

    /**
     * Sets the password adapter
     * @param PasswordInterface $adapter
     */
    public function setPasswordAdapter(PasswordInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Gets the password adapter
     * @return PasswordInterface
     */
    public function getPasswordAdapter()
    {
        return $this->adapter;
    }

}
