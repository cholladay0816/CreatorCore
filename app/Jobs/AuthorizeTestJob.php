<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;

class AuthorizeTestJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
//        $merchantAuthentication->setName(env('AUTHORIZE_NET_LOGIN'));
//        $merchantAuthentication->setTransactionKey(env('AUTHORIZE_NET_TRANSACTION_KEY'));
//
//        $request = new AnetAPI\CreateTransactionRequest();
//        $request->setMerchantAuthentication($merchantAuthentication);
//
//        // Set the transaction's refId
//        $refId = 'ref' . time();
//
//        //Generate random bank account number
//        $randomAccountNumber= rand(100000000, 9999999999);
//
//        // Create the payment data for a Bank Account
//        $bankAccount = new AnetAPI\BankAccountType();
//        $bankAccount->setAccountType('checking');
//        // see eCheck documentation for proper echeck type to use for each situation
//        $bankAccount->setEcheckType('WEB');
//        $bankAccount->setRoutingNumber('122000661');
//
//        $bankAccount->setAccountNumber(rand(10000, 999999999999));
//
//        $bankAccount->setNameOnAccount('John Doe');
//        $bankAccount->setBankName('Wells Fargo Bank NA');
//
//        $paymentBank= new AnetAPI\PaymentType();
//        $paymentBank->setBankAccount($bankAccount);
//
//        // Order info
//        $order = new AnetAPI\OrderType();
//        $order->setInvoiceNumber("101");
//        $order->setDescription("Golf Shirts");
//
//        //create a bank debit transaction
//
//        $transactionRequestType = new AnetAPI\TransactionRequestType();
//        $transactionRequestType->setTransactionType("authCaptureTransaction");
//        $transactionRequestType->setAmount(123);
//        $transactionRequestType->setPayment($paymentBank);
//        $transactionRequestType->setOrder($order);
//        $request = new AnetAPI\CreateTransactionRequest();
//        $request->setMerchantAuthentication($merchantAuthentication);
//        $request->setRefId($refId);
//        $request->setTransactionRequest($transactionRequestType);
//        $controller = new AnetController\CreateTransactionController($request);
//        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
//
//        dd($response);
    }
}
