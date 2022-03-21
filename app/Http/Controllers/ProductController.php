<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Event;
use Hash;
use Product;
use DB;
use Response;
use App\Models\Documents;

class ProductController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $viewData = Product::view();
        return view('product.list', $viewData);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        return Product::getDataTable($request);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formData = Product::create();
        return view('product.add', $formData);
    }

    /**
     * Display the specified Product.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editFormData = Product::edit($id);
        return view('product.edit', $editFormData);
    }

    /**
     * Validation of add and edit action customeValidate
     *
     * @param array $data
     * @param string $mode
     * @return mixed
     */
    public function customeValidate($data, $mode)
    {
        $rules = array(
            'product_name' => 'required|unique:products,product_name',
            'product_category_id' => 'required',
            'document.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',            
        );
        if ($mode == "edit") {
            $rules = array(
                'product_name' => 'required|unique:products,product_name,' . $data['id'],
                'document.*.required' => 'Please upload document',
                'document.*.mimes' => 'Only jpeg,png,jpg,gif,svg files are allowed',
                'document.*.max' => 'Sorry! Maximum allowed size for document is 2MB',             
            );  
        }
        $validator = Validator::make($data, $rules);        
        if ($validator->fails()) {
            $errorRedirectUrl = "product/add";
            if ($mode == "edit") {
                $errorRedirectUrl = "product/edit/" . $data['id'];
            }
            return redirect($errorRedirectUrl)->withInput()->withErrors($validator);
        }
        return false;
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        $validations = $this->customeValidate($request->all(), 'add');
        if ($validations) {
            return $validations;
        }
        // Start Communicate with database
        DB::beginTransaction();
        try{
            Product::insertAndUpdateProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('Product/add')->withInput();

        }
        
        $request->session()->flash('alert-success', __('app.default_add_success',["module" => __('app.product')]));
        return redirect('product/');        
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(request $request)
    {  
        $validations = $this->customeValidate($request->all(), 'edit');
   
        if ($validations) {
            return $validations;
        }  
        // Start Communicate with database
        DB::beginTransaction();
        try{
            
            Product::insertAndUpdateProduct($request);
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('product/edit/' . $request->get('id'))->withInput();

        }

        //  if change_redirect_state  exists then Product redirect to Product profile
        $request->session()->flash('alert-success', __('app.default_edit_success',["module" => __('app.Product')]));
        return redirect('product/');        
    }

    
    /**
     * Delete the specified Product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        $deleteProduct = Product::deleteProduct($request->id);
        
        if ($deleteProduct) {
            $request->session()->flash('alert-success', __('app.default_delete_success',["module" => __('app.Product')]));
        } else {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.Product'),"action"=>__('app.delete')]));
        }
        echo 1;
    }

    /**
     * Download the specified Product image.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $document = Documents::where('id', $id)->first();
        $file = public_path(). $document->path.'/'.$document->file_name;

        $headers = array(
              'Content-Type: application/octet-stream',
            );

            return Response::download($file, $document->file_name, $headers);
    }
}
