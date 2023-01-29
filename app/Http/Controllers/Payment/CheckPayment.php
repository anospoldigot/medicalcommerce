<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\NicepayLib;

class CheckPayment extends Controller
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

            // Populate Mandatory parameters to send
            $nicepay->set('tXid', $request->input('tXid'));
            $nicepay->set('iMid', $request->input('imid'));
            $nicepay->set('merchantKey', $request->input('merchantKey'));
            $nicepay->set('amt', $request->input('amt'));
            $nicepay->set('referenceNo', $request->input('referenceNo'));
            $nicepay->set('mitraCd', $request->input('mitraCd'));

            // <REQUEST to NICEPAY>
            $response = $nicepay->checkPaymentStatus();

            // <RESPONSE from NICEPAY>
            if (isset($response->resultCd) && $response->resultCd == "0000") {
                $request->session()->flash('payMethod', $request->input('payMethod'));
                return redirect()->route('checkPaymentResult', (array) $response);

            } elseif(isset($response->resultCd)) {
                return redirect()->route('checkPaymentResult', (array) $response);

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
