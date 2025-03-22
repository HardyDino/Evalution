@extends('layouts.app')

@section('content')
    <h1>Détails {{ ucfirst($type) }}</h1>
    <p>ID: {{ $data[$type . '_id'] }}</p>
    <p>Montant actuel: {{ $type === 'ticket' ? 'N/A' : $data['amount'] ?? 'N/A' }}</p>

    <form method="POST" action="{{ route('depenses.update', [$type, $data[$type . '_id']]) }}">
        @csrf
        @method('PATCH')
        <input type="number" name="montant" value="{{ $type === 'ticket' ? 0 : ($data['amount'] ?? 0) }}" step="0.01">
        <button type="submit">Modifier Montant</button>
    </form>

    <form method="POST" action="{{ route('depenses.destroy', [$type, $data[$type . '_id']]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Supprimer</button>
    </form>
@endsection
