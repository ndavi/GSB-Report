<?php

namespace GSB\DAO;

use GSB\Domain\Practitioner;

class PractitionerDAO extends DAO {

    /**
     * @var \GSB\DAO\Practitioner_typeDAO
     */
    private $typeDAO;

    public function setTypeDAO(PractitionerTypeDAO $typeDAO) {
        $this->typeDAO = $typeDAO;
    }

    /**
     * Returns the list of all practitioner, sorted by practitioner name.
     *
     * @return array The list of practitioner.
     */
    public function findAll() {
        $sql = "select * from practitioner order by practitioner_name";
        $result = $this->getDb()->fetchAll($sql);

        // Converts query result to an array of domain objects
        $practitioners = array();
        foreach ($result as $row) {
            $practitionerId = $row['practitioner_id'];
            $practitioners[$practitionerId] = $this->buildDomainObject($row);
        }
        return $practitioners;
    }

    /**
     * Returns the list of all practitioner for a given type, sorted by name.
     *
     * @param integer $typeId The type id.
     *
     * @return array The list of practitioner.
     */
    public function findAllByType($typeId) {
        $sql = "select * from practitioner where practitioner_type_id=? order by practitioner_name";
        $result = $this->getDb()->fetchAll($sql, array($typeId));

        // Convert query result to an array of domain objects
        $practitioners = array();
        foreach ($result as $row) {
            $practitionerId = $row['practitioner_id'];
            $practitioners[$practitionerId] = $this->buildDomainObject($row);
        }
        return $practitioners;
    }
    
    /**
     * Returns the list of all practitioner for a given city or/and name, sorted by name.
     *
     * @param string $city The city.
     * @param string $name The name.
     * 
     * @return array The list of practitioner.
     */
    public function findAllByNameOrAndCity($city = null,$name = null) {
        
        $sql = "select * from practitioner where practitioner_city LIKE ? and practitioner_name LIKE ? order by practitioner_name";
        $city = "%" . $city . "%";
        $name = "%" . $name . "%";
        $result = $this->getDb()->fetchAll($sql, array($city,$name));

        // Convert query result to an array of domain objects
        $practitioners = array();
        foreach ($result as $row) {
            $practitionerId = $row['practitioner_id'];
            $practitioners[$practitionerId] = $this->buildDomainObject($row);
        }
        return $practitioners;
    }

    /**
     * Returns the practitioner matching a given id.
     *
     * @param integer $id The practitioner id.
     *
     * @return \GSB\Domain\Practitioner|throws an exception if no drug is found.
     */
    public function find($id) {
        $sql = "select * from practitioner where practitioner_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No practitioner found for id " . $id);
    }

    /**
     * Creates a Practitioner instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\Practitioner
     */
    protected function buildDomainObject($row) {
        $type = $row['practitioner_type_id'];
        $type = $this->typeDAO->find($type);

        $practitioner = new Practitioner();
        $practitioner->setId($row['practitioner_id']);
        $practitioner->setName($row['practitioner_name']);
        $practitioner->setFirst_name($row['practitioner_first_name']);
        $practitioner->setAddress($row['practitioner_address']);
        $practitioner->setZip_code($row['practitioner_zip_code']);
        $practitioner->setCity($row['practitioner_city']);
        $practitioner->setNotoriety_coefficient($row['notoriety_coefficient']);
        $practitioner->setType($type);
        return $practitioner;
    }

}
