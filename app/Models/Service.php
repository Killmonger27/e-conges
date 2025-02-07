<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'description', 'chef_service_id'];

    /**
     * Récupère les utilisateurs appartenant à ce service.
     *
     * @return HasMany
     */
    public function utilisateurs(): HasMany
    {
        return $this->hasMany(User::class, 'service_id');
    }

    /**
     * Récupère le chef de service associé à ce service.
     *
     * @return BelongsTo
     */
    public function chefService(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_service_id');
    }

    /**
     * Valide les données avant de créer un nouveau service.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    public static function validateServiceData(array $data)
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'chef_service_id' => 'nullable|exists:users,id',
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Crée un nouveau service avec validation des données.
     *
     * @param array $data
     * @return Service|null
     */
    public static function createService(array $data)
    {
        $validator = self::validateServiceData($data);

        if ($validator->fails()) {
            // Vous pouvez gérer les erreurs de validation selon vos besoins
            // Par exemple, vous pouvez lever une exception personnalisée
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return self::create($data);
    }

    /**
     * Met à jour le service avec validation des données.
     *
     * @param array $data
     * @return bool
     */
    public function updateService(array $data)
    {
        $validator = self::validateServiceData($data);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->update($data);
    }

    /**
     * Vérifie si le chef de service est valide avant de l'associer au service.
     *
     * @param int|null $chefServiceId
     * @return bool
     */
    public function setChefServiceId(?int $chefServiceId): bool
    {
        if ($chefServiceId !== null && !User::where('id', $chefServiceId)->exists()) {
            throw new \InvalidArgumentException("Le chef de service avec l'ID $chefServiceId n'existe pas.");
        }

        $this->chef_service_id = $chefServiceId;
        return $this->save();
    }
}