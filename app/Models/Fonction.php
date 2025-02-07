<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class Fonction extends Model
{
    use HasFactory;
    protected $table = 'fonctions';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'description'];

    public function utilisateurs()
    {
        return $this->hasMany(User::class, 'fonction_id');
    }

    /**
     * Valide les données avant de créer une nouvelle fonction.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    public static function validateFonctionData(array $data)
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Crée une nouvelle fonction avec validation des données.
     *
     * @param array $data
     * @return Fonction|null
     */
    public static function createFonction(array $data)
    {
        $validator = self::validateFonctionData($data);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return self::create($data);
    }

    /**
     * Met à jour la fonction avec validation des données.
     *
     * @param array $data
     * @return bool
     */
    public function updateFonction(array $data)
    {
        $validator = self::validateFonctionData($data);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->update($data);
    }
}