<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Services\ApiService;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'budget_id' => 'required|exists:budgets,id',
            'montant' => 'required|numeric|min:0',
            'ticket_id' => 'nullable|integer',
            'lead_id' => 'nullable|integer',
        ]);

        Depense::create($request->all());
        return redirect()->back()->with('success', 'Dépense ajoutée.');
    }

    public function update(Request $request, $type, $id)
    {
        $request->validate(['montant' => 'required|numeric|min:0']);
        $this->apiService->updateItem($type, $id, ['montant' => $request->montant]);
        return redirect()->back()->with('success', ucfirst($type) . ' mis à jour.');
    }

    public function destroy($type, $id)
    {
        $this->apiService->deleteItem($type, $id);
        return redirect()->back()->with('success', ucfirst($type) . ' supprimé.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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




}
