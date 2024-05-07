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
    ];

    // Genera UUID automaticamente prima di salvare il record nel database
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($quotation) {
            $quotation->uuid = Str::uuid();
        });
    }

    // Mutators per UUID, Taxable e Tax
    public function getUuidAttribute($value)
    {
        return Str::uuid();
    }

    public function getTaxableAttribute()
    {
        return $this->taxable_price;
    }

    public function getTaxAttribute()
    {
        return $this->tax_price;
    }

    public function setTaxableAttribute($value)
    {
        $this->attributes['taxable_price'] = $value;
    }

    public function setTaxAttribute($value)
    {
        $this->attributes['tax_price'] = $value;
    }

    // Relazione con l'utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Metodo per verificare se la quotazione è modificabile
    public function isEditable()
    {
        return $this->is_editable;
    }
}
