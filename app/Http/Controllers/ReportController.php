<?php

namespace App\Http\Controllers;
use App\Exports\OrderExport;
// use App\Exports\Export;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Mobile;
use App\Models\electronic;
use App\Models\Phone;
use App\Models\Product;
use App\Models\OrderOut;
use App\Models\BillInternet;
use App\Models\Blance_transfer;
use Illuminate\Support\Facades\Auth;
use PDF;
class ReportController extends Controller
{
    //report order
    public function SearchPage()
    {
      return view('admin.reports.reports-orders.reports-order');
    }


    public function SearchReport(Request $request){
      // في حالة عدم تحديد تاريخ
      if ($request->typeStatus !=3 && $request->start_at =='' && $request->end_at =='') {
        $orderReports = Order::where('status',$request->typeStatus)->get();
        // foreach($orderReports as $order){
          
        //   $product_id=$order->product_id;
        //   $products= Product::where('id',$product_id)->get();
        //   foreach($products as $product){
            
        //     $price_act= $product->price_act;
        //     $commission= $product->commission;
            
        //   }
        // }
        // echo $products;
      
            $status = $request->typeStatus;
        return view('admin.reports.reports-orders.reports-order',compact(['status','orderReports']));
      }
      
      // في حالة تحديد تاريخ استحقاق
      else {
          $start_at = date($request->start_at);
          $end_at = date($request->end_at);
          $status = $request->typeStatus;
          $orderReports = Order::whereBetween('updated_at',[$start_at,$end_at])->where('status',$request->typeStatus)->get();
          return view('admin.reports.reports-orders.reports-order',compact('status','start_at','end_at','orderReports'));
        
        }
      }
    

      //report Electronic
      public function ReportElectronic()
      {
        return view('admin.reports.reports-electronic.reports-electronic');
      }

      public function SearchReportElectronic(Request $request){
        // في حالة عدم تحديد تاريخ
        if ($request->typeStatus !=3 && $request->start_at =='' && $request->end_at =='') {
          
          $orderReports = electronic::where('status',$request->typeStatus)->get();
          $status = $request->typeStatus;
          $name_admin = User::where('id',Auth::id())->first();
          $name=$name_admin->fname;
          return view('admin.reports.reports-electronic.reports-electronic',compact(['status','orderReports','name']));
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $status = $request->typeStatus;
            $orderReports = electronic::whereBetween('updated_at',[$start_at,$end_at])->where('status',$request->typeStatus)->get();
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            // return $name;
            // die();
            return view('admin.reports.reports-electronic.reports-electronic',compact('status','start_at','end_at','orderReports','name'));
          
          }
        }
      //report Mobile
      public function ReportMobile()
      {
        return view('admin.reports.reports-mobile.reports-mobile');
      }

      public function SearchReportMobile(Request $request){
        // في حالة عدم تحديد تاريخ
        if ($request->typeStatus !=3 && $request->start_at =='' && $request->end_at =='') {
          
          $orderReports =Mobile::where('status',$request->typeStatus)->get();
          $status = $request->typeStatus;
          $name_admin = User::where('id',Auth::id())->first();
          $name=$name_admin->fname;
          return view('admin.reports.reports-mobile.reports-mobile',compact(['status','orderReports','name']));
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $status = $request->typeStatus;
            $orderReports = Mobile::whereBetween('updated_at',[$start_at,$end_at])->where('status',$request->typeStatus)->get();
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            // return $name;
            // die();
            return view('admin.reports.reports-mobile.reports-mobile',compact('status','start_at','end_at','orderReports','name'));
          
          }
        }
      //report Phone
      public function ReportPhone()
      {
        return view('admin.reports.reports-phone.reports-phone');
      }

