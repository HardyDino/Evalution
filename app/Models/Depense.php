<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    protected $fillable = ['budget_id', 'montant', 'ticket_id', 'lead_id'];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }
}
