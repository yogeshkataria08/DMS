<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Event;
use Hash;
use Categories;
use DB;
use Product;

class CategoriesController extends Controller
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
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData = Categories::view();
        return view('categories.list', $viewData);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function datatable(Request $request)
    {
        return Categories::getDataTable($request);
    }

    /**
     * Show the form for creating a new Categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formData = Categories::create();
        return view('categories.add', $formData);
    }

    /**
     * Display the specified Categories.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editFormData = Categories::edit($id);
        return view('categories.edit', $editFormData);
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
            'name' => 'required|unique:categories,name'            
        );
        if ($mode == "edit") {
            $rules = array(
                'name' => 'required|unique:categories,name,' . $data['id']             
            );  
        }
        $validator = Validator::make($data, $rules);        
        if ($validator->fails()) {
            $errorRedirectUrl = "categories/add";
            if ($mode == "edit") {
                $errorRedirectUrl = "categories/edit/" . $data['id'];
            }
            return redirect($errorRedirectUrl)->withInput()->withErrors($validator);
        }
        return false;
    }

    /**
     * Store a newly created Categories in storage.
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
            Categories::insertAndUpdateCategories($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('categories/add')->withInput();

        }
        
        $request->session()->flash('alert-success', __('app.default_add_success',["module" => __('app.categories')]));
        return redirect('categories/');        
    }

    /**
     * Update the specified Categories in storage.
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
            Categories::insertAndUpdateCategories($request->all());
            DB::commit();
        } catch (\Exception $e) {
            //exception handling
            DB::rollback();
            $errorMessage = '<a target="_blank" href="https://stackoverflow.com/search?q='.$e->getMessage().'">'.$e->getMessage().'</a>';
            $request->session()->flash('alert-danger', $errorMessage);
            return redirect('categories/edit/' . $request->get('id'))->withInput();

        }

        //  if change_redirect_state  exists then Categories redirect to Categories profile
        $request->session()->flash('alert-success', __('app.default_edit_success',["module" => __('app.categories')]));
        return redirect('categories/');        
    }

    
    /**
     * Delete the specified Categories in storage and products related to that category.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        $deleteCategories = Categories::deleteCategories($request->id);
        Product::deleteProductByCategoriesId($request->id);
        if ($deleteCategories) {
            $request->session()->flash('alert-success', __('app.default_delete_success',["module" => __('app.categories')]));
        } else {
            $request->session()->flash('alert-danger', __('app.default_error',["module" => __('app.categories'),"action"=>__('app.delete')]));
        }
        echo 1;
    }
}
