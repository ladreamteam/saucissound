<?php

namespace SaucisSound\Bundle\CommunityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SaucisSound\Bundle\CommunityBundle\Model\MemberInterface;

/**
 * Member
 */
class Member implements MemberInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return MemberInterface
     */
    public function setEmail($email)
    {
        $this->email = (string) $email;

        return $this;
    }

    /**
     * @param string $password the plain text password to verify
     *
     * @return boolean true if the password match the hashed password, false otherwise
     */
    public function isPasswordValid($password)
    {
        return password_verify((string) $password, $this->getPassword());
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return MemberInterface
     */
    public function setPassword($password)
    {
        $this->password = password_hash((string) $password, PASSWORD_DEFAULT);

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return MemberInterface
     */
    public function setUsername($username)
    {
        $this->username = (string) $username;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
