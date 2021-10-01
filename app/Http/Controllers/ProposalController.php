<?php

namespace App\Http\Controllers;

use App\Utility;
use App\Customer;
use App\Proposal;
use App\ProductCategory;
use App\ProposalProduct;
use App\Mail\ProposalSend;
use App\ProductAndService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function product(Request $request)
    {
        $data = [];
        if(!empty($request->product_id))
        {
            $product = ProductAndService::find($request->product_id);
            $data['sale_price'] = $product->sale_price;

            $data['taxRate'] = $taxRate = $product->taxRate($product->tax_rate_id);
            $data['taxes']   = $product->taxs($product->tax_rate_id);
            
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

    public function index()
    {
        if(\Auth::user()->can('Manage Invoice Proposals'))
        {
            $status = Proposal::$statues;
            $query = Proposal::where('created_by', '=', \Auth::user()->creatorId());
            $proposals = $query->get();
            return view('accounting.transaction.sales.proposal.index', compact('proposals', 'status'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Invoice Proposal'))
        {
            $proposal_number = \Auth::user()->proposalNumberFormat($this->proposalNumber());
    
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
            return view('accounting.transaction.sales.proposal.create',compact('customers','products','proposal_number','category'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Invoice Proposal'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                    'customer' => 'required|not_in:0',
                                    'transaction_date' => 'required',
                                    'category' => 'required|not_in:0',
                                    'items' => 'required',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }
            $status = Proposal::$statues;
            $proposal                 = new Proposal();
            $proposal->proposal_id    = $this->proposalNumber();
            $proposal->customer_id    = $request->customer;
            $proposal->status         = 0;
            $proposal->transaction_date     = date("Y-m-d H:i:s", strtotime($request->transaction_date));
            $proposal->category_id = $request->category;
            $proposal->billing_address     = $request->billing_address;
            $proposal->discount_type     = $request->discount_type;
            $proposal->discount_value     = (!empty($request->discount_value) ? $request->discount_value : 0);
            $proposal->created_by     =  \Auth::user()->creatorId();
            $proposal->save();

            $products = $request->items;

            for($i = 0; $i < count($products); $i++)
            {
                $proposalProduct              = new ProposalProduct();
                $proposalProduct->proposal_id = $proposal->id;
                $proposalProduct->product_id  = $products[$i]['item'];
                $proposalProduct->quantity    = $products[$i]['quantity'];
                $proposalProduct->tax         = $products[$i]['tax'];
                $proposalProduct->price       = $products[$i]['price'];
                $proposalProduct->save();
            }

            return redirect()->route('proposals.index')->with('success', __('Proposal Successfully Created.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission Denied.'));
        }
    }

    public function show(Proposal $proposal)
    {
        if(\Auth::user()->can('View Invoice Proposal'))
        {
            if($proposal->created_by == \Auth::user()->creatorId())
            {
               // $invoicePayment = InvoicePayment::where('invoice_id', $invoice->id)->first();
               $settings = Utility::settings();
                $customer = $proposal->customer;
                $iteams   = $proposal->items;
                $status   = Proposal::$statues;

                return view('accounting.transaction.sales.proposal.view', compact('proposal', 'customer', 'iteams','settings', 'status'));
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


    public function edit(Proposal $proposal)
    {
        if(\Auth::user()->can('Edit Invoice Proposal'))
        {
            $proposal_number = \Auth::user()->proposalNumberFormat($proposal->proposal_id);
            
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
            return view('accounting.transaction.sales.proposal.edit',compact('customers','products','proposal', 'proposal_number','category'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function update(Request $request, Proposal $proposal)
    {
        if(\Auth::user()->can('Edit Invoice Proposal'))
        {
                if($proposal->created_by == \Auth::user()->creatorId())
                {
                    $validator = \Validator::make(
                        $request->all(), [
                                            'customer' => 'required|not_in:0',
                                            'transaction_date' => 'required',
                                            'category' => 'required|not_in:0',
                                            'items' => 'required',
                                    ]
                    );
                    if($validator->fails())
                    {
                        return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                    }
                    $status = Proposal::$statues;
                    $proposal->customer_id    = $request->customer;
                    $proposal->transaction_date     = date("Y-m-d H:i:s", strtotime($request->transaction_date));
                    $proposal->category_id = $request->category;
                    $proposal->billing_address     = $request->billing_address;
                    $proposal->discount_type     = $request->discount_type;
                    $proposal->discount_value     = (!empty($request->discount_value) ? $request->discount_value : 0);
                    $proposal->save();

                    $products = $request->items;

                    for($i = 0; $i < count($products); $i++)
                    {
                        $proposalProduct = ProposalProduct::find($products[$i]['id']);

                        if($proposalProduct == null)
                        {
                            $proposalProduct             = new ProposalProduct();
                            $proposalProduct->proposal_id = $proposal->id;
                        }

                        if(isset($products[$i]['product_id']))
                        {
                            $proposalProduct->product_id = $products[$i]['product_id'];
                        }

                        // $invoiceProduct              = new InvoiceProduct();
                        // $invoiceProduct->invoice_id  = $invoice->id;
                        // $invoiceProduct->product_id  = $products[$i]['item'];
                        $proposalProduct->quantity    = $products[$i]['quantity'];
                        $proposalProduct->tax         = $products[$i]['tax'];
                        $proposalProduct->price       = $products[$i]['price'];
                        $proposalProduct->save();
                    }

                    return redirect()->route('proposals.index')->with('success', __('Proposal Successfully Updated.'));
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

    public function destroy(Proposal $proposal)
    {
        if(\Auth::user()->can('Delete Invoice Proposal'))
        {
            if($proposal->created_by == \Auth::user()->creatorId())
            {
                $proposal->delete();
                ProposalProduct::where('proposal_id', '=', $proposal->id)->delete();

                return redirect()->route('proposals.index')->with('success', __('Proposal Successfully Deleted.'));
            }
            else
            {
                return redirect()->back()->with('errors', __('Permission Denied.'),401);
            }
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function productDestroy(Request $request)
    {
        if(\Auth::user()->can('Delete Proposal Product'))
        {
            ProposalProduct::where('id', '=', $request->id)->delete();
            return redirect()->back()->with('success', __('Bill Product Successfully Deleted.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function items(Request $request)
    {
        
        $items = ProposalProduct::where('proposal_id', $request->proposal_id)->where('product_id', $request->product_id)->first();
        return json_encode($items);
    }

    public function sent($id)
    {
        if(\Auth::user()->can('Send Invoice Proposal'))
        {
            $proposal            = Proposal::where('id', $id)->first();
            $proposal->send_date = date('Y-m-d');
            $proposal->status    = 1;
            $proposal->save();
            $customer         = Customer::where('id', $proposal->customer_id)->first();
            $proposal->name    = !empty($customer) ? $customer->first_name.' '.$customer->last_name : '';
            $proposal->proposal = \Auth::user()->proposalNumberFormat($proposal->proposal_id);
            return redirect()->back()->with('success', __('Proposal Successfully Sent.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function statusChange(Request $request, $id)
    {
        $status           = $request->status;
        $proposal         = Proposal::find($id);
        $proposal->status = $status;
        $proposal->save();

        return redirect()->back()->with('success', __('Proposal Status Changed Successfully.'));
    }

    public function duplicate($proposal_id)
    {
        if(\Auth::user()->can('Duplicate Invoice Proposal'))
        {
            $proposal                       = Proposal::where('id', $proposal_id)->first();
            $duplicateProposal              = new Proposal();
            $duplicateProposal->proposal_id = $this->proposalNumber();
            $duplicateProposal->customer_id      = $proposal['customer_id'];
            $duplicateProposal->transaction_date       = date('Y-m-d');
            $duplicateProposal->send_date        = null;
            $duplicateProposal->category_id        = $proposal['category_id'];
            $duplicateProposal->status           = 0;
            $duplicateProposal->billing_address     = $proposal['billing_address'];
            $duplicateProposal->discount_type     = $proposal['discount_type'];
            $duplicateProposal->discount_value     = $proposal['discount_value'];
            $duplicateProposal->created_by       = $proposal['created_by'];
            $duplicateProposal->save();

            if($duplicateProposal)
            {
                $proposalProduct = ProposalProduct::where('proposal_id', $proposal_id)->get();
                foreach($proposalProduct as $product)
                {
                    $duplicateProduct             = new ProposalProduct();
                    $duplicateProduct->proposal_id = $duplicateProposal->id;
                    $duplicateProduct->product_id = $product->product_id;
                    $duplicateProduct->quantity   = $product->quantity;
                    $duplicateProduct->tax        = $product->tax;
                    $duplicateProduct->price      = $product->price;
                    $duplicateProduct->save();
                }
            }

            return redirect()->back()->with('success', __('Proposal Duplicate Successfully.'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    function proposalNumber()
    {
        $latest = Proposal::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->proposal_id + 1;
    }

    public function resent($id)
    {
        if(\Auth::user()->can('Send Invoice Proposal'))
        {
            $proposal = Proposal::where('id', $id)->first();

            $customer           = Customer::where('id', $proposal->customer_id)->first();
            $proposal->name     = !empty($customer) ? $customer->first_name.' '.$customer->last_name : '';
            $proposal->proposal = \Auth::user()->proposalNumberFormat($proposal->proposal_id);

            $proposalId    = Crypt::encrypt($proposal->id);
            $proposal->url = route('proposal.pdf', $proposalId);

            try
            {
                Mail::to($customer->email)->send(new ProposalSend($proposal));
            }
            catch(\Exception $e)
            {
                $smtp_error = $e->getMessage();
            }

            return redirect()->back()->with('success', __('Proposal successfully sent.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }
    }

    public function saveProposalTemplateSettings(Request $request)
    {
        $post = $request->all();
        unset($post['_token']);

        if(isset($post['proposal_template']) && (!isset($post['proposal_color']) || empty($post['proposal_color'])))
        {
            $post['proposal_color'] = "ffffff";
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

        return redirect()->back()->with('success', __('Proposal Setting updated successfully'));
    }

    public function previewProposal($template, $color)
    {
        $objUser  = \Auth::user();
        $settings = Utility::settings();
        $proposal = new Proposal();

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

        $proposal->proposal_id = 1;
        $proposal->transaction_date  = date('Y-m-d H:i:s');
        $proposal->due_date    = date('Y-m-d H:i:s');
        $proposal->items       = $items;

        $proposal->totalTaxPrice = 60;
        $proposal->totalQuantity = 3;
        $proposal->totalRate     = 300;
        $proposal->totalDiscount = 10;
        $proposal->taxesData     = $taxesData;

        $preview    = 1;
        $color      = '#' . $color;
        $font_color = Utility::getFontColor($color);

        $logo         = asset(Storage::url('logo'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        return view('accounting.transaction.sales.proposal.templates.' . $template, compact('proposal', 'preview', 'color', 'img', 'settings', 'customer', 'font_color'));
    }

    public function proposal($proposal_id)
    {

        $settings   = Utility::settings();
        $proposalId = Crypt::decrypt($proposal_id);
        $proposal   = Proposal::where('id', $proposalId)->first();

        $data  = DB::table('settings');
        $data  = $data->where('created_by', '=', $proposal->created_by);
        $data1 = $data->get();

        foreach($data1 as $row)
        {
            $settings[$row->name] = $row->value;
        }

        $customer = $proposal->customer;

        $items         = [];
        $totalTaxPrice = 0;
        $totalQuantity = 0;
        $totalRate     = 0;
        $totalDiscount = 0;
        $taxesData     = [];
        foreach($proposal->items as $product)
        {
            $item           = new \stdClass();
            $item->name     = !empty($product->product) ? $product->product->product_name : '';
            $item->quantity = $product->quantity;
            $item->tax      =  !empty($product->taxes) ? $product->taxes->rate : '';
            $item->discount = $proposal->discount_value;
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

        $proposal->items         = $items;
        $proposal->totalTaxPrice = $totalTaxPrice;
        $proposal->totalQuantity = $totalQuantity;
        $proposal->totalRate     = $totalRate;
        $proposal->totalDiscount = $totalDiscount;
        $proposal->taxesData     = $taxesData;

        //Set your logo
        $logo         = asset(Storage::url('logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo.png'));

        if($proposal)
        {
            $color      = '#' . $settings['proposal_color'];
            $font_color = Utility::getFontColor($color);

            return view('accounting.transaction.sales.proposal.templates.' . $settings['proposal_template'], compact('proposal', 'color', 'settings', 'customer', 'img', 'font_color'));
        }
        else
        {
            return redirect()->back()->with('errors', __('Permission denied.'));
        }

    }

}
