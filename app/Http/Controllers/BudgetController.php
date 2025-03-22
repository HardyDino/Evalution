<?php

namespace App\Http\Controllers;

use App\Models\Budget;  // Add this line
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::with('depenses')->get();
        return view('budgets.index', compact('budgets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'montant' => 'required|numeric|min:0',
            'taux_alerte' => 'required|integer|min:0|max:100',
        ]);

        Budget::create($request->all());
        return redirect()->route('budgets.index')->with('success', 'Budget ajouté.');
    }

    public function update(Request $request, Budget $budget)
    {
        $request->validate(['taux_alerte' => 'required|integer|min:0|max:100']);
        $budget->update(['taux_alerte' => $request->taux_alerte]);
        return redirect()->back()->with('success', 'Taux d’alerte mis à jour.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
