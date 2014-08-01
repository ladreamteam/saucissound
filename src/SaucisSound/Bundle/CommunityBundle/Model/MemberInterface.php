<?php

namespace SaucisSound\Bundle\CommunityBundle\Model;

/**
 * Interface MemberInterface
 * @package SaucisSound\Bundle\CommunityBundle\Model
 */
interface MemberInterface
{
    /**
     * Compares the plain text password to the hashed one for
     * the current Member.
     *
     * @param string $password the plain text password to verify.
     *
     * @return boolean true if the password match the hashed password, false otherwise.
     */
    public function isPasswordValid($password);

    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $username
     *
     * @return MemberInterface
     */
    public function setUsername($username);

    /**
     * @param string $email
     *
     * @return MemberInterface
     */
    public function setEmail($email);

    /**
     * @param string $password
     *
     * @return MemberInterface
     */
    public function setPassword($password);
}