<?php

namespace GSB\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use GSB\Domain\Visitor;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class VisitorDAO extends DAO implements UserProviderInterface {

    /**
     * Returns a visitor matching the supplied id.
     *
     * @param integer $id
     *
     * @return GSB\Domain\Visitor|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from visitor where visitor_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No visitor matching id " . $id);
    }

    /**
     * Save an visitor with new values
     *
     * @param GSB\Domain\Visitor
     *
     */
    public function save($visitor) {
        $visitorData = array(
            'visitor_last_name' => $visitor->getLastName(),
            'visitor_first_name' => $visitor->getFirstName(),
            'visitor_address' => $visitor->getAddress(),
            'visitor_zip_code' => $visitor->getZipCode(),
            'visitor_city' => $visitor->getCity(),
            'hiring_date' => $visitor->getHiringDate(),
            'user_name' => $visitor->getUsername(),
            'password' => $visitor->getPassword()
        );
        $this->getDb()->update('visitor', $visitorData, array('visitor_id' => $visitor->getId()));
    }

    /**
     * {@inheritDoc}
     */
    public function loadUserByUsername($username) {
        $sql = "select * from visitor where user_name=?";
        $row = $this->getDb()->fetchAssoc($sql, array($username));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $user) {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class) {
        return 'GSB\Domain\Visitor' === $class;
    }

    /**
     * Creates a Visitor object based on a DB row.
     *
     * @param array $row The DB row containing Visitor data.
     * @return GSB\Domain\Visitor
     */
    protected function buildDomainObject($row) {
        $visitor = new Visitor();
        $visitor->setId($row['visitor_id']);
        $visitor->setSectorId($row['sector_id']);
        $visitor->setLaboratoryId($row['laboratory_id']);
        $visitor->setLastName($row['visitor_last_name']);
        $visitor->setFirstName($row['visitor_first_name']);
        $visitor->setAddress($row['visitor_address']);
        $visitor->setZipCode($row['visitor_zip_code']);
        $visitor->setCity($row['visitor_city']);
        $visitor->setHiringDate($row['hiring_date']);
        $visitor->setUsername($row['user_name']);
        $visitor->setPassword($row['password']);
        $visitor->setSalt($row['salt']);
        $visitor->setRole($row['role']);
        $visitor->setVisitorType($row['visitor_type']);
        return $visitor;
    }

}
