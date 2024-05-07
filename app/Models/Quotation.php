<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'total_price',
        'taxable_price',
        'tax_price',
        'is_editable',
        'user_id',
    ];

    // Mutators per UUID, Taxable e Tax
    // Mutator per UUID
    public function getUuidAttribute($value)
    {
        return Str::uuid($value); // Converte l'UUID in un formato standard
    }

    // Mutatori per Taxable e Tax
    // Mutatore per il campo 'taxable_price'
    public function getTaxableAttribute()
    {
        return $this->taxable_price; // Ritorna il valore di 'taxable_price'
    }

    // Mutatore per il campo 'tax_price'
    public function getTaxAttribute()
    {
        return $this->tax_price; // Ritorna il valore di 'tax_price'
    }

    // Setter per il campo 'taxable_price'
    public function setTaxableAttribute($value)
    {
        $this->attributes['taxable_price'] = $value; // Imposta il valore di 'taxable_price'
    }

    // Setter per il campo 'tax_price'
    public function setTaxAttribute($value)
    {
        $this->attributes['tax_price'] = $value; // Imposta il valore di 'tax_price'
    }

    // Relazione con l'utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Metodo per verificare se la quotazione è modificabile
    public function isEditable()
    {
        return $this->is_editable; // Ritorna il valore di 'is_editable'
    }
}
