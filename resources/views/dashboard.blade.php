@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>

    <!-- Totaux cliquables -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Clients: {{ $totalCustomers }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Tickets: <a href="{{ route('details', ['type' => 'ticket', 'id' => $tickets[0]['ticket_id'] ?? 0]) }}">{{ $totalTickets }}</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Total Leads: <a href="{{ route('details', ['type' => 'lead', 'id' => $leads[0]['lead_id'] ?? 0]) }}">{{ $totalLeads }}</a></h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mt-4">
        <div class="col-md-4">
            <canvas id="customersChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="ticketsChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="depensesChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('customersChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_column($customers, 'name')) !!},
                datasets: [{ data: {!! json_encode(array_fill(0, count($customers), 1)) !!}, backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'] }]
            }
        });
        new Chart(document.getElementById('ticketsChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($tickets, 'subject')) !!},
                datasets: [{ label: 'Tickets', data: {!! json_encode(array_fill(0, count($tickets), 1)) !!}, backgroundColor: '#36A2EB' }]
            }
        });
        new Chart(document.getElementById('depensesChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($budgets->pluck('customer_id')) !!},
                datasets: [{ label: 'Dépenses', data: {!! json_encode($budgets->map->totalDepenses()) !!}, borderColor: '#FF6384' }]
            }
        });
    </script>
@endsection
