<?php
namespace Application\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\Form\Annotation;
use Application\Model\PasswordAwareInterface;
use Zend\Crypt\Password\PasswordInterface;

/**
 * Annotation\Name("users")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 *
 * @ORM\Entity @ORM\Table(name="users")
 */
class User implements PasswordAwareInterface
{
    /**
     * @Annotation\Exclude()
     *
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     */
    protected $userId;

    /**
     * @Annotation\Exclude()
     *
     * @ORM\Column(type="string")
     */
    protected $role;

    /**
    * @Annotation\Type("Zend\Form\Element\Email")
    * @Annotation\Validator({"name":"EmailAddress"})
    * @Annotation\Options({"label":"Email:"})
    * @Annotation\Attributes({"type":"email","required": true,"placeholder": "Email Address..."})
    * @Annotation\Flags({"priority": "500"})
    *
    * @ORM\Column(type="string")
    */
    protected $email;

    /**
     * @Annotation\Type("Zend\Form\Element\Password")
     * @Annotation\Filter({"name":"StripTags"})
     * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Options({"label":"Password:", "priority": "400"})
     * @Annotation\Flags({"priority": "400"})
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @Annotation\Exclude()
     * @var PasswordInterface
     */
    protected $adapter;

    /**
     * @return the $userId
     */
    public function getUserId()
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
     * @return the $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param field_type $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
     * @param field_type $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        if(isset($photo['tmp_name'])) {
            $this->photo = $photo['tmp_name'];
        }
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
