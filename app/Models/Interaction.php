<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Interaction extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'investor_id',
        'user_id',
        'type',
        'date_interaction',
        'description',
        'piece_jointe',
        'metadata'
    ];

    protected function casts(): array
    {
        return [
            'date_interaction' => 'date',
            'metadata' => 'array',
        ];
    }

    // Configuration du log d'activité
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relations
    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accesseurs
    public function getDateInteractionFormateeAttribute()
    {
        return $this->date_interaction->format('d/m/Y');
    }

    public function getDescriptionCourteAttribute()
    {
        return strlen($this->description) > 100
            ? substr($this->description, 0, 100) . '...'
            : $this->description;
    }

    // Scopes
    public function scopeParType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeRecentes($query, $jours = 30)
    {
        return $query->where('date_interaction', '>=', now()->subDays($jours));
    }
}
