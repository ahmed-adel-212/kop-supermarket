<?php

namespace App\Http\Controllers\Api;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

use App\Models\Payment;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Validator;

class PaymentController extends BaseController
{


    public function index($amount)
    {
        return view('api.paymentMobile', compact(['amount']));
    }

    public function get_payment(Request $request)
    {
        $amount=$request->amount;
        $validator_rules = [
            'source.name' => 'required',
            'source.cvc' => 'required|max:4|min:3',
            'source.number' => 'required|digits:16',
            'source.month' => 'required|in:01,02,03,04,05,06,07,08,09,10,11,12',
            'source.year' => 'required|digits:4|integer|min:' . (date('Y')),
        ];
        $validator_rules_messages = [
            'source.name.required' => 'The name is required',
            'source.cvc.required' => 'The cvc is required',
            'source.cvc.max' => 'The cvc is too long max is 4 numbers',
            'source.cvc.min' => 'The cvc is too short min is 3 numbers',
            'source.number.digits' => 'The cart number must be 16 digits',
            'source.number.required' => 'The cart number is required',
            'source.month.required' => 'The month is required',
            'source.month.in' => 'The month is not valid',
            'source.year.required' => 'The year is required',
            'source.year.min' => 'The year is Not Valid',
        ];


        // If validation fails, redirect to the settings page and send the errors
//        $validatedData = $request->validate($validator_rules,$validator_rules_messages);
        $validatedData = Validator::Make($request->all(), $validator_rules, $validator_rules_messages);
        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData->getMessageBag())->withInput();
        }

        try {

            $request->request->remove('_token');
            $request = $request->merge(['amount' => (int)ceil($request->amount * 100)]);
            $endpoint = "https://api.moyasar.com/v1/payments.html";
            $redir = [];
            $client = new Client(['allow_redirects' => true,]);
            $response = $client->request('POST', $endpoint, [
                'form_params' => $request->all(),
                'on_stats' => function (TransferStats $stats) use (&$redir) {
                    $redir[] = (string)$stats->getEffectiveUri();
                }
            ]);

            if ($response->getStatusCode() == '200')
                return redirect($redir[1]);

        } catch (ClientException  $exception) {
            //$responseBody = $exception->getResponse()->getBody(true)->getContents();
            $response = json_decode($exception->getResponse()->getBody(true)->getContents(), true);
            // dd($response);
            $errors = $response['errors'];
            if ($errors) {
                session()->flash('err', $errors);
            }
            dd(session()->get('err'));
            return redirect(route('get.paymentMobile',$amount))->withInput();
        }

    }

    public function paymentResponse(Request $request)
    {
        $data = [];
        $data['data'] = $request->all();
        return view('api.payment', compact(['data']));
    }

    public function refund($payment_id)
    {

        try {
            $payment = Payment::find($payment_id);

            if ($payment->status == 'paid') {
                $paymentService = new \Moyasar\Providers\PaymentService();
                $payment_service = $paymentService->fetch($payment->payment_id);
                $payment_service->refund(); // 10.00 SAR
                $payment->update([
                    'status' => 'refunded'
                ]);
                return $this->sendResponse($payment, 'This payment has been refunded');

            }
            if ($payment->status == 'refunded') {
                return $this->sendResponse($payment, 'This payment is already refunded');
            }


        } catch (\Moyasar\Exceptions\ApiException $e) {
            $e->getCode(); // HTTP Status Code
            $e->type(); // Error Type
            $e->getMessage(); // Error Message
            $e->errors(); // Empty Array
            return $this->sendError($payment, $e->getMessage());

        }
    }
}