      public function SearchReportPhone(Request $request){
        // في حالة عدم تحديد تاريخ
        if ($request->typeStatus !=3 && $request->start_at =='' && $request->end_at =='') {
          
          $orderReports =Phone::where('status',$request->typeStatus)->get();
          $status = $request->typeStatus;
          $name_admin = User::where('id',Auth::id())->first();
          $name=$name_admin->fname;
          return view('admin.reports.reports-phone.reports-phone',compact(['status','orderReports','name']));
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $status = $request->typeStatus;
            $orderReports = Phone::whereBetween('updated_at',[$start_at,$end_at])->where('status',$request->typeStatus)->get();
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            // return $name;
            // die();
            return view('admin.reports.reports-phone.reports-phone',compact('status','start_at','end_at','orderReports','name'));
          
          }
        }
      //report BillInternet
      public function Reportinternet()
      {
        return view('admin.reports.reports-internet.reports-internet');
      }

      public function SearchReportinternet(Request $request){
        // في حالة عدم تحديد تاريخ
        if ($request->typeStatus !=3 && $request->start_at =='' && $request->end_at =='') {
          
          $orderReports =BillInternet::where('status',$request->typeStatus)->get();
          $status = $request->typeStatus;
          $name_admin = User::where('id',Auth::id())->first();
          $name=$name_admin->fname;
          return view('admin.reports.reports-internet.reports-internet',compact(['status','orderReports','name']));
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $status = $request->typeStatus;
            $orderReports = BillInternet::whereBetween('updated_at',[$start_at,$end_at])->where('status',$request->typeStatus)->get();
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            // return $name;
            // die();
            return view('admin.reports.reports-internet.reports-internet',compact('status','start_at','end_at','orderReports','name'));
          
          }
        }

       //report Balance 
      public function ReportBalance()
      {
        return view('admin.reports.reports-balance.reports-balance');
      }

      public function SearchReportBalance(Request $request){
        // في حالة عدم تحديد تاريخ
        if ($request->typeStatus !=3 && $request->start_at =='' && $request->end_at =='') {
          
          $orderReports =Blance_transfer::where('status',$request->typeStatus)->get();
          $status = $request->typeStatus;
          $name_admin = User::where('id',Auth::id())->first();
          $name=$name_admin->fname;
          return view('admin.reports.reports-balance.reports-balance',compact(['status','orderReports','name']));
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $status = $request->typeStatus;
            $orderReports = Blance_transfer::whereBetween('updated_at',[$start_at,$end_at])->where('status',$request->typeStatus)->get();
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            // return $name;
            // die();
            return view('admin.reports.reports-balance.reports-balance',compact('status','start_at','end_at','orderReports','name'));
          
          }
        }

         //report Order Out 
      public function ReportOrderOut()
      {
        return view('admin.reports.reports_out.reports-out');
      }

      public function SearchReportOrderOut(Request $request){
        // في حالة عدم تحديد تاريخ
        if ($request->typeStatus !=3 && $request->start_at =='' && $request->end_at =='') {
          
          $orderReports =OrderOut::where('status',$request->typeStatus)->get();
          $status = $request->typeStatus;
          $name_admin = User::where('id',Auth::id())->first();
          $name=$name_admin->fname;
          return view('admin.reports.reports_out.reports-out',compact(['status','orderReports','name']));
        }
        
        // في حالة تحديد تاريخ استحقاق
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $status = $request->typeStatus;
            $orderReports = OrderOut::whereBetween('updated_at',[$start_at,$end_at])->where('status',$request->typeStatus)->get();
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            // return $name;
            // die();
            return view('admin.reports.reports_out.reports-out',compact('status','start_at','end_at','orderReports','name'));
          
          }
        }
        
        public function download(){
          $orderReports=SearchReport();
          $pdf = PDF::loadView('admin.reports.reports-orders.reports-order',$orderReports);
          return $pdf->download('reportorder.pdf');
        }
        // public function download(){
        //   $pdf =pdf::loadView('admin.admin.all');
        //   return $pdf->download('reportorder.pdf');
        // }
    
}
        
        