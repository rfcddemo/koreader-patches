<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Investor extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom_complet',
        'categorie',
        'pays',
        'email',
        'telephone',
        'organisation',
        'fonction',
        'langue_preferee',
        'remarques',
        'derniere_interaction'
    ];

    protected function casts(): array
    {
        return [
            'derniere_interaction' => 'datetime',
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
    public function interactions()
    {
        return $this->hasMany(Interaction::class)->orderBy('date_interaction', 'desc');
    }

    public function emailAddress()
    {
        return $this->hasOne(InvestorEmailAddress::class);
    }

    // Accesseurs
    public function getInteractionsCountAttribute()
    {
        return $this->interactions()->count();
    }

    public function getDerniereInteractionFormateeAttribute()
    {
        return $this->derniere_interaction?->format('d/m/Y');
    }

    // Scopes pour les filtres
    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    public function scopeParPays($query, $pays)
    {
        return $query->where('pays', $pays);
    }

    public function scopeParLangue($query, $langue)
    {
        return $query->where('langue_preferee', $langue);
    }

    public function scopeRecherche($query, $terme)
    {
        return $query->where(function($q) use ($terme) {
            $q->where('nom_complet', 'like', "%{$terme}%")
                ->orWhere('email', 'like', "%{$terme}%")
                ->orWhere('organisation', 'like', "%{$terme}%")
                ->orWhere('fonction', 'like', "%{$terme}%")
                ->orWhere('remarques', 'like', "%{$terme}%");
        });
    }
}
