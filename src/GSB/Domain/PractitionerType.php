<?php

namespace GSB\Domain;

class PractitionerType {

    /**
     * Practitioner type id.
     *
     * @var integer
     */
    private $id;

    /**
     * Practitioner type name.
     *
     * @var string
     */
    private $name;

    /**
     * Practitioner type place.
     *
     * @var string
     */
    private $place;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPlace() {
        return $this->place;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPlace($place) {
        $this->place = $place;
    }

}
