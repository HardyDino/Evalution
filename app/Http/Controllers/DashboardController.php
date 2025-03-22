<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Models\Budget;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $customers = $this->apiService->getCustomers();
        $tickets = $this->apiService->getTickets();
        $leads = $this->apiService->getLeads();
        $budgets = Budget::with('depenses')->get();

        $totalCustomers = count($customers);
        $totalTickets = count($tickets);
        $totalLeads = count($leads);
        $totalDepenses = $budgets->sum->totalDepenses();

        return view('dashboard', compact('customers', 'tickets', 'leads', 'budgets', 'totalCustomers', 'totalTickets', 'totalLeads', 'totalDepenses'));
    }

    public function details($type, $id)
    {
        $data = match ($type) {
            'ticket' => $this->apiService->getTicket($id),
            'lead' => $this->apiService->getLead($id),
            default => abort(404),
        };

        return view('details', compact('type', 'data'));
    }
}
