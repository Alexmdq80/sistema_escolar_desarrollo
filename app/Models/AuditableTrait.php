<?php

namespace App\Models; // <--- This MUST match the path you're using

use Illuminate\Support\Facades\Auth; // Example: if you use Auth in your trait

trait AuditableTrait
{
    // Your trait logic here
    // For example, setting created_by and updated_by fields

    // Example of a common use case for AuditableTrait
    protected static function bootAuditableTrait()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    // You might also add relationships here if your audit fields
    // reference users directly, e.g.,
    public function creator()
    {
         return $this->belongsTo(Usuario::class, 'created_by');
    }

    public function updater()
    {
         return $this->belongsTo(Usuario::class, 'updated_by');
    }
}
