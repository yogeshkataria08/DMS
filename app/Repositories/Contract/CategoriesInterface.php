<?php namespace App\Repositories\Contract;

/**
 * Interface CategoriesInterface
 * @package App\Repositories\Contract
 */
interface CategoriesInterface
{
    /**
     *  Get the fields for Categories list
     *
     * @return mixed
     */
    public function getCollection();

    /**
     *  Get the fields for Categories list
     *
     * @return mixed
     */
    public function getDatatableCollection();

    /**
     * get Categories By fieldname getCategoriesByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getCategoriesByField($id, $field_name);

    /**
     * Add & update Categories addCategories
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addCategories($models);
    
    /**
     * Delete Categories
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteCategories($id);
}
