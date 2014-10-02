<?php

namespace GSB\DAO;

use GSB\Domain\PractitionerType;

class PractitionerTypeDAO extends DAO {

    /**
     * Returns the list of all practitioner type, sorted by name.
     *
     * @return array The list of all type of practitioners.
     */
    public function findAll() {
        $sql = "select * from practitioner_type order by practitioner_type_name";
        $result = $this->getDb()->fetchAll($sql);

        // Converts query result to an array of domain objects
        $practitionerType = array();
        foreach ($result as $row) {
            $practitionerTypeId = $row['practitioner_type_id'];
            $practitionerTypes[$practitionerTypeId] = $this->buildDomainObject($row);
        }
        return $practitionerTypes;
    }
    
    /**
     * Returns the practitioner type matching the given id.
     *
     * @param integer $id The practitioner id.
     *
     * @return \GSB\Domain\Practitioner_type|throws an exception if no family is found.
     */
    public function find($id) {
        $sql = "select * from practitioner_type where practitioner_type_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No practitioner type found for id " . $id);
    }
    
    /**
     * Creates a Pratictioner type instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\Practitioner_type
     */
    protected function buildDomainObject($row) {
        $practitioner_type = new PractitionerType();
        $practitioner_type->setId($row['practitioner_type_id']);
        $practitioner_type->setName($row['practitioner_type_name']);
        $practitioner_type->setPlace($row['practitioner_type_place']);
        return $practitioner_type;
    }

}
