<?php

namespace GSB\DAO;

use GSB\Domain\Practitioner;

class PractitionerDAO extends GSB\DAO\DAO {

    /**
     * @var \GSB\DAO\Practitioner_typeDAO
     */
    private $typeDAO;

    public function setTypeDAO(\GSB\DAO\Practitioner_typeDAO $typeDAO) {
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
        $practitioner = array();
        foreach ($result as $row) {
            $practitionerId = $row['practitioner_id'];
            $practitioners[$practitionerId] = $this->buildDomainObject($row);
        }
        return $practitioners;
    }

    /**
     * Returns the list of all practitioner for a given type, sorted by trade name.
     *
     * @param integer $typeId The type id.
     *
     * @return array The list of practitioner.
     */
    public function findAllByFamily($typeId) {
        $sql = "select * from practitioner where practitioner_type_id=? order by practitioner_name";
        $result = $this->getDb()->fetchAll($sql, array($typeId));

        // Convert query result to an array of domain objects
        $practitioner = array();
        foreach ($result as $row) {
            $practitionerId = $row['drug_id'];
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
        $sql = "select * from practitioner where drug_id=?";
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
        $practitioner->setId(['practitioner_id']);
        $practitioner->setName('practitioner_name');
        $practitioner->setFirst_name('practitioner_first_name');
        $practitioner->setAddress('practitioner_address');
        $practitioner->setZip_code('practitioner_zip_code');
        $practitioner->setCity('practitioner_city');
        $practitioner->setNotoriety_coefficient('notoriety_coefficient');
        $practitioner->setType($type);
        return $drug;
    }

}
