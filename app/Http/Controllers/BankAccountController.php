<?php

namespace App\Http\Controllers;

use Stripe\BankAccount;
use Illuminate\Http\Request;
class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('bankaccount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('bankaccount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $res = $request->validate([
            'country'=>'required|in:US',
            'currency'=>'required|in:usd',
            'account_holder_name'=>'required',
            'account_holder_type'=>'required',
            'routing_number'=>'required|confirmed|size:9',
            'account_number'=>'required|confirmed|size:12'
        ]);
        $stripe = new \Stripe\StripeClient(config('stripe.secret'));

        $token = $stripe->tokens->create([
           'bank_account' => [
               'country' => 'US',
               'currency' => 'usd',
               'account_holder_name' => $res['account_holder_name'],
               'account_holder_type' => $res['account_holder_type'],
               'routing_number' => $res['routing_number'],
               'account_number' => $res['account_number'],
           ],
        ]);

        try {
            $stripe->customers->createSource(auth()->user()->createOrGetStripeCustomer()->id, ['source' => $token->id]);
        }
        catch (\Exception $exception)
        {
            return redirect(route('bankaccount.list'))->with(['error'=>'Failed to link bank account, you may have already linked your account.']);
        }
        return redirect(route('bankaccount.list'))->with(['success'=>'Bank Account Linked']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Stripe\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        // TODO Show BankAccount
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Stripe\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        // TODO Edit BankAccount
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Stripe\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        // TODO Delete BankAccount
    }
}
