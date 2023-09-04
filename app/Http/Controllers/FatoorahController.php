<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\services\FatoorahService;
class FatoorahController extends Controller
{
    private $fatoorahServices;
    public function __construct(FatoorahService  $fatoorahServices)
    {
        $this->fatoorahServices=$fatoorahServices;
        
    }
    public function payNow(){
       
        $data=[
            'NotificationOption' => 'Lnk',
            'InvoiceValue'       => '50',
            'CustomerName'       => 'bav',
            'CallBackUrl'        => 'http://localhost:8000/api/callback',
            'ErrorUrl'           => 'http://localhost:8000/api/error', 
            'CustomerEmail'      => 'bavly.eskander74@gmail.com',
            'DisplayCurrencyIso' => 'SAR',
            'Language'           => 'en', 
        ];

       return $this->fatoorahServices->payment($data);

    }

    public function callBack(Request $request){
        //save transaction in DB
        $data=[];
        $data['Key']=$request->paymentId;
        $data['KeyType']='KeyType';
        return $this->fatoorahServices->getPaymentStatus($data);        
    }
}
