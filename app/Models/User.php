<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Service;
use App\Models\Fonction;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'telephone',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'email',
        'password',
        'date_embauche',
        'salaire',
        'solde_conges',
        'fonction_id',
        'service_id',
        'type'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'fonction_id');
    }

    public function servicesGeres()
    {
        return $this->hasOne(Service::class, 'chef_service_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Assignation automatique des rôles
    protected static function booted()
    {
        static::created(function ($user) {
            $user->assignRole($user->type);
        });

        static::updated(function ($user) {
            if ($user->isDirty('type')) {
                $user->roles()->detach();
                $user->assignRole($user->type);
            }
        });
    }
}
