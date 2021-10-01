<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Vendor;
use App\Utility;
use App\BankAccount;
use App\BillPayment;
use App\BillProduct;
use App\Transaction;
use App\Mail\BillSend;
use App\ProductCategory;
use App\ProductAndService;
use App\Mail\VendorBillSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Bills'))
        {
            $status = Bill::$statues;
            $statusCnts = [];
            foreach($status as $key=>$stus){
                $statusCnts[$stus] = Bill::where('status', '=', $key)->count();
            }
            $query = Bill::where('created_by', '=', \Auth::user()->creatorId());
            $bills = $query->get();

            $all_Bill = Bill::where('created_by', '=', \Auth::user()->creatorId())->get();
            $billTotal =0;
            $billDue=0;
            foreach($all_Bill as $inv)
            {
                $billTotal+= $inv->getTotal();
                $billDue+= $inv->getDue();
            }
            $duePer = 0;
            $payPer = 0;
            if($billTotal!=0 && $billDue!=0)
            {
                $duePer = number_format(($billDue / $billTotal) * 100,2);
                $payPer = number_format(100-$duePer,2);
            } 
            $incPercentage = [
                'Due Amount' => $duePer,
                'Pay Percentage' => $payPer
            ];           
            return view('accounting.transaction.expense.bill.index', compact('bills', 'status','statusCnts','incPercentage'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->can('Create Bill'))
        {
            $vendors =  Vendor::where('created_by', \Auth::user()->creatorId())->get();

            $vendors = $vendors->map(function($vendor) {
                $vendor['full_name'] = $vendor['first_name'] . ' ' .$vendor['last_name'];
                return $vendor;
            })->pluck('full_name','id');
            $vendors->prepend(__('Please Select'),0);
            $products = ProductAndService::where('created_by', \Auth::user()->creatorId())->get()->pluck('product_name', 'id');
            $products->prepend('--', '');
            $category     = ProductCategory::where('created_by', \Auth::user()->creatorId())->where('type', 2)->get()->pluck('name', 'id');
            $category->prepend(__('Please Select'),0);
            return view('accounting.transaction.expense.bill.create',compact('vendors','products','category'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Bill'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'vendor' => 'required|not_in:0',
                                    'transaction_date' => 'required',
                                    'due_date' => 'required',
                                    'category' => 'required|not_in:0',
                                    'items' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $status = Bill::$statues;
            $bill                 = new Bill();
            $bill->bill_id     = $this->billNumber();
            $bill->vendor_id    = $request->vendor;
            $bill->status         = 0;
            $bill->transaction_date     = date("Y-m-d H:i:s", strtotime($request->transaction_date));
            $bill->due_date       = date("Y-m-d H:i:s", strtotime($request->due_date));
            $bill->billing_address     = $request->billing_address;
            $bill->order_no     = $request->order_no;
            $bill->category_id = $request->category;
            $bill->discount_type     = $request->discount_type;
            $bill->discount_value     = (!empty($request->discount_value) ? $request->discount_value : 0);
            $bill->created_by     =  \Auth::user()->creatorId();
            $bill->save();

            $products = $request->items;

            for($i = 0; $i < count($products); $i++)
            {
                $billProduct              = new BillProduct();
                $billProduct->bill_id  = $bill->id;
                $billProduct->product_id  = $products[$i]['item'];
                $billProduct->quantity    = $products[$i]['quantity'];
                $billProduct->tax         = $products[$i]['tax'];
                $billProduct->price       = $products[$i]['price'];
                $billProduct->save();
            }

            return redirect()->route('bills.index')->with('success', __('Bill Successfully Created.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        if(\Auth::user()->can('View Bill'))
        {
            if($bill->created_by ==\Auth::user()->creatorId())
            {
                $billPayment = BillPayment::where('bill_id', $bill->id)->first();
                $settings = Utility::settings();
                $vendor = $bill->vendor;
                $iteams   = $bill->items;

                return view('accounting.transaction.expense.bill.view', compact('bill', 'vendor', 'iteams','settings'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        if(\Auth::user()->can('Edit Bill'))
        {
            $vendors = Vendor::where('created_by', \Auth::user()->creatorId())->get();

            $vendors = $vendors->map(function($vendor) {
                $vendor['full_name'] = $vendor['first_name'] . ' ' .$vendor['last_name'];
                return $vendor;
            })->pluck('full_name','id');
            $vendors->prepend(__('Please Select'),0);
            $products = ProductAndService::where('created_by', \Auth::user()->creatorId())->get()->pluck('product_name', 'id');
            $products->prepend('--', '');
            $category=ProductCategory::where('created_by', \Auth::user()->creatorId())->where('type', 2)->get()->pluck('name', 'id');
            $category->prepend('--', '');
            return view('accounting.transaction.expense.bill.edit',compact('vendors','products','bill','category'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        if(\Auth::user()->can('Edit Bill'))
        {
            if($bill->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                        'vendor' => 'required|not_in:0',
                                        'transaction_date' => 'required',
                                        'due_date' => 'required',
                                        'category' => 'required|not_in:0',
                                        'items' => 'required',
                                ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
                $status = Bill::$statues;
                $bill->vendor_id    = $request->vendor;
                $bill->transaction_date     = date("Y-m-d H:i:s", strtotime($request->transaction_date));
                $bill->due_date       = date("Y-m-d H:i:s", strtotime($request->due_date));
                $bill->billing_address     = $request->billing_address;
                $bill->order_no     = $request->order_no;
                $bill->category_id = $request->category;
                $bill->discount_type     = $request->discount_type;
                $bill->discount_value     = (!empty($request->discount_value) ? $request->discount_value : 0);
                $bill->save();

                $products = $request->items;

                for($i = 0; $i < count($products); $i++)
                {
                    $billProduct = BillProduct::find($products[$i]['id']);

                    if($billProduct == null)
                    {
                        $billProduct             = new BillProduct();
                        $billProduct->bill_id = $bill->id;
                    }

                    if(isset($products[$i]['product_id']))
                    {
                        $billProduct->product_id = $products[$i]['product_id'];
                    }

                    // $invoiceProduct              = new InvoiceProduct();
                    // $invoiceProduct->invoice_id  = $invoice->id;
                    // $invoiceProduct->product_id  = $products[$i]['item'];
                    $billProduct->quantity    = $products[$i]['quantity'];
                    $billProduct->tax         = $products[$i]['tax'];
                    $billProduct->price       = $products[$i]['price'];
                    $billProduct->save();
                }

                return redirect()->route('bills.index')->with('success', __('Bills Successfully Updated.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        if(\Auth::user()->can('Delete Bill'))
        {
            if($bill->created_by == \Auth::user()->creatorId())
            {
                $bill->delete();
                if($bill->vendor_id != 0)
                {
                    Utility::userBalance('vendor', $bill->vendor_id, $bill->getTotal(), 'debit');
                }
                BillProduct::where('bill_id', '=', $bill->id)->delete();

                return redirect()->route('bills.index')->with('success', __('Bill Successfully Deleted.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'),401);
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
        
    }

    public function sent($id)
    {
        if(\Auth::user()->can('Send Bill'))
        {
            $bill            = Bill::where('id', $id)->first();
            $bill->send_date = date('Y-m-d');
            $bill->status    = 1;
            $bill->save();
            $vendor = Vendor::where('id', $bill->vendor_id)->first();
            $bill->name = !empty($vendor) ? $vendor->first_name.' '.$vendor->last_name : '';
            Utility::userBalance('vendor', $vendor->id, $bill->getTotal(), 'credit');
            return redirect()->back()->with('success', __('Bill Successfully Sent.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    function billNumber()
    {
        $latest = Bill::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->bill_id + 1;
    }

    public function paymentDestroy(Request $request, $bill_id, $payment_id)
    {
        if(\Auth::user()->can('Delete Payment Bill'))
        {
            $payment = BillPayment::find($payment_id);

            BillPayment::where('id', '=', $payment_id)->delete();

            $bill = Bill::where('id', $bill_id)->first();

            $due   = $bill->getDue();
            $total = $bill->getTotal();

            if($due > 0 && $total != $due)
            {
                $bill->status = 3;

            }
            else
            {
                $bill->status = 2;
            }

            // $bill->save();
            // $type = 'Partial';
            // $user = 'Vendor';
            // Transaction::destroyTransaction($payment_id, $type, $user);

            // Utility::userBalance('vendor', $bill->vendor_id, $payment->amount, 'credit');

            // Utility::bankAccountBalance($payment->account_id, $payment->amount, 'debit');

            Utility::userBalance('vendor', $bill->vendor_id, $payment->amount, 'credit');
            Utility::bankAccountBalance($payment->account_id, $payment->amount, 'credit');

            $bill->save();
            $type = 'Partial';
            $user = 'Vendor';
            Transaction::destroyTransaction($payment_id, $type, $user);

            return redirect()->back()->with('success', __('Payment Successfully Deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    public function product(Request $request)
    {
        $data = [];
        if(!empty($request->product_id))
        {
            $product = ProductAndService::find($request->product_id);
            $data['sale_price'] = $product->sale_price;
       
            $data['taxRate'] = $taxRate = $product->taxRate($product->tax_rate_id);
         
            $data['taxes'] = $product->taxs($product->tax_rate_id);

            $quantity            = 1;
            $taxPrice            = ($taxRate / 100) * ($product->salePrice * $quantity);
            $data['totalAmount'] = ($product->sale_price * $quantity);
        }
        else
        {
            $data['sale_price'] = 0;
            $data['taxRate']= [];
            $data['totalAmount'] = 0;
        }

        return json_encode($data);
    }

    public function productDestroy(Request $request)
    {
        if(\Auth::user()->can('Delete Bill Product'))
        {
            BillProduct::where('id', '=', $request->id)->delete();
            return redirect()->back()->with('success', __('Bill Product Successfully Deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function items(Request $request)
    {
        $items = BillProduct::where('bill_id', $request->bill_id)->where('product_id', $request->product_id)->first();
        return json_encode($items);
    }

    public function payment($bill_id)
    {
        if(\Auth::user()->can('Create Payment Bill'))
        {
            $bill    = Bill::where('id', $bill_id)->first();
            $vendors = Vendor::where('created_by', '=', \Auth::user()->creatorId())->get();

            $vendors = $vendors->map(function($vendor) {
                $vendor['full_name'] = $vendor['first_name'] . ' ' .$vendor['last_name'];
                return $vendor; 
            })->pluck('full_name','id');

            $categories = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('accounting.transaction.expense.bill.payment', compact('vendors', 'accounts', 'bill','categories'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));

        }

    }

    public function createPayment(Request $request, $bill_id)
    {
        if(\Auth::user()->can('Create Payment Bill'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'date' => 'required',
                                   'amount' => 'required',
                                   'account_id' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }

            $billPayment                 = new BillPayment();
            $billPayment->bill_id        = $bill_id;
            $billPayment->date           = date("Y-m-d H:i:s", strtotime($request->date));
            $billPayment->amount         = $request->amount;
            $billPayment->account_id     = $request->account_id;
            $billPayment->payment_method = 0;
            $billPayment->reference      = $request->reference;
            $billPayment->description    = $request->description;
            $billPayment->save();

            $bill  = Bill::where('id', $bill_id)->first();
            $due   = $bill->getDue();
            $total = $bill->getTotal();
            if($bill->status == 0)
            {
                $bill->send_date = date('Y-m-d');
                $bill->save();
            }

            if($due <= 0)
            {
                $bill->status = 4;
                $bill->save();
            }
            else
            {
                $bill->status = 3;
                $bill->save();
            }
            $billPayment->user_id    = $bill->vendor_id;
            $billPayment->user_type  = 'Vendor';
            $billPayment->type       = 'Partial';
            $billPayment->created_by = \Auth::user()->id;
            $billPayment->payment_id = $billPayment->id;
            $billPayment->category   = 'Bill';
            $billPayment->account    = $request->account_id;
            Transaction::addTransaction($billPayment);

            $vendor = Vendor::where('id', $bill->vendor_id)->first();

            $payment         = new BillPayment();
            $payment->name   = $vendor['first_name'].' '.$vendor['last_name'];
            //$payment->method = '-';
            $payment->date   = Utility::getDateFormated($request->date);
            $payment->amount = \Auth::user()->priceFormat($request->amount);
            $payment->bill   = $bill->id;

            Utility::userBalance('vendor', $bill->vendor_id, $request->amount, 'debit');

            Utility::bankAccountBalance($request->account_id, $request->amount, 'debit');

            return redirect()->back()->with('success', __('Payment Successfully Added.'));
        }

    }

    public function duplicate($bill_id)
    {
        if(\Auth::user()->can('Duplicate Bill'))
        {
            $bill                            = Bill::where('id', $bill_id)->first();
            $duplicateBill                   = new Bill();
            $duplicateBill->bill_id       = $this->BillNumber();
            $duplicateBill->vendor_id      = $bill['vendor_id'];
            $duplicateBill->transaction_date       = date('Y-m-d');
            $duplicateBill->due_date         = $bill['due_date'];
            $duplicateBill->send_date        = null;
            $duplicateBill->category_id        = $bill['category_id'];
            $duplicateBill->status           = 0;
            $duplicateBill->billing_address     = $bill['billing_address'];
            $duplicateBill->order_no     = $bill['order_no'];
            $duplicateBill->discount_type     = $bill['discount_type'];
            $duplicateBill->discount_value     = $bill['discount_value'];
            $duplicateBill->created_by       = $bill['created_by'];
            $duplicateBill->save();

            if($duplicateBill)
            {
                $billProduct = BillProduct::where('bill_id', $bill_id)->get();
                foreach($billProduct as $product)
                {
                    $duplicateProduct             = new BillProduct();
                    $duplicateProduct->bill_id = $duplicateBill->id;
                    $duplicateProduct->product_id = $product->product_id;
                    $duplicateProduct->quantity   = $product->quantity;
                    $duplicateProduct->tax        = $product->tax;
                    $duplicateProduct->price      = $product->price;
                    $duplicateProduct->save();
                }
            }

            return redirect()->back()->with('success', __('Bill Duplicate Successfully.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function resent($id)
    {
        if(\Auth::user()->can('Send Bill'))
        {
            $bill = Bill::where('id', $id)->first();

            $vendor = Vendor::where('id', $bill->vendor_id)->first();

            $bill->name = !empty($vendor) ? $vendor->first_name.' '.$vendor->last_name : '';
            $bill->bill = \Auth::user()->billNumberFormat($bill->bill_id);

            $billId    = Crypt::encrypt($bill->id);
            $bill->url = route('bill.pdf', $billId);

            try
            {
                Mail::to($vendor->email)->send(new BillSend($bill));
            }
            catch(\Exception $e)
            {
                $smtp_error =$e->getMessage();
            }

            return redirect()->back()->with('success', __('Bill successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }

    }

    public function vendorBillSend($bill_id)
    {
        return view('accounting.users.vendor.bill_send', compact('bill_id'));
    }

    public function vendorBillSendMail(Request $request, $bill_id)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'email' => 'required|email',
                           ]
        );
        if($validator->fails())
        {
            return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
        }

        $email = $request->email;
        $bill  = Bill::where('id', $bill_id)->first();

        $vendor     = Vendor::where('id', $bill->vendor_id)->first();
        $bill->name = !empty($vendor) ? $vendor->first_name.' '.$vendor->last_name : '';
        $bill->bill = \Auth::user()->billNumberFormat($bill->bill_id);

        $billId    = Crypt::encrypt($bill->id);
        $bill->url = route('bill.pdf', $billId);

        try
        {
            Mail::to($email)->send(new VendorBillSend($bill));
        }
        catch(\Exception $e)
        {
            $smtp_error = $e->getMessage();
        }

        return redirect()->back()->with('success', __('Bill successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));

    }

    public function saveBillTemplateSettings(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        if(isset($post['bill_template']) && (!isset($post['bill_color']) || empty($post['bill_color'])))
        {
            $post['bill_color'] = "ffffff";
        }

        foreach($post as $key => $data)
        {
            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                             $data,
                                                                                                                                             $key,
                                                                                                                                             \Auth::user()->creatorId(),
                                                                                                                                         ]
            );
        }

        return redirect()->back()->with('success', __('Bill Setting updated successfully'));
    }

    public function previewBill($template, $color)
    {
        $objUser  = \Auth::user();
        $settings = Utility::settings();
        $bill     = new Bill();

        $vendor                   = new \stdClass();
        $vendor->first_name     = '<Vendor First Name>';
        $vendor->last_name     = '<Vendor Last Name>';

        $vendor_detail                   = new \stdClass();
        $vendor_detail->country  = '<Country>';
        $vendor_detail->state    = '<State>';
        $vendor_detail->city     = '<City>';
        $vendor_detail->phone_no    = '<Vendor Phone Number>';
        $vendor_detail->post_code      = '<Post Code>';
        $vendor_detail->address1  = '<Address1>';
        $vendor_detail->address2  = '<Address2>';
        $vendor->vendordetail = $vendor_detail;      

        $totalTaxPrice = 0;
        $taxesData     = [];
        $items         = [];
        for($i = 1; $i <= 3; $i++)
        {
            $item           = new \stdClass();
            $item->name     = 'Item ' . $i;
            $item->quantity = 1;
            $item->tax      = 5;
            $item->discount = 50;
            $item->price    = 100;

            $taxes = [
                'Tax 1',
                'Tax 2',
            ];

            $itemTaxes = [];
            foreach($taxes as $k => $tax)
            {
                $taxPrice         = 10;
                $totalTaxPrice    += $taxPrice;
                $itemTax['name']  = 'Tax ' . $k;
                $itemTax['rate']  = '10 %';
                $itemTax['price'] = '$10';
                $itemTaxes[]      = $itemTax;
                if(array_key_exists('Tax ' . $k, $taxesData))
                {
                    $taxesData['Tax ' . $k] = $taxesData['Tax 1'] + $taxPrice;
                }
                else
                {
                    $taxesData['Tax ' . $k] = $taxPrice;
                }
            }
            $item->itemTax = $itemTaxes;
            $items[]       = $item;
        }

        $bill->bill_id    = 1;
        $bill->transaction_date = date('Y-m-d H:i:s');
        $bill->due_date   = date('Y-m-d H:i:s');
        $bill->items      = $items;

        $bill->totalTaxPrice = 60;
        $bill->totalQuantity = 3;
        $bill->totalRate     = 300;
        $bill->totalDiscount = 10;
        $bill->taxesData     = $taxesData;

        $preview      = 1;
        $color        = '#' . $color;
        $font_color   = Utility::getFontColor($color);
        $logo         = asset(Storage::url('logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        return view('accounting.transaction.expense.bill.templates.' . $template, compact('bill', 'preview', 'color', 'img', 'settings', 'vendor', 'font_color'));
    }

    public function bill($bill_id)
    {
        $settings = Utility::settings();
        $billId   = Crypt::decrypt($bill_id);

        $bill  = Bill::where('id', $billId)->first();
        $data  = DB::table('settings');
        $data  = $data->where('created_by', '=', $bill->created_by);
        $data1 = $data->get();

        foreach($data1 as $row)
        {
            $settings[$row->name] = $row->value;
        }

        $vendor = $bill->vendor;

        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate     = 0;
        $totalDiscount = 0;
        $taxesData     = [];
        $items         = [];

        foreach($bill->items as $product)
        {

            $item           = new \stdClass();
            $item->name     = !empty($product->product()) ? $product->product()->product_name : '';
            $item->quantity = $product->quantity;
            $item->tax      = !empty($product->taxes) ? $product->taxes->rate : '';
            $item->discount = $product->discount_value;
            $item->price    = $product->price;

            $totalQuantity += $item->quantity;
            $totalRate     += $item->price;
            $totalDiscount += $item->discount;

            $taxes     = \Utility::tax($product->tax);
            $itemTaxes = [];
            foreach($taxes as $tax)
            {
                $taxPrice      = \Utility::taxRate($tax->tax_rate, $item->price, $item->quantity);
                $totalTaxPrice += $taxPrice;

                $itemTax['name']  = $tax->name;
                $itemTax['rate']  = $tax->tax_rate . '%';
                $itemTax['price'] = \App\Utility::priceFormat($settings, $taxPrice);
                $itemTaxes[]      = $itemTax;


                if(array_key_exists($tax->name, $taxesData))
                {
                    $taxesData[$tax->name] = $taxesData[$tax->name] + $taxPrice;
                }
                else
                {
                    $taxesData[$tax->name] = $taxPrice;
                }

            }
            $item->itemTax = $itemTaxes;

            $items[] = $item;
        }

        $bill->items         = $items;
        $bill->totalTaxPrice = $totalTaxPrice;
        $bill->totalQuantity = $totalQuantity;
        $bill->totalRate     = $totalRate;
        $bill->totalDiscount = $totalDiscount;
        $bill->taxesData     = $taxesData;

        //Set your logo
        $logo         = asset(Storage::url('logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        if($bill)
        {
            $color      = '#' . $settings['bill_color'];
            $font_color = Utility::getFontColor($color);

            return view('accounting.transaction.expense.bill.templates.' . $settings['bill_template'], compact('bill', 'color', 'settings', 'vendor', 'img', 'font_color'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }

    }

}
