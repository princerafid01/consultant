<?php

namespace App\Http\Controllers\Admin;

use App\Earning;
use App\Http\Controllers\Controller;
use App\Notification;
use App\SystemEarning;
use App\User;
use App\WithdrawRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use PayPal\Api\Currency;
use PayPal\Api\Payout;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Yajra\DataTables\Facades\DataTables;

class EarningController extends Controller
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

    public function paypalWithdraw($data)
    {
        // Create a new instance of Payout object
        $payouts = new Payout();

        $senderBatchHeader = new PayoutSenderBatchHeader();

        // #### Batch Header Instance
        $senderBatchHeader->setSenderBatchId(uniqid())
                        ->setEmailSubject("You have a Payout!");

        // #### Sender Item
        // Please note that if you are using single payout with sync mode, you can only pass one Item in the request
        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
                ->setNote('Thanks for beign with Expense Geek!')
                ->setReceiver($data['email'])
                // ->setSenderItemId("2014031400023")
                ->setAmount(new Currency('{
                                    "value":"' . $data['amount'].'",
                                    "currency":"USD"
                                    }'));

        $payouts->setSenderBatchHeader($senderBatchHeader)
                ->addItem($senderItem);


        // For Sample Purposes Only.
        $request = clone $payouts;

        // ### Create Payout
        try {
            $output = $payouts->createSynchronous($this->api_context);
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            // ResultPrinter::printError("Created Single Synchronous Payout", "Payout", null, $request, $ex);
            exit(1);
        }

        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        // ResultPrinter::printResult("Created Single Synchronous Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);

        return $output;
    }

    public function index()
    {
        return view('admin.earnings.index');
    }

    public function earnings()
    {
        $withdraw_request = WithdrawRequest::all();
        return DataTables::of($withdraw_request)
        ->editColumn('geek_id', function (WithdrawRequest $current_withdraw_request) {
            return User::find($current_withdraw_request->geek_id)->name;
        })
        ->editColumn('created_at', function (WithdrawRequest $current_withdraw_request) {
            return Carbon::parse($current_withdraw_request->create_at)->format('M d, Y');
        })
        ->addColumn('action', function (WithdrawRequest $current_withdraw_request) {
            $view = '
            <a href="' .  route("view.earnings", $current_withdraw_request->id) .'" class="btn bg-info">View Request</a>
            ';
            return $view;
        })
        ->rawColumns(['geek_id','action','created_at'])
                ->make(true);
    }

    public function show(WithdrawRequest $withdraw)
    {
        return view('admin.earnings.show', compact('withdraw'));
    }

    public function reject(WithdrawRequest $withdraw)
    {
        $withdraw->status = 'rejected';
        $withdraw->save();

        Notification::create([
            'user_id' => $withdraw->geek_id,
            'notification_page' => 'Earnings'
        ]);

        request()->session()->flash('msg', 'Withdraw request rejected!');
        return back();
    }

    public function confirm(WithdrawRequest $withdraw)
    {
        $earning = Earning::where('geek_id', $withdraw->geek_id)->first();
        $geek_amount = $withdraw->amount * .82;
        $system_amount = $withdraw->amount * .18;
        $earning->withdraw_earnings = ($earning->withdraw_earnings ?? 0) + round($geek_amount);
        $earning->remaining_earnings = $earning->total_earnings - $withdraw->amount;
        $earning->save();

        $data['amount'] =  $geek_amount;
        $data['email'] =  $withdraw->paypal_email;
        $this->paypalWithdraw($data);

        Notification::create([
            'user_id' => $withdraw->geek_id,
            'notification_page' => 'Earnings'
        ]);

        SystemEarning::create([
            'type' => 'from_consultant',
            'user_id' => $withdraw->geek_id,
            'charge' => round($system_amount),
        ]);

        $withdraw->status = 'confirmed';
        $withdraw->save();
        request()->session()->flash('msg', 'Withdraw request Confirmed Successfully!');
        return back();
    }

    public function confirm_attachment(Request $request)
    {
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('withdraws');
        }
        $withdraw = WithdrawRequest::find($request->withdraw_id);
        $withdraw->attachment = $path;
        $withdraw->status = 'confirmed';
        $withdraw->save();

        Notification::create([
            'user_id' => $withdraw->geek_id,
            'notification_page' => 'Earnings'
        ]);


        $earning = Earning::where('geek_id', $withdraw->geek_id)->first();
        $geek_amount = round($withdraw->amount * .82);
        $system_amount = round($withdraw->amount * .18);
        $earning->withdraw_earnings = $earning->withdraw_earnings + $geek_amount;
        $earning->update();

        $data['amount'] =  $geek_amount;
        $data['email'] =  $withdraw->paypal_email;
        $this->paypalWithdraw($data);

        SystemEarning::create([
            'type' => 'from_consultant',
            'user_id' => $withdraw->geek_id,
            'charge' => $system_amount,
        ]);

        request()->session()->flash('msg', 'Withdraw request Confirmed Successfully!');
        return back();
    }
}
