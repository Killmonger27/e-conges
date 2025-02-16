<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Demande extends Model
{
    use HasFactory;

    const STATUS_ENCOURS = 'encours';
    const STATUS_ACCORDE = 'accorde';
    const STATUS_REJETE = 'rejete';

    const ACTION_PLANIFIER = 'planifier';
    const ACTION_ENVOYER = 'envoyer';

    protected $perPage = 20;

    protected $fillable = [
        'date_de_demande',
        'type_de_demande',
        'motif',
        'date_de_debut',
        'date_de_fin',
        'status',
        'action',
        'employe_id',
        'service_id'
    ];

    public function employe()
    {
        return $this->belongsTo(User::class, 'employe_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function getDureeAttribute()
    {
        $startDate = Carbon::parse($this->date_de_debut);
        $endDate = Carbon::parse($this->date_de_fin);
        return $startDate->diffInDays($endDate) + 1;
    }

    public function isAccordee()
    {
        return $this->status === self::STATUS_ACCORDE;
    }

    public function isRejetee()
    {
        return $this->status === self::STATUS_REJETE;
    }

    public function isEnCours()
    {
        return $this->status === self::STATUS_ENCOURS;
    }

    // Méthode pour vérifier si la demande est au brouillon
    public function isBrouillon()
    {
        return $this->action === self::ACTION_PLANIFIER;
    }

    public function scopeEnCours($query)
    {
        return $query->where('status', self::STATUS_ENCOURS);
    }
}
