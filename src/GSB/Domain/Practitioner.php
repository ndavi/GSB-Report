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
     * @var double
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

    public function setType(PractitionerType $type) {
        $this->type = $type;
    }

        public function getId() {
        return $this->id;
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

    public function setNotoriety_coefficient($notoriety_coefficient) {
        $this->notoriety_coefficient = $notoriety_coefficient;
    }

}
