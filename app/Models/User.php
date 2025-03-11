<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id';
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Récupère le service auquel l'utilisateur appartient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Récupère la fonction de l'utilisateur.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'fonction_id');
    }

    /**
     * Récupère le service géré par l'utilisateur (s'il est chef de service).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function servicesGeres()
    {
        return $this->hasOne(Service::class, 'chef_de_service_id');
    }

    /**
     * Valide les données avant de créer ou de mettre à jour un utilisateur.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    public static function validateUserData(array $data)
    {
        $rules = [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'in:homme,femme'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => isset($data['id']) ? ['nullable', 'confirmed', Rules\Password::defaults()] : ['required', 'confirmed', Rules\Password::defaults()],
            'date_embauche' => ['required', 'date'],
            'salaire' => ['required', 'integer'],
            'solde_conges' => ['required', 'integer'],
            'fonction_id' => ['nullable', 'exists:fonctions,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'type' => ['required', 'string', 'in:employe,chef de service,grh'],
        ];

        return Validator::make($data, $rules);
    }


    public static function validateProfileData(array $data)
    {
        $rules = [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'date'],
            'lieu_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'in:homme,femme'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'date_embauche' => ['required', 'date'],
            'salaire' => ['required', 'integer'],
            'solde_conges' => ['required', 'integer'],
            'fonction_id' => ['nullable', 'exists:fonctions,id'],
            'service_id' => ['nullable', 'exists:services,id'],
            'type' => ['required', 'string', 'in:employe,chef de service,grh'],
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Crée un nouvel utilisateur avec validation des données.
     *
     * @param array $data
     * @return User|null
     */
    public static function createUser(array $data)
    {
        $validator = self::validateUserData($data);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }
        $user = User::create($data);
        event(new Registered($user));

        return $user;
    }

    /**
     * Met à jour l'utilisateur avec validation des données.
     *
     * @param array $data
     * @return bool
     */
    public function updateUser(array $data)
    {
        $validator = self::validateProfileData(array_merge($data, ['id' => $this->id],['password' => $this->password]));

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->update($data);
    }

    /**
     * Assigne le service à l'utilisateur avec vérification.
     *
     * @param int|null $serviceId
     * @return bool
     */
    public function setServiceId(?int $serviceId): bool
    {
        if ($serviceId !== null && !Service::where('id', $serviceId)->exists()) {
            throw new \InvalidArgumentException("Le service avec l'ID $serviceId n'existe pas.");
        }

        $this->service_id = $serviceId;
        return $this->save();
    }

    /**
     * Assigne la fonction à l'utilisateur avec vérification.
     *
     * @param int|null $fonctionId
     * @return bool
     */
    public function setFonctionId(?int $fonctionId): bool
    {
        if ($fonctionId !== null && !Fonction::where('id', $fonctionId)->exists()) {
            throw new \InvalidArgumentException("La fonction avec l'ID $fonctionId n'existe pas.");
        }

        $this->fonction_id = $fonctionId;
        return $this->save();
    }

    /**
     * Assignation automatique des rôles lors de la création ou de la mise à jour.
     */
    protected static function booted()
    {
        parent::booted();

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