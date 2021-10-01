<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Utility;
use App\Customer;
use App\BankAccount;
use App\Transaction;
use App\InvoicePayment;
use App\InvoiceProduct;
use App\ProductCategory;
use App\Mail\InvoiceSend;
use App\ProductAndService;
use Illuminate\Http\Request;
use App\Mail\PaymentReminder;
use App\Mail\CustomerInvoiceSend;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->can('Manage Invoices'))
        {
            $status = Invoice::$statues;
            $statusCnts = [];
            foreach($status as $key=>$stus){
                $statusCnts[$stus] = Invoice::where('status', '=', $key)->count();
            }
            $query = Invoice::where('created_by', '=', \Auth::user()->creatorId());
            $invoices = $query->get();

            $all_Invoice = Invoice::where('created_by', '=', \Auth::user()->creatorId())->get();
            $invTotal =0;
            $invDue=0;
            foreach($all_Invoice as $inv)
            {
                $invTotal+= $inv->getTotal();
                $invDue+= $inv->getDue();
            } 

            $duePer = 0;
            $payPer = 0;

            if($invTotal!=0 && $invDue!=0)
            {
                $duePer = number_format(($invDue / $invTotal) * 100,2);
                $payPer = number_format(100-$duePer,2);  
            }

            $incPercentage = [
                'Due Amount' => $duePer,
                'Pay Percentage' => $payPer
            ];

            return view('accounting.transaction.sales.invoice.index', compact('invoices', 'status','statusCnts','incPercentage'));
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
        if(\Auth::user()->can('Create Invoice'))
        {
            $customers =  Customer::where('created_by', \Auth::user()->creatorId())->get();

            $customers = $customers->map(function($customer) {
                $customer['full_name'] = $customer['first_name'] . ' ' .$customer['last_name'];
                return $customer;
            })->pluck('full_name','id');
            $customers->prepend(__('Please Select'),0);
            $products = ProductAndService::where('created_by', \Auth::user()->creatorId())->get()->pluck('product_name', 'id');
            $products->prepend('--', '');
            $category     = ProductCategory::where('created_by', \Auth::user()->creatorId())->where('type', 1)->get()->pluck('name', 'id');
            $category->prepend(__('--'),0);
            return view('accounting.transaction.sales.invoice.create',compact('customers','products','category'));
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
        if(\Auth::user()->can('Create Invoice'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'customer' => 'required|not_in:0',
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
            $status = Invoice::$statues;
            $invoice                 = new Invoice();
            $invoice->invoice_id     = $this->invoiceNumber();
            $invoice->customer_id    = $request->customer;
            $invoice->status         = 0;
            $invoice->transaction_date     = date("Y-m-d H:i:s", strtotime($request->transaction_date));
            $invoice->due_date       = date("Y-m-d H:i:s", strtotime($request->due_date));
            $invoice->category_id = $request->category;
            $invoice->reference_no = $request->reference_no;
            $invoice->billing_address     = $request->billing_address;
            $invoice->discount_type     = $request->discount_type;
            $invoice->discount_value     = (!empty($request->discount_value) ? $request->discount_value : 0);
            $invoice->created_by     =  \Auth::user()->creatorId();
            $invoice->save();

            $products = $request->items;

            for($i = 0; $i < count($products); $i++)
            {
                $invoiceProduct              = new InvoiceProduct();
                $invoiceProduct->invoice_id  = $invoice->id;
                $invoiceProduct->product_id  = $products[$i]['item'];
                $invoiceProduct->quantity    = $products[$i]['quantity'];
                $invoiceProduct->tax         = $products[$i]['tax'];
                $invoiceProduct->price       = $products[$i]['price'];
                $invoiceProduct->save();
            }

            return redirect()->route('invoices.index')->with('success', __('Invoice Successfully Created.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        if(\Auth::user()->can('View Invoice'))
        {
            if($invoice->created_by == \Auth::user()->creatorId())
            {
               $invoicePayment = InvoicePayment::where('invoice_id', $invoice->id)->first();
               $settings = Utility::settings();
                $customer = $invoice->customer;
                $iteams   = $invoice->items;

                return view('accounting.transaction.sales.invoice.view', compact('invoice', 'customer', 'iteams','settings'));
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
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        if(\Auth::user()->can('Edit Invoice'))
        {
            $customers = Customer::where('created_by', \Auth::user()->creatorId())->get();

            $customers = $customers->map(function($customer) {
                $customer['full_name'] = $customer['first_name'] . ' ' .$customer['last_name'];
                return $customer;
            })->pluck('full_name','id');
            $customers->prepend(__('Please Select'),0);
            $products = ProductAndService::where('created_by', \Auth::user()->creatorId())->get()->pluck('product_name', 'id');
            $products->prepend('--', '');
            $category=ProductCategory::where('created_by', \Auth::user()->creatorId())->where('type', 1)->get()->pluck('name', 'id');
            $category->prepend('--', '');
            return view('accounting.transaction.sales.invoice.edit',compact('customers','products','invoice','category'));
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
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        if(\Auth::user()->can('Edit Invoice'))
        {
                if($invoice->created_by == \Auth::user()->creatorId())
                {
                    $validator = \Validator::make(
                        $request->all(), [
                                            'customer' => 'required|not_in:0',
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
                    $status = Invoice::$statues;
                    $invoice->customer_id    = $request->customer;
                    $invoice->transaction_date     = date("Y-m-d H:i:s", strtotime($request->transaction_date));
                    $invoice->due_date       = date("Y-m-d H:i:s", strtotime($request->due_date));
                    $invoice->category_id = $request->category;
                    $invoice->reference_no = $request->reference_no;
                    $invoice->billing_address     = $request->billing_address;
                    $invoice->discount_type     = $request->discount_type;
                    $invoice->discount_value     = (!empty($request->discount_value) ? $request->discount_value : 0);
                    $invoice->save();

                    $products = $request->items;

                    for($i = 0; $i < count($products); $i++)
                    {
                        $invoiceProduct = InvoiceProduct::find($products[$i]['id']);

                        if($invoiceProduct == null)
                        {
                            $invoiceProduct             = new InvoiceProduct();
                            $invoiceProduct->invoice_id = $invoice->id;
                        }

                        if(isset($products[$i]['product_id']))
                        {
                            $invoiceProduct->product_id = $products[$i]['product_id'];
                        }

                        // $invoiceProduct              = new InvoiceProduct();
                        // $invoiceProduct->invoice_id  = $invoice->id;
                        // $invoiceProduct->product_id  = $products[$i]['item'];
                        $invoiceProduct->quantity    = $products[$i]['quantity'];
                        $invoiceProduct->tax         = $products[$i]['tax'];
                        $invoiceProduct->price       = $products[$i]['price'];
                        $invoiceProduct->save();
                    }

                    return redirect()->route('invoices.index')->with('success', __('Invoice Successfully Created.'));
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
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        if(\Auth::user()->can('Delete Invoice'))
        {
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $invoice->delete();
                if($invoice->customer_id != 0)
                {
                    Utility::userBalance('customer', $invoice->customer_id, $invoice->getTotal(), 'debit');
                }
                InvoiceProduct::where('invoice_id', '=', $invoice->id)->delete();

                return redirect()->route('invoices.index')->with('success', __('Invoice Successfully Deleted.'));
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

    public function productDestroy(Request $request)
    {
        if(\Auth::user()->can('Delete Invoice Product'))
        {
            InvoiceProduct::where('id', '=', $request->id)->delete();
            return redirect()->back()->with('success', __('Bill Product Successfully Deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'),401);
        }
    }

    public function items(Request $request)
    {
        
        $items = InvoiceProduct::where('invoice_id', $request->invoice_id)->where('product_id', $request->product_id)->first();
        return json_encode($items);
    }

    public function product(Request $request)
    {
        $data = [];
        if(!empty($request->product_id))
        {
            $product = ProductAndService::find($request->product_id);
            $data['sale_price'] = $product->sale_price;
            //$data['product'] = $product = ProductAndService::find($request->product_id);
       
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

    public function payment($invoice_id)
    {
        if(\Auth::user()->can('Create Payment Invoice'))
        {
            $invoice = Invoice::where('id', $invoice_id)->first();

            $customers = Customer::where('created_by', '=', \Auth::user()->creatorId())->get();

            $customers = $customers->map(function($customer) {
                $customer['full_name'] = $customer['first_name'] . ' ' .$customer['last_name'];
                return $customer; 
            })->pluck('full_name','id');
            $categories = ProductCategory::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $accounts   = BankAccount::select('*', \DB::raw("CONCAT(bank_name,' ',holder_name) AS name"))->where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('accounting.transaction.sales.invoice.payment', compact('customers', 'invoice','accounts','categories'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
        
    }

    public function sent($id)
    {
        if(\Auth::user()->can('Send Invoice'))
        {
            $invoice            = Invoice::where('id', $id)->first();
            $invoice->send_date = date('Y-m-d');
            $invoice->status    = 1;
            $invoice->save();
            $customer         = Customer::where('id', $invoice->customer_id)->first();
            $invoice->name    = !empty($customer) ? $customer->first_name.' '.$customer->last_name : '';
            Utility::userBalance('customer', $customer->id, $invoice->getTotal(), 'credit');
            return redirect()->back()->with('success', __('Invoice Successfully Sent.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function createPayment(Request $request, $invoice_id)
    {
        if(\Auth::user()->can('Create Payment Invoice'))
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

            $invoicePayment                 = new InvoicePayment();
            $invoicePayment->invoice_id     = $invoice_id;
            $invoicePayment->date           = date("Y-m-d H:i:s", strtotime($request->date));
            $invoicePayment->amount         = $request->amount;
            $invoicePayment->account_id     = $request->account_id;
            $invoicePayment->payment_method = 0;
            $invoicePayment->reference      = $request->reference;
            $invoicePayment->description    = $request->description;
            $invoicePayment->save();

            $invoice = Invoice::where('id', $invoice_id)->first();
            $due     = $invoice->getDue();
            $total   = $invoice->getTotal();
            if($invoice->status == 0)
            {
                $invoice->send_date = date('Y-m-d');
                $invoice->save();
            }

            if($due <= 0)
            {
                $invoice->status = 4;
                $invoice->save();
            }
            else
            {
                $invoice->status = 3;
                $invoice->save();
            }
            $invoicePayment->user_id    = $invoice->customer_id;
            $invoicePayment->user_type  = 'Customer';
            $invoicePayment->type       = 'Partial';
            $invoicePayment->created_by = \Auth::user()->id;
            $invoicePayment->payment_id = $invoicePayment->id;
            $invoicePayment->category   = 'Invoice';
            $invoicePayment->account    = $request->account_id;

            Transaction::addTransaction($invoicePayment);

            $customer = Customer::where('id', $invoice->customer_id)->first();

            $payment            = new InvoicePayment();
            $payment->name      = $customer['first_name'].' '.$customer['last_name'];
            $payment->date      = date("Y-m-d H:i:s", strtotime($request->date));
            $payment->amount    = $request->amount;
            $payment->invoice   = $invoice->id;
            $payment->dueAmount = $invoice->getDue();

            Utility::userBalance('customer', $invoice->customer_id, $request->amount, 'debit');

            Utility::bankAccountBalance($request->account_id, $request->amount, 'credit');

            return redirect()->back()->with('success', __('Payment Successfully Added.'));
        }

    }

    function invoiceNumber()
    {
        $latest = Invoice::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->invoice_id + 1;
    }

    public function paymentDestroy(Request $request, $invoice_id, $payment_id)
    {

        if(\Auth::user()->can('Delete Payment Invoice'))
        {
            $payment = InvoicePayment::find($payment_id);

            InvoicePayment::where('id', '=', $payment_id)->delete();

            $invoice = Invoice::where('id', $invoice_id)->first();
            $due     = $invoice->getDue();
            $total   = $invoice->getTotal();

            if($due > 0 && $total != $due)
            {
                $invoice->status = 3;

            }
            else
            {
                $invoice->status = 2;
            }

            $invoice->save();
            $type = 'Partial';
            $user = 'Customer';
            Transaction::destroyTransaction($payment_id, $type, $user);

            Utility::userBalance('customer', $invoice->customer_id, $payment->amount, 'credit');

            Utility::bankAccountBalance($payment->account_id, $payment->amount, 'debit');

            return redirect()->back()->with('success', __('Payment Successfully Deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function duplicate($invoice_id)
    {
        if(\Auth::user()->can('Duplicate Invoice'))
        {
            $invoice                            = Invoice::where('id', $invoice_id)->first();
            $duplicateInvoice                   = new Invoice();
            $duplicateInvoice->invoice_id       = $this->invoiceNumber();
            $duplicateInvoice->customer_id      = $invoice['customer_id'];
            $duplicateInvoice->transaction_date       = date('Y-m-d');
            $duplicateInvoice->due_date         = $invoice['due_date'];
            $duplicateInvoice->send_date        = null;
            $duplicateInvoice->category_id        = $invoice['category_id'];
            $duplicateInvoice->status           = 0;
            $duplicateInvoice->billing_address     = $invoice['billing_address'];
            $duplicateInvoice->discount_type     = $invoice['discount_type'];
            $duplicateInvoice->discount_value     = $invoice['discount_value'];
            $duplicateInvoice->created_by       = $invoice['created_by'];
            $duplicateInvoice->save();

            if($duplicateInvoice)
            {
                $invoiceProduct = InvoiceProduct::where('invoice_id', $invoice_id)->get();
                foreach($invoiceProduct as $product)
                {
                    $duplicateProduct             = new InvoiceProduct();
                    $duplicateProduct->invoice_id = $duplicateInvoice->id;
                    $duplicateProduct->product_id = $product->product_id;
                    $duplicateProduct->quantity   = $product->quantity;
                    $duplicateProduct->tax        = $product->tax;
                    $duplicateProduct->price      = $product->price;
                    $duplicateProduct->save();
                }
            }

            return redirect()->back()->with('success', __('Invoice Duplicate Successfully.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function paymentReminder($invoice_id)
    {
        $invoice            = Invoice::find($invoice_id);
        $customer           = Customer::where('id', $invoice->customer_id)->first();
        $invoice->dueAmount = \Auth:: user()->priceFormat($invoice->getDue());
        $invoice->name      = $customer['first_name'].' '.$customer['last_name'];
        $invoice->date      = Utility::getDateFormated($invoice->send_date);
        $invoice->invoice   = \Auth::user()->invoiceNumberFormat($invoice->invoice_id);

        try
        {
            Mail::to($customer['email'])->send(new PaymentReminder($invoice));
        }
        catch(\Exception $e)
        {
            $smtp_error = $e->getMessage();
        }

        return redirect()->back()->with('success', __('Payment reminder successfully send.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
    }

    public function resent($id)
    {
        if(\Auth::user()->can('Send Invoice'))
        {
            $invoice = Invoice::where('id', $id)->first();

            $customer         = Customer::where('id', $invoice->customer_id)->first();
            $invoice->name    = !empty($customer) ? $customer->first_name.' '.$customer->last_name : '';
            $invoice->invoice = \Auth::user()->invoiceNumberFormat($invoice->invoice_id);

            $invoiceId    = Crypt::encrypt($invoice->id);
            $invoice->url = route('invoice.pdf', $invoiceId);

            try
            {
                Mail::to($customer->email)->send(new InvoiceSend($invoice));

            }
            catch(\Exception $e)
            {
                $smtp_error = $e->getMessage();
            }

            return redirect()->back()->with('success', __('Invoice successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function customerInvoiceSend($invoice_id)
    {
        return view('accounting.users.customer.invoice_send', compact('invoice_id'));
    }

    public function customerInvoiceSendMail(Request $request, $invoice_id)
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

        $email   = $request->email;
        $invoice = Invoice::where('id', $invoice_id)->first();

        $customer         = Customer::where('id', $invoice->customer_id)->first();
        $invoice->name    = !empty($customer) ? $customer->first_name.' '.$customer->last_name : '';
        $invoice->invoice = \Auth::user()->invoiceNumberFormat($invoice->invoice_id);

        $invoiceId    = Crypt::encrypt($invoice->id);
        $invoice->url = route('invoice.pdf', $invoiceId);

        try
        {
            Mail::to($email)->send(new CustomerInvoiceSend($invoice));
        }
        catch(\Exception $e)
        {
            $smtp_error = $e->getMessage();
        }

        return redirect()->back()->with('success', __('Invoice successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));

    }

    public function invoice($invoice_id)
    {
        $settings = Utility::settings();

        $invoiceId = Crypt::decrypt($invoice_id);
        $invoice   = Invoice::where('id', $invoiceId)->first();

        $data  = DB::table('settings');
        $data  = $data->where('created_by', '=', $invoice->created_by);
        $data1 = $data->get();

        foreach($data1 as $row)
        {
            $settings[$row->name] = $row->value;
        }

        $customer      = $invoice->customer;
        $items         = [];
        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate     = 0;
        $totalDiscount = 0;
        $taxesData     = [];
        foreach($invoice->items as $product)
        {
            $item           = new \stdClass();
            $item->name     = !empty($product->product()) ? $product->product()->product_name : '';
            $item->quantity = $product->quantity;
            $item->tax      = !empty($product->taxes) ? $product->taxes->rate : '';;
            $item->discount = $invoice->discount_value;
            $item->price    = $product->price;


            $totalQuantity += $item->quantity;
            $totalRate     += $item->price;
            $totalDiscount += $item->discount;

            $taxes = \Utility::tax($product->tax);

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
            $items[]       = $item;
        }

        $invoice->items         = $items;
        $invoice->totalTaxPrice = $totalTaxPrice;
        $invoice->totalQuantity = $totalQuantity;
        $invoice->totalRate     = $totalRate;
        $invoice->totalDiscount = $totalDiscount;
        $invoice->taxesData     = $taxesData;

        //Set your logo
        $logo         = asset(Storage::url('logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        if($invoice)
        {
            $color      = '#' . $settings['invoice_color'];
            $font_color = Utility::getFontColor($color);

            return view('accounting.transaction.sales.invoice.templates.' . $settings['invoice_template'], compact('invoice', 'color', 'settings', 'customer', 'img', 'font_color'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }

    }

    public function saveTemplateSettings(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        if(isset($post['invoice_template']) && (!isset($post['invoice_color']) || empty($post['invoice_color'])))
        {
            $post['invoice_color'] = "ffffff";
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

        return redirect()->back()->with('success', __('Invoice Setting updated successfully'));
    }

    public function previewInvoice($template, $color)
    {
        $objUser  = \Auth::user();
        $settings = Utility::settings();
        $invoice  = new Invoice();

        $customer                   = new \stdClass();
        $customer->first_name     = '<Customer First Name>';
        $customer->last_name     = '<Customer Last Name>';

        $customer_detail                   = new \stdClass();
        $customer_detail->country  = '<Country>';
        $customer_detail->state    = '<State>';
        $customer_detail->city     = '<City>';
        $customer_detail->phone_no    = '<Customer Phone Number>';
        $customer_detail->post_code      = '<Post Code>';
        $customer_detail->address1  = '<Address1>';
        $customer_detail->address2  = '<Address2>';
        $customer->customerdetail = $customer_detail;      

        $totalTaxPrice = 0;
        $taxesData     = [];

        $items = [];
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

        $invoice->invoice_id = 1;
        $invoice->transaction_date = date('Y-m-d H:i:s');
        $invoice->due_date   = date('Y-m-d H:i:s');
        $invoice->items      = $items;

        $invoice->totalTaxPrice = 60;
        $invoice->totalQuantity = 3;
        $invoice->totalRate     = 300;
        $invoice->totalDiscount = 10;
        $invoice->taxesData     = $taxesData;


        $preview    = 1;
        $color      = '#' . $color;
        $font_color = Utility::getFontColor($color);

        $logo         = asset(Storage::url('logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        return view('accounting.transaction.sales.invoice.templates.' . $template, compact('invoice', 'preview', 'color', 'img', 'settings', 'customer', 'font_color'));
    }

}
