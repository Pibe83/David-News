<?php

namespace App\Traits;

trait EditableTrait
{
    // Metodo per verificare se l'elemento è modificabile
    public function isEditable()
    {
        return $this->is_editable;
    }

    // Metodo per rendere l'elemento modificabile
    public function makeEditable()
    {
        $this->is_editable = true;
        $this->save();
    }

    // Metodo per rendere l'elemento non modificabile
    public function makeNotEditable()
    {
        $this->is_editable = false;
        $this->save();
    }
}
