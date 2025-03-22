@extends('layouts.app')

@section('content')
    <h1>Gestion des Budgets</h1>

    @foreach ($budgets as $budget)
        <div class="card mb-3">
            <div class="card-body">
                <h5>Client ID: {{ $budget->customer_id }}</h5>
                <p>Montant: {{ $budget->montant }} € | Dépenses: {{ $budget->totalDepenses() }} €</p>
                @if ($budget->isOverBudget())
                    <p class="text-danger">Dépassement de budget !</p>
                @elseif ($budget->isAlertReached())
                    <p class="text-warning">Alerte: {{ $budget->taux_alerte }}% atteint</p>
                @endif

                <form method="POST" action="{{ route('budgets.update', $budget) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="number" name="taux_alerte" value="{{ $budget->taux_alerte }}" min="0" max="100">
                    <button type="submit">Mettre à jour taux</button>
                </form>
            </div>
        </div>
    @endforeach

    <form method="POST" action="{{ route('budgets.store') }}">
        @csrf
        <input type="number" name="customer_id" placeholder="ID Client" required>
        <input type="number" name="montant" placeholder="Montant" step="0.01" required>
        <input type="number" name="taux_alerte" placeholder="Taux Alerte (%)" min="0" max="100" required>
        <button type="submit">Ajouter Budget</button>
    </form>
@endsection
