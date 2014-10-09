<?php

namespace GSB\Domain;

use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

class Visitor implements UserInterface {

    /**
     * Visitor id
     *
     * @var integer
     */
    private $id;

    /**
     * Visitor sector id
     *
     * @var integer
     */
    private $sectorId;

    /**
     * Visitor laboratory id.
     *
     * @var int
     */
    private $laboratoryId;

    /**
     * Visitor last name
     *
     * @var string
     */
    private $lastName;

    /**
     * Visitor first name
     *
     * @var string
     */
    private $firstName;

    /**
     * Visitor address
     *
     * @var string
     */
    private $address;

    /**
     * Visitor zip code
     *
     * @var string
     */
    private $zipCode;

    /**
     * Visitor city
     *
     * @var string
     */
    private $city;

    /**
     * Visitor hiring date
     *
     * @class DateTime
     */
    private $hiringDate;

    /**
     * Visitor username
     *
     * @var string
     */
    private $username;

    /**
     * Visitor password hashed 
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;

    /**
     * 
     * Visitor type
     *
     * @var string
     */
    private $visitorType;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles() {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }

    public function getSectorId() {
        return $this->sectorId;
    }

    public function getLaboratoryId() {
        return $this->laboratoryId;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getHiringDate() {
        return $this->hiringDate;
    }

    public function getVisitorType() {
        return $this->visitorType;
    }

    public function setSectorId($sectorId) {
        $this->sectorId = $sectorId;
    }

    public function setLaboratoryId($laboratoryId) {
        $this->laboratoryId = $laboratoryId;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setHiringDate($hiringDate) {
        $this->hiringDate = new DateTime($hiringDate);
    }

    public function setVisitorType($visitorType) {
        $this->visitorType = $visitorType;
    }

}
