<?php

namespace App\Http\Controllers;

use App\Models\Debtors;
use Illuminate\Http\Request;

class DebtorsController extends Controller
{
   
    public function index()
    {
        $debtors = Debtors::select('debtors.*','clients.name AS client_name')
        ->join('clients','debtors.client','=','clients.id','left')
        ->get();
        return view('debtors.index')->with('debtors', $debtors);
    }

    
    public function create()
    {
        return view('debtors.create');
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        Debtors::create($input);
        Return redirect('debtors')->with('flash_message', 'Debtor Addedd!');  

    }

    public function dropDownShow(Request $request)
{

   $clients = Clients::pluck('name', 'id');
   $selectedID = 2;
   return view('clients.edit', compact('id', 'name'));

}

public function getDetail($id)
{
    return view('user.debtors.index')->with('debtors',Debtors::where('id',$id)->first());

}
    
    public function show($id)
    {
        $debtors = Debtors::find($id);
        return view('debtors.show')->with('debtor',$debtors);
    }

   
    public function edit($id)
    {
        $debtors = Debtors::find($id);
        return view('debtors.edit')->with('debtors',$debtors);
    }

    
    public function update(Request $request, debtors $debtors)
    {
        $debtors = Debtors::find($id);
        $input = $request->all();
        $debtors->update($input);
        Return redirect('debtors')->with('flash_message', 'debtors Updated!'); 
    }

    public function destroy($id)
    {
        Debtors::destroy($id);
        Return redirect('debtors')->with('flash_message', 'debtor Deleted!');
    }
}
