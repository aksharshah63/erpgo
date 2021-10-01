<?php

namespace App\Http\Controllers;

use App\Utility;
use App\Mail\testMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SystemController extends Controller
{
    public function companyIndex()
    {
        try {
            $settings = Utility::settings();
            return view('settings.company', compact('settings'));
        } catch (\Exception $e) {
            return response()->json(['errors' => __('Permission Denied')],401);
         }
    }

    public function saveBusinessSettings(Request $request)
    {

        try {
            $user = \Auth::user();

            $logoName = '';
            $favicon = '';

            if($request->company_logo)
            {
                $request->validate(
                    [
                        'company_logo' => 'image|mimes:png|max:20480',
                    ]
                );

                $logoName     = $user->id . '_logo.png';
                $path         = $request->file('company_logo')->storeAs('logo', $logoName);
                // $company_logo = !empty($request->company_logo) ? $logoName : 'logo.png';
            }

            if($request->company_favicon)
            {
                $request->validate(
                    [
                        'company_favicon' => 'image|mimes:png|max:20480',
                    ]
                );
                $favicon = $user->id . '_favicon.png';
                $path    = $request->file('company_favicon')->storeAs('logo', $favicon);
                // $company_favicon = !empty($request->favicon) ? $favicon : 'favicon.png';
            }

            if($request->landing_logo)
            {
                $request->validate(
                    [
                        'landing_logo' => 'image|mimes:png|max:20480',
                    ]
                );
                $landing_logo = 'landing_logo.png';
                $path    = $request->file('landing_logo')->storeAs('logo', $landing_logo);
                // $company_favicon = !empty($request->favicon) ? $favicon : 'favicon.png';
            }

            $post = [];
            $post['title_text'] = (!empty($request->title_text) ? $request->title_text: '');
            $post['footer_title'] = (!empty($request->footer_title) ? $request->footer_title: '');
            $post['enable_landing'] = isset($request->enable_landing) ? 'yes' : 'no';
            if(!empty($logoName))
            {
                $post['company_logo'] = $logoName;
            }
            if(!empty($favicon))
            {
                $post['company_favicon'] = $favicon;
            }

            unset($post['_token']);
           
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

            return redirect()->back()->with('success', 'Logo successfully updated.');
        }
        catch (\Exception $e) {
            return response()->json(['errors' => __('Permission Denied')],401);
         }
    }

    public function saveSystemSettings(Request $request)
    {

        try{
            $user = \Auth::user();
            $request->validate(
                [
                    'site_currency' => 'required',
                ]
            );
            $post = $request->all();
            unset($post['_token']);

            foreach($post as $key => $data)
            {
                \DB::insert(
                    'insert into settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                                                                 $data,
                                                                                                                                                                                 $key,
                                                                                                                                                                                 \Auth::user()->creatorId(),
                                                                                                                                                                                 date('Y-m-d H:i:s'),
                                                                                                                                                                                 date('Y-m-d H:i:s'),
                                                                                                                                                                             ]
                );
            }

            return redirect()->back()->with('success', __('Setting Successfully Updated.'));

        }
        catch (\Exception $e) {
            return response()->json(['errors' => __('Permission Denied')],401);
         }
    }

    public function saveCompanySettings(Request $request)
    {
        try{
            $user = \Auth::user();
            $request->validate(
                [
                    'company_name' => 'required|string|max:255',
                    'company_email' => 'required',
                    'company_email_from_name' => 'required|string',
                ]
            );
            $post = $request->all();
            unset($post['_token']);

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

            return redirect()->back()->with('success', __('Setting Successfully Updated.'));
        }
        catch (\Exception $e) {
            return response()->json(['errors' => __('Permission Denied')],401);
         }
    }
    public function saveEmailSettings(Request $request)
    {
        if(\Auth::user()->can('Manage System Settings'))
        {
            $request->validate(
                [
                    'mail_driver' => 'required|string|max:255',
                    'mail_host' => 'required|string|max:255',
                    'mail_port' => 'required|string|max:255',
                    'mail_username' => 'required|string|max:255',
                    'mail_password' => 'required|string|max:255',
                    'mail_encryption' => 'required|string|max:255',
                    'mail_from_address' => 'required|string|max:255',
                    'mail_from_name' => 'required|string|max:255',
                ]
            );

            $arrEnv = [
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_NAME' => $request->mail_from_name,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            ];
            Utility::setEnvironmentValue($arrEnv);

            return redirect()->back()->with('success', __('Setting successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('errors', 'Permission denied.');
        }

    }
    public function testMail()
    {
        return view('settings.test_mail');
    }

    public function testSendMail(Request $request)
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
        
        try
        {
            Mail::to($request->email)->send(new testMail());
        }
        catch(\Exception $e)
        {
            $smtp_error = $e->getMessage();
        }

        return redirect()->back()->with('success', __('Email send Successfully.') . ((isset($smtp_error)) ? '<br> <span class="text-danger">' . $smtp_error . '</span>' : ''));

    }

    public function savePaymentSettings(Request $request)
    {

        if(\Auth::user()->can('Manage Stripe Settings'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'currency' => 'required|string|max:255',
                                   'currency_symbol' => 'required|string|max:255',
                               ]
            );
            if($validator->fails())
            {
                return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
            }


            if(isset($request->enable_stripe) && $request->enable_stripe == 'on')
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'stripe_key' => 'required|string|max:255',
                                       'stripe_secret' => 'required|string|max:255',
                                   ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }

            }
            elseif(isset($request->enable_paypal) && $request->enable_paypal == 'on')
            {


                $validator = \Validator::make(
                    $request->all(), [

                                       'paypal_client_id' => 'required|string',
                                       'paypal_secret_key' => 'required|string',
                                   ]
                );
                if($validator->fails())
                {
                    return redirect()->back()->with('errors', Utility::errorFormat($validator->getMessageBag()));
                }
            }


            $arrEnv = [
                'CURRENCY_SYMBOL' => $request->currency_symbol,
                'CURRENCY' => $request->currency,
                'ENABLE_STRIPE' => $request->enable_stripe ?? 'off',
                'STRIPE_KEY' => $request->stripe_key,
                'STRIPE_SECRET' => $request->stripe_secret,
                'ENABLE_PAYPAL' => $request->enable_paypal ?? 'off',
                'PAYPAL_MODE' => $request->paypal_mode,
                'PAYPAL_CLIENT_ID' => $request->paypal_client_id,
                'PAYPAL_SECRET_KEY' => $request->paypal_secret_key,

            ];

            Utility::setEnvironmentValue($arrEnv);

            $post = $request->all();
            unset($post['_token'], $post['stripe_key'], $post['stripe_secret']);

            foreach($post as $key => $data)
            {
                \DB::insert(
                    'insert into settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                                                                 $data,
                                                                                                                                                                                 $key,
                                                                                                                                                                                 \Auth::user()->creatorId(),
                                                                                                                                                                                 date('Y-m-d H:i:s'),
                                                                                                                                                                                 date('Y-m-d H:i:s'),
                                                                                                                                                                             ]
                );
            }

            return redirect()->back()->with('success', __('Stripe successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('errors', 'Permission denied.');
        }
    }

}
