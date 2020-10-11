<?php

namespace App\Http\Controllers\API;

use App\Booking;
use App\Earning;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Payment as PayUs;
use App\Question;
use App\RefundPayment;
use App\User;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;


/** Paypal Details classes **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use PayPal\Exception\PayPalConnectionException;
use Exception;
use PayPal\Api\Refund;

class PaymentController extends Controller
{
    private $api_context;
    public function __construct()
    {
        $this->api_context = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );
        $this->api_context->setConfig(config('paypal.settings'));
    }

    public static function makePayment(Request $request)
    {
        // Stripe::setApiKey(config('stripe.secret'));

        // $charge = Charge::create([
        //         "amount" => $request->bookingInfo['charge'] * 100,
        //         "currency" => config('stripe.currency'),
        //         "source" => $request->token,
        //         "description" => "Geek Booking payment"
        // ]);
        // $payment = Payment::create([
        //     'user_id' => $request->user['id'],
        //     'charge' => $request->bookingInfo['charge'],
        //     'receipt_url' => $charge->receipt_url,
        //     'refund_url' => $charge->refunds->url,
        // ]);
        // $booking = Booking::create([
        //     'geek_id' => $request->bookingInfo['id'],
        //     'user_id' => $request->user['id'],
        //     'payment_id' => $payment->id,
        //     'date' => $request->bookingInfo['date'],
        //     'time' => $request->bookingInfo['time'],
        //     'timezone' => $request->bookingInfo['timezone'],
        //     'talk_time' => $request->bookingInfo['charge'] / $request->bookingInfo['hourly_rate'],
        //     'status' => 'unapproved',
        //     'hourly_rate' => auth()->user()->hourly_rate,
        //     'phone' => $request->bookingInfo['phone'],
        // ]);

        // Notification::create([
        //     'user_id' => $request->bookingInfo['id'],
        //     'notification_page' => 'Bookings'
        // ]);

        return response()->json([
            'receipt_url' => $charge->receipt_url,
            'booking' => $booking
        ], 200);
    }




    /** This method sets up the paypal payment.
     **/
    public function createPayment(Request $request)
    {
        //Setup Payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        //Setup Amount
        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($request->amount);
        //Setup Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Your awesome Product!');
        //List redirect URLS
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($request->return_url);
        $redirectUrls->setCancelUrl($request->return_url);
        //And finally set all the prerequisites and create the  payment
        $payment = new Payment();

        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->api_context);
        //Return our payment info to the user
        return $response;
    }
    /**
     ** This method confirms if payment with paypal was processed successful and then execute the payment,
     ** we have 'paymentId, PayerID and token' in query string.
     **/

    public function executePaypal(Request $request)
    {
        /** Get the payment ID before session clear **/
        $paymentId = $request->get('payment_id');
        $payerId = $request->get('payer_id');


        $payment = Payment::get($paymentId, $this->api_context);
        $paymentExecution = new PaymentExecution();
        $paymentExecution->setPayerId($payerId);

        $executePayment = $payment->execute($paymentExecution, $this->api_context);
        if ($executePayment->getState() == 'approved') {
            if ($executePayment->transactions[0]->related_resources[0]->sale->state == 'completed') {

           /*
      * Here is where you would do your own stuff like add
      a record for the payment, trigger a hasPayed event,
      etc.
      */
                $payment = PayUs::create([
                    'user_id' => auth()->user()->id,
                    'charge' => $request->bookingInfo['charge'],
                    'receipt_url' => '',
                    'paypal_payment_id' => $paymentId,
                ]);
                $booking = Booking::create([
                    'geek_id' => $request->bookingInfo['id'],
                    'user_id' => auth()->user()->id,
                    'payment_id' => $payment->id,
                    'date' => $request->bookingInfo['date'],
                    'time' => $request->bookingInfo['time'],
                    'timezone' => $request->bookingInfo['timezone'],
                    'talk_time' => $request->bookingInfo['charge'] / $request->bookingInfo['hourly_rate'],
                    'status' => 'unapproved',
                    'hourly_rate' => User::find($request->bookingInfo['id'])->hourly_rate,
                    'phone' => $request->bookingInfo['phone'],
                ]);

                Notification::create([
                    'user_id' => $request->bookingInfo['id'],
                    'notification_page' => 'Bookings'
                ]);

                // Do something to signify we succeeded

                return response()->json(
                    [
                    'status' => "success",
                    ],
                    200
                );
            }
        }
        return response()->json('failed', 400);
    }

    public function request_refund(Request $request)
    {
        $main_data = $request->data;
        unset($main_data['booking']);
        $main_data['text'] = serialize(['problem' => $main_data['text']]);
        RefundPayment::create($main_data);

        Notification::create([
            'user_id' => $request->data['booking']['user_id'],
            'notification_page' => 'Booking',
        ]);
        return response()->json(RefundPayment::all());
    }

    public function all_refunds()
    {
        $refunds = RefundPayment::all()->map(function ($fund) {
            $fund->text = unserialize($fund->text);
            return $fund;
        });
        return response()->json($refunds);
    }

    public function refund(Request $request)
    {
        //Previosly saved payments ID.
        $paymentId = PayUs::find($request->data['payment_id'])->paypal_payment_id;

        $current_refund = RefundPayment::where('booking_id', $request->data['id'])->first();
        $current_refund_msg = unserialize($current_refund->text);
        $current_refund_msg['reply'] = $request->data['replyText'];

        $current_refund->update([
            'status' => 'accepted',
            'text' => serialize($current_refund_msg)
        ]);
        $earnings = Earning::where('geek_id', auth()->user()->id)->first();
        $earnings->update([
            'total_earnings' =>  $earnings->total_earnings - PayUs::find($request->data['payment_id'])->charge,
            'remaining_earnings' => $earnings->remaining_earnings - PayUs::find($request->data['payment_id'])->charge
        ]);



        //Get sale from payment
        $paypalPayment = new Payment();
        $paymentInfo = $paypalPayment->get($paymentId, $this->api_context);

        $transactions = $paymentInfo->getTransactions();
        if (empty($transactions[0])) {
            return false;
        }

        $relatedResources = $transactions[0]->getRelatedResources();
        if (empty($relatedResources[0])) {
            return false;
        }
        $sale = $relatedResources[0]->getSale();

        $refund = new Refund();
        // (new Amount())->setTotal(PayUs::find(PayUs::find($request->data['payment_id'])->paypal_payment_id)->setCurrency('USD');
        $amt = (new Amount())->setTotal(PayUs::find($request->data['payment_id'])->charge)->setCurrency('USD');
        $refund->setAmount($amt);
        $refund->setReason('Booking Refund');

        Notification::create([
            'user_id' => $request->data['user_id'],
            'notification_page' => 'Booking',
        ]);

        $refundedSale = $sale->refund($refund, $this->api_context);
        if ($refundedSale->getState() === 'completed') {
            return response()->json(RefundPayment::all());
        }
    }

    public function refundReject(Request $request)
    {
        $current_refund = RefundPayment::where('booking_id', $request->data['id'])->first();
        $current_refund_msg = unserialize($current_refund->text);
        $current_refund_msg['reply'] = $request->data['replyText'];

        $current_refund->update([
            'status' => 'rejected',
            'text' => serialize($current_refund_msg)
        ]);

        Notification::create([
            'user_id' => $request->data['user_id'],
            'notification_page' => 'Booking',
        ]);
        return response()->json(RefundPayment::all());
    }
}
