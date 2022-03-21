<?php namespace App\Http\Facades\Repository;

use App\Repositories\Contract\CategoriesInterface;

/**
 * Class CategoriesFacadeClass
 *
 */
class CategoriesFacadeClass
{

    protected $categories;
    /**
     * categories constructor.
     *
     * @param categoriesInterface $blockedAdjRepo
     */
    public function __construct(categoriesInterface $repo)
    {
        $this->categories = $repo;
    }

    /**
     * @return mixed
     */
    public function view() {
        $data['categoriesData'] = $this->categories->getCollection();
        $data['masterManagementTab'] = "active open";
        $data['categoriesTab'] = "active";
        return $data;
    }

    /**
     * @param $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function getDataTable($request) {

        // get the fields for categories list
        $categoriesData = $this->categories->getDatatableCollection();

        // get the filtered data of categories list
        $categoriesFilteredData = $this->categories->getFilteredData($categoriesData,$request);

        //  Sorting categories data base on requested sort order
        $categoriesCount = $this->categories->getCount($categoriesFilteredData);

        // Sorting categories data base on requested sort order
        $categoriesSortData = $this->categories->getSortData($categoriesFilteredData,$request);
        
        // get collection of categories
        $categoriesData = $this->categories->getData($categoriesSortData,$request);

        $appData = array();
        foreach ($categoriesData as $categoriesData) {
            $row = array();
            $row[] = $categoriesData->name;
            $row[] = $categoriesData->description;
            $row[] = view('datatable.action', ['module' => "categories",'id' => $categoriesData->id])->render();
            $appData[] = $row;
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $categoriesCount,
            'recordsFiltered' => $categoriesCount,
            'data' => $appData,
        ];
    }

    /**
     * @return mixed
     */
    public function create() {
        $data['masterManagementTab'] = "active open";
        $data['categoriesTab'] = "active";
        $data['categoriesData'] = $this->categories->getCollection();
        return $data;
    }

    /**
     * Display the specified categories.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['details'] = $this->categories->getcategoriesByField($id, 'id');
        $data['categoriesTab'] = "active";
        return $data;
    }
    
    /**
     * Store and Update categories in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insertAndUpdatecategories($requestData) {
        return $this->categories->addcategories($requestData);
    }


    /**
     * @param $id
     * @return bool
     */
    public function deletecategories($id) {
        return $this->categories->deletecategories($id);
    }
}