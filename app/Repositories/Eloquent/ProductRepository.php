<?php namespace App\Repositories\Eloquent;

use App\Repositories\Contract\ProductInterface;
use App\Models\Product;
use App\Traits\CommonModelTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Class ProductRepository
 *
 * @package App\Repositories\Eloquent
 */
class ProductRepository implements ProductInterface
{

    use CommonModelTrait;
    /**
     * Get all Product getCollection
     *
     * @return mixed
     */
    public function getCollection()
    {
        return Product::get();
    }

    /**
     * Get all Product
     *
     * @return mixed
     */
    public function getDatatableCollection()
    {
        return Product::with([]);
    }

    /**
     * use for sorting
     *
     * @return array
     */
    public function getSortFields($index)
    {
        $sortableFields = [
            "product_name",
            "product_description",
            "product_price",
            "product_category_id",
            ""
        ];

        return $sortableFields[ $index ];
    }

    /**
     * get Product By fieldname getProductByField
     *
     * @param mixed $id
     * @param string $field_name
     * @return mixed
     */
    public function getProductByField($id, $field_name)
    {
        return Product::where($field_name, $id)->first();
    }

    /**
     * Add & update Product addProduct
     *
     * @param array $models
     * @return boolean true | false
     */
    public function addProduct($models)
    {   
        if (isset($models['id'])) {
            $product = Product::find($models['id']);
        } else {
            $product = new Product;
            $product->created_at = date('Y-m-d H:i:s');            
        }
        
        $product->product_name = $models['product_name'];
        $product->product_description = $models['product_description'];
        $product->product_price = $models['product_price'];
        $product->product_category_id = $models['product_category_id'];
        $product->updated_at = date('Y-m-d H:i:s');
        $productId = $product->save();

        if ($productId) {
            return $product;
        } else {
            return false;
        }
       
    }

    /**
     * Delete Product
     *
     * @param int $id
     * @return boolean true | false
     */
    public function deleteProduct($id, $field='id')
    {
        $delete = Product::where($field, $id)->delete();        
        if ($delete)
            return true;
        else
            return false;

    }
}
