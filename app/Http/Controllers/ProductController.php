<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Helpers\UserHelper;
use App\Helpers\RoleHelper;
use App\Helpers\ProductHelper;
use App\Helpers\VendorHelper;
use App\Helpers\MasterListHelper;
use App\Helpers\OrderItemDetailHelper;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['type'] = $request->input('type');
        $data['sku'] = $request->input('sku');
        $data['vendors'] = $request->input('vendors');
        $data['vendorList'] = VendorHelper::getList();
        $data['table_list'] = ProductHelper::getPaginateData($data['type'], $data['sku'], $data['vendors']);
        $data['i'] = ($request->input('page', 1) - 1) * 50;
        $data['masterList'] = MasterListHelper::getByMultipleTypes(array('Product Type'));
        return view('product.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['vendorList'] = VendorHelper::getList();
        $data['masterList'] = MasterListHelper::getByMultipleTypes(array('Product Type'));
        return view('product.create', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'sku' => 'required',
            'product_type' => 'required',
            'vendor_id' => 'required'
        ]);
        $user_data = auth()->user();
        $insert_array = $request->all();
        $insert = ProductHelper::insert($insert_array);
        if ($insert) {
            Session::flash('success', 'Product inserted successfully.');
            return redirect('product');
        } else {
            Session::flash('error', 'Sorry, something went wrong. Please try again.');
            return redirect()->back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['master_detail'] = ProductHelper::getByid($id);
        $data['vendorList'] = VendorHelper::getList();
        $data['masterList'] = MasterListHelper::getByMultipleTypes(array('Product Type'));
        return view('product.edit', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'sku' => 'required',
            'product_type' => 'required',
            'vendor_id' => 'required'
        ]);
        $update_array = $request->all();
        unset($update_array['_token']);
        unset($update_array['_method']);
        $where = array('id' => $id);
        $update = ProductHelper::update($update_array, $where);
        if ($update) {
            Session::flash('success', 'Product updated successfully.');
            return redirect('product');
        } else {
            Session::flash('error', 'Sorry, something went wrong. Please try again.');
            return redirect()->back();
        }
    }
    public function delete($id)
    {
        $update_array = array('delete_flag' => 'Y');
        $where = array('id' => $id);
        $delete = ProductHelper::softDelete($update_array, $where);
        if ($delete) {
            Session::flash('success', 'Product deleted successfully.');
        } else {
            Session::flash('error', 'Sorry, something went wrong. Please try again.');
        }
        return redirect()->back();
    }
    public function getProductListByVendorType($vendor, $productType)
    {
        $productList = ProductHelper::getProductByVendorType($vendor, $productType);
        return $productList;
    }
    public function getProductListByVendor($vendor)
    {
        $productList = ProductHelper::getProductByVendor($vendor);
        return $productList;
    }
    public function importSample()
    {
        $VendorLists = VendorHelper::getByTypePluckName();
        $VendorList = array();
        foreach ($VendorLists as $key => $value) {
            echo $key =  str_replace(" ", "", $key);
            echo "<br>";
            $VendorList[$key] = $value;
        }
        echo "<pre>";
        $accessiorSku  = DB::table('crm_accessoires_products___product')->where('updateflag', 'N')->get();

        foreach ($accessiorSku as $list) {
            //
            $vndorname = trim(str_replace(" ", "", $list->vendors));

            // \print_r($VendorList[$vndorname]); die;  
            if (isset($VendorList[$vndorname])) {

                $insertArray = array("name" => $list->name, "product_type" => $list->type, "sku" => $list->sku, "vendor_id" => $VendorList[$vndorname]);
                ProductHelper::insert($insertArray);
                DB::table('crm_accessoires_products___product')
                    ->where('id', $list->id)
                    ->update(['vendors' => $vndorname, 'updateflag' => 'Y']);
            } else {
                echo $vndorname;
                die;
            }
        }
    }
    public function productOrderByVendorDate(Request $request)
    {
        $vendorId = $request->input('vendor_id');
        $date = $request->input('date');
        $data['name'] = $name = $request->input('name');
        $data['product_type'] = $product_type = $request->input('product_type');
        
        $export = $request->input('export');
        if ($date == "") {
            $date = date('m/d/Y') . '-' . date('m/d/Y');
        }
        $data['date'] = $date;
        $data['vendor_id'] = $vendorId;
        $data['vendorList'] = VendorHelper::getList();
        $dates = explode("-", $date);
        $data['lists'] = array();
        $data['total'] = 0;
        $sdates = explode("/", $dates[0]);
        $edates = explode("/", $dates[1]);
        $sdate = $sdates[2] . '-' . $sdates[0] . '-' . $sdates[1];
        $edate = $edates[2] . '-' . $edates[0] . '-' . $edates[1];
        $data['lists'] = OrderItemDetailHelper::productOrderByVendorDate($vendorId, $sdate, $edate, $name, $product_type);
        foreach ($data['lists'] as $list) {
            $data['total'] = $data['total'] + $list->amount;;
        }
        if ($export == 'Export') {
            $filename = "Product Report     " . date("m/d/Y H:i:s A");
            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=" . $filename . ".csv",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0",
            );
            $columns = array('No', 'Name', 'Product Type', 'Percentage', 'Amount');
            $total = $data['total'];
            $lists = $data['lists'];
            $callback = function () use ($total,$lists,$columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                $i = 0;
                foreach($lists as $list){
                    $i++;
                    $pre = ($list->amount*100)/$total;
                    fputcsv($file, array($i,$list->name,$list->product_type,number_format($pre,2),number_format($list->amount,2)));
                }
                fclose($file);
            };
            return response()->stream($callback, 200, $headers);
        }
        $data['masterList'] = MasterListHelper::getByMultipleTypes(array('Product Type'));
        return view('product.report-by-date-id', $data);
    }
}
