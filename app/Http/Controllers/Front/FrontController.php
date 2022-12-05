<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;

use App\Models\Product;
use App\Models\Contact;

class FrontController extends Controller
{
    // View Home Page
    public function index() {
        return view('front.home'); 
    }      

    // Switch Language
    public function lang($lang) {
        Session::put('locale',$lang);
        return redirect()->back();  
    }    

    // View About Page
    public function about() { 
        return view('front.about'); 
    }      

    // View Contact Page
    public function contact() { 
        return view('front.contact'); 
    }     


    // View Home Page with chosen currency
    public function currency() {
        $cur_input = request()->cur_input;
        $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            $response_object = json_decode($response_json);
            if($cur_input == 'EUR')      { $cur_currency = $response_object->rates->EUR; $cur_symbol='€';   $cur_title=__('controller.Euro');                $cur_code ='EUR'; }
            else if($cur_input == 'AED') { $cur_currency = $response_object->rates->AED; $cur_symbol='AED'; $cur_title=__('controller.Emirati Dirham');      $cur_code ='AED'; }
            else if($cur_input == 'SAR') { $cur_currency = $response_object->rates->SAR; $cur_symbol='SAR'; $cur_title=__('controller.Saudi Arabian Riyal'); $cur_code ='SAR'; }
            else if($cur_input == 'EGP') { $cur_currency = $response_object->rates->EGP; $cur_symbol='EGP'; $cur_title=__('controller.Egyptian Pound');      $cur_code ='EGP'; }
            else if($cur_input == 'SYP') { $cur_currency = $response_object->rates->SYP; $cur_symbol='SYP'; $cur_title=__('controller.Syrian Pound');        $cur_code ='SYP'; }
            else                         { $cur_currency = 1;                            $cur_symbol='$';   $cur_title=__('controller.US Dollar');      $cur_code='USD'; }
        }
        else { $cur_currency = 1; $cur_symbol='$'; $cur_title='US Dollar'; $cur_code='USD'; }
        
        session()->put('cur_currency', $cur_currency);
        session()->put('cur_symbol', $cur_symbol);
        session()->put('cur_title', $cur_title);
        session()->put('cur_code', $cur_code);
        return back();
    }    
        
    // Handle Contact Form
    public function contactForm() { 
        //  ==== Validate data
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ); 
        $niceName = array(
            'name' => 'Name',
            'email'   => 'Email',
            'message'   => 'Message',
        );
        $errors = array(
            'name' => '',
            'email' => '',
            'message' => '',
        );
        $error = Validator::make(request()->all(), $rules);
        if($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        Contact::create([
            'name'     => request('name'),
            'email'    => request('email'),
            'message'    => request('message'),
            ]);
        
        return response()->json(['success' =>  __('controller.SuccessContact', ['attribute' => request('name')]) ]);
    }  

    // get sizes for specific color
    public function getColors() {
        $code = $_GET['code'];
        $color = $_GET['color'];
        $colors = Product::where([['code','=', $code], ['color','=', $color]])->get();
        return response()->json(['success' => $colors]);
    }   

    // test page
    public function test() {
        
        return 'No Response';
    }
}
