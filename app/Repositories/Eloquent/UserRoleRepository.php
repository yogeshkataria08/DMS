<?php namespace App\Repositories\Eloquent;

use App\Repositories\Contract\UserRoleInterface;
use App\Models\UserRole;
use App\Traits\CommonModelTrait;


/**
 * Class UserRoleRepository
 *
 * @package App\Repositories\Eloquent
 */
class UserRoleRepository implements UserRoleInterface
{

    use CommonModelTrait;
    /**
     * Get all UserRole getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return UserRole::whereNotIn('id', ['1'])->get();
    }

    /**
     * Get all UserRole
     *
     * @return mixed
     */
    public function getDatatableCollection()
    {
        return UserRole::with([]);
    }

    /**
     * use for sorting
     *
     * @return array
     */
    public function getSortFields($index)
    {
        $sortableFields = [
            "role",
            ""
        ];

        return $sortableFields[ $index ];
    }

    /**
     * get UserRole By fieldname getUserRoleByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getUserRoleByField($id, $field_name)
    {
        return UserRole::where($field_name, $id)->first();
    }

    /**
     * Add & update UserRole addUserRole
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addUserRole($models)
    {
        if (isset($models['id'])) {
            $UserRole = UserRole::find($models['id']);
        } else {
            $UserRole = new UserRole;
            $UserRole->created_at = date('Y-m-d H:i:s');            
        }
        
        $UserRole->name = $models['name'];
        $UserRole->description = $models['description'];
        $UserRole->updated_at = date('Y-m-d H:i:s');
        $UserRoleId = $UserRole->save();

        if ($UserRoleId) {
            return $UserRole;
        } else {
            return false;
        }
    }

    /**
     * Delete UserRole
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteUserRole($id)
    {
        $delete = UserRole::where('id', $id)->delete();
        if ($delete)
            return true;
        else
            return false;

    }
}
