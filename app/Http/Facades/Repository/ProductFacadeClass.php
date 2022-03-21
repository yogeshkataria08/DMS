<?php namespace App\Http\Facades\Repository;

use App\Repositories\Contract\ProductInterface;
use App\Models\Documents;
use App\Repositories\Contract\CategoriesInterface;
use Auth;

/**
 * Class productFacadeClass
 *
 */
class ProductFacadeClass
{

    protected $product, $categoriesRepo;
    /**
     * product constructor.
     *
     * @param ProductInterface $productRepo
     */
    public function __construct(ProductInterface $repo, CategoriesInterface $categoriesInterface)
    {
        $this->product = $repo;
        $this->categoriesRepo = $categoriesInterface;
    }

    /**
     * @return mixed
     */
    public function view() {
        
        $data['productData'] = $this->product->getCollection();
        $data['categoriesData'] = $this->categoriesRepo->getCollection();
        $data['productTab'] = "active";
        return $data;
    }

     /**
     * @return mixed
     */
    public function create() {
        $data['productTab'] = "active open";
        $data['categoriesTab'] = "active";
        $data['categoriesData'] = $this->categoriesRepo->getCollection();
        return $data;
    }
    /**
     * @param $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function getDataTable($request) {

        // get the fields for product list
        $productData = $this->product->getDatatableCollection();

        // get the filtered data of product list
        $productFilteredData = $this->product->getFilteredData($productData,$request);

        //  Sorting product data base on requested sort order
        $productCount = $this->product->getCount($productFilteredData);

        // Sorting product data base on requested sort order
        $productSortData = $this->product->getSortData($productFilteredData,$request);
        
        // get collection of product
        $productData = $this->product->getData($productSortData,$request);

        $appData = array();
        foreach ($productData as $productData) {
            $row = array();
            $row[] = $productData->product_name;
            $row[] = $productData->product_description;
            $row[] = $productData->product_price;
            $row[] = ($productData->product_category_id) ? $productData->categoryName->name : "---";
            if(!empty($productData->id)){
            $file = $productData->documentName->path.'/'.$productData->documentName->file_name;
            $img = "<div><a href='#myModal' data-toggle='modal' data-gallery='example-gallery' data-id=$file class='openImageDialog'>";
            $img .= "<img id='myImg' src= $file  style='width:100%;max-width:50px'>";
            $img .= "</a> </div>";
            $row[] = $img ;
            }
           
            $row[] = view('datatable.action', ['module' => "product",'id' => $productData->id])->render();           
            $appData[] = $row;
        }

        return [
            'draw' => $request->draw,
            'recordsTotal' => $productCount,
            'recordsFiltered' => $productCount,
            'data' => $appData,
        ];
    }
    
    /**
     * Display the specified product.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['details'] = $this->product->getproductByField($id, 'id');
        $data['categoriesData'] = $this->categoriesRepo->getCollection();
        $data['documents'] = Documents::where('entity_type', 'product')->where('entity_id', $id)->get();
        $data['productTab'] = "active";
        return $data;
    }
    
    /**
     * Store and Update product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insertAndUpdateproduct($request) {
        $productData = $this->product->addproduct($request->all());
        
        if($request->hasfile('document'))
         {
            foreach($request->file('document') as $key => $file)
            {
                $name = time().$key.'.'.$file->extension();
                $path = '/files/product';
                $file->move(public_path().$path, $name);
                $documentParam = [];
                $documentParam['entity_id'] = $productData->id;
                $documentParam['entity_type'] = 'product';
                $documentParam['path'] = $path;
                $documentParam['file_name'] = $name;
                Documents::add($documentParam);
            }
         }
         return $productData;
    }


    /**
     * @param $id
     * @return bool
     */
    public function deleteproduct($id) {
        return $this->product->deleteproduct($id);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteProductByCategoriesId($id) {
        return $this->product->deleteproduct($id, 'product_category_id');
    }
}