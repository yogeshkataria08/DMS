<?php namespace App\Repositories\Eloquent;

use App\Repositories\Contract\CategoriesInterface;
use App\Models\Categories;
use App\Traits\CommonModelTrait;


/**
 * Class CategoriesRepository
 *
 * @package App\Repositories\Eloquent
 */
class CategoriesRepository implements CategoriesInterface
{

    use CommonModelTrait;
    /**
     * Get all Categories getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return Categories::get();
    }

    /**
     * Get all Categories
     *
     * @return mixed
     */
    public function getDatatableCollection()
    {
        return Categories::with([]);
    }

    /**
     * use for sorting
     *
     * @return array
     */
    public function getSortFields($index)
    {
        $sortableFields = [
            "name",
            ""
        ];

        return $sortableFields[ $index ];
    }

    /**
     * get Categories By fieldname getCategoriesByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getCategoriesByField($id, $field_name)
    {
        return Categories::where($field_name, $id)->first();
    }

    /**
     * Add & update Categories addCategories
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addCategories($models)
    {
        if (isset($models['id'])) {
            $Categories = Categories::find($models['id']);
        } else {
            $Categories = new Categories;
            $Categories->created_at = date('Y-m-d H:i:s');            
        }
        
        $Categories->name = $models['name'];
        $Categories->description = $models['description'];
        $Categories->updated_at = date('Y-m-d H:i:s');
        $CategoriesId = $Categories->save();

        if ($CategoriesId) {
            return $Categories;
        } else {
            return false;
        }
    }

    /**
     * Delete Categories
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteCategories($id)
    {
        $delete = Categories::where('id', $id)->delete();
        if ($delete)
            return true;
        else
            return false;

    }
}
