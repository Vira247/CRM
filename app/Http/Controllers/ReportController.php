<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\VendorHelper;
use App\Helpers\OrderItemDetailHelper;
use App\Helpers\MasterListHelper;
class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sampleVSProduct(Request $request)
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
        $data['lists'] = OrderItemDetailHelper::SampleVSProductByVendorDate($vendorId, $sdate, $edate, $name,$product_type);
        if ($export == 'Export') {
            $filename = "Product Report " . date("m/d/Y H:i:s A");
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
        //echo "<pre>"; print_r($data);
        return view('product.report-sample-vs-product', $data);
    }
    public function reportProductListByDate(Request $request){
        $date = $data['date'] = $request->input('date');
        $product_id = $data['product_id'] = $request->input('product_id');
        if ($date == "") {
            $date = date('m/d/Y') . '-' . date('m/d/Y');
        }
        $data['date'] = $date;
        $dates = explode("-", $date);
        $sdates = explode("/", $dates[0]);
        $edates = explode("/", $dates[1]);
        $sdate = $sdates[2] . '-' . $sdates[0] . '-' . $sdates[1];
        $edate = $edates[2] . '-' . $edates[0] . '-' . $edates[1];
        $data['list'] = OrderItemDetailHelper::reportProductListByDate($sdate,$edate,$product_id);
        //echo "<pre>"; print_r($data['list']); die;
        return view('report.report-product-list-by-date', $data);
    }
}
