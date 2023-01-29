<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\NicepayLib;
include_once(app_path() . '/Library/NicepayConfig.php');

class CancelPayment extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $nicepay = new NicepayLib();
        if(!empty($request->input('tXid')) && !empty($request->input('tXid'))){

            $nicepay->set('tXid', $request->input('tXid'));
            $nicepay->set('iMid', NICEPAY_IMID);
            $nicepay->set('merchantKey', NICEPAY_MERCHANT_KEY);
            $nicepay->set('amt', $request->input('amt'));
            $nicepay->set('payMethod', $request->input('payMethod'));
            $nicepay->set('cancelType', $request->input('cancelType'));
            $response = $nicepay->cancelTrans();

            // <RESPONSE from NICEPAY>
            if (isset($response->resultCd) && $response->resultCd == "0000") {
                return redirect()->route('cancelResult', (array) $response);
            } elseif(isset($response->resultCd)) {
                return redirect()->route('cancelResult', (array) $response);
            } else {
                $request->session()->flash('msg', 'Connection Timeout. Please Try Again!');
                return redirect()->route('otherError');
            }

        } else {
            $request->session()->flash('msg', 'Please Set Amount, ReferenceNo and tXid.');
            return redirect()->route('otherError');
        }
    }
}
