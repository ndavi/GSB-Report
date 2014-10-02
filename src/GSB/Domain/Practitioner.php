<?php

namespace GSB\Domain;

class Practitioner {

    /**
     * Practitioner id.
     *
     * @var integer
     */
    private $id;

    /**
     * Practitioner type id.
     *
     * @var integer
     */
    private $type_id;

    /**
     * Practitioner name.
     *
     * @var string
     */
    private $name;

    /**
     * Practitioner first name.
     *
     * @var string
     */
    private $first_name;

    /**
     * Practitioner address.
     *
     * @var string
     */
    private $address;

    /**
     * Practitioner zip code.
     *
     * @var string
     */
    private $zip_code;

    /**
     * Practitioner city.
     *
     * @var string
     */
    private $city;

    /**
     * Practitioner notoriety coefficient.
     *
     * @var decimal
     */
    private $notoriety_coefficient;
    
    /**
     * Type.
     *
     * @var \GSB\Domaine\Practitioner_type
     */
    private $type;
    
    public function getType() {
        return $this->type;
    }

    public function setType(\GSB\Domaine\Practitioner_type $type) {
        $this->type = $type;
    }

        public function getId() {
        return $this->id;
    }

    public function getType_id() {
        return $this->type_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getFirst_name() {
        return $this->first_name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getZip_code() {
        return $this->zip_code;
    }

    public function getCity() {
        return $this->city;
    }

    public function getNotoriety_coefficient() {
        return $this->notoriety_coefficient;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setType_id($type_id) {
        $this->type_id = $type_id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setFirst_name($first_name) {
        $this->first_name = $first_name;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setZip_code($zip_code) {
        $this->zip_code = $zip_code;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setNotoriety_coefficient(decimal $notoriety_coefficient) {
        $this->notoriety_coefficient = $notoriety_coefficient;
    }

}
