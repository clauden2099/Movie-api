<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory, SoftDeletes;

    // campos que se pueden asignar de forma masiva
    protected $fillable = [
        'name', 'slug', 'description', 'is_active'
    ];

    // transformación a tipos de datos
    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * El método boot es un método magico de Eloquent que se
     * ejecuta cuando el modelo se inicializa.
     * Aquí definimos listeners para eventos del ciclo de vida
     * del modelo.
     */
    protected static function boot(): void
    {
        parent::boot();

        // se ejecuta antes de crear el modelo,
        // nos ayuda a generar slug y description automáticos
        static::creating(function (Genre $genre): void {
            if (empty($genre->slug)) {
                $genre->slug = Str::slug($genre->name);
            }
            if (empty($genre->description)) {
                $genre->description = Str::limit($genre->name, 100);
            }
        });

        // se ejecuta antes de actualizar el modelo
        static::updating(function (Genre $genre): void {
            // si el campo name fue modificado, actualizamos el slug
            if ($genre->isDirty('name')) {
                $genre->slug = Str::slug($genre->name);
            }
        });
    }
}
