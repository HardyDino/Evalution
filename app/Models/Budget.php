<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['customer_id', 'montant', 'taux_alerte'];

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function totalDepenses()
    {
        return $this->depenses->sum('montant');
    }

    public function isAlertReached()
    {
        return $this->totalDepenses() >= ($this->montant * $this->taux_alerte / 100);
    }

    public function isOverBudget()
    {
        return $this->totalDepenses() > $this->montant;
    }
}