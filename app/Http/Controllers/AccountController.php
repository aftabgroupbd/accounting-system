<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data['accounts']        = Account::orderBy('id', 'asc')->paginate(10);
            $data['title']           = 'Account List';

            return view('accounts.index', $data);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', "Something wrong!");
        }
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $page           = $request->get('show') ? $request->get('show') : 10;
            $account_name   = $request->get('account_name');

            $query   = Account::query();

            if ($account_name) {
                $query->where('name', 'like', '%' . $account_name . '%');
            }
            $data['accounts']  =  $query->orderBy('id', 'asc')->paginate($page);

            $html =  view('accounts.table',$data)->render();
            return response()->json(array('error' => false, 'message' => 'Success', 'html' => $html));
        }
    }
    public function searchAccount(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $entities = Account::orderby('id', 'desc')->select('id', 'name')->limit(10)->get();
        } else {
            $entities = Account::orderby('id', 'desc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(10)->get();
        }
        return response()->json($entities);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            return view('accounts.create', ['title' => 'Add New Transaction']);
        } catch (\Exception $e) {
            return redirect()->route('dashboard')->with('error', "Something wrong!");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_name'      => 'required|numeric|exists:accounts,id',
            'amount'            => 'required|numeric|gt:0',
            'type'              => 'required|string',
            'date'              => 'required|date',
        ]);

        if ($validator->passes()) {
            $account = Account::find($request->account_name);
            $account->balance = $account->balance + $request->amount;
            $account->update();

            $transaction = new Transaction();
            $transaction->account_id    = $request->account_name;
            $transaction->amount        = $request->amount;
            $transaction->type          = $request->type;
            $transaction->date          = date('Y-m-d',strtotime($request->date));
            $transaction->save();

            return response()->json(array('error' => false, 'check' => false, 'message' => 'Successfully Saved!'));
        } else {
            return response()->json(array('error' => true, 'check' => true, 'message' => $validator->errors()->getMessages()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
