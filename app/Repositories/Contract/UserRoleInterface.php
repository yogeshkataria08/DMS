<?php namespace App\Repositories\Contract;

/**
 * Interface UserRoleInterface
 * @package App\Repositories\Contract
 */
interface UserRoleInterface
{
    /**
     *  Get the fields for UserRole list
     *
     * @return mixed
     */
    public function getCollection();

    /**
     *  Get the fields for UserRole list
     *
     * @return mixed
     */
    public function getDatatableCollection();

    /**
     * get UserRole By fieldname getUserRoleByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getUserRoleByField($id, $field_name);

    /**
     * Add & update UserRole addUserRole
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addUserRole($models);
    
    /**
     * Delete UserRole
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteUserRole($id);
}
