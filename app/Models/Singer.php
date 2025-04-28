<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Singer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'genre',
        'birth_date',
        'bio',
        'label',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Get the age of the singer.
     *
     * @return int|null
     */
    public function getAgeAttribute(): ?int
    {
        return $this->birth_date?->age;
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    /**
     * Get the formatted birth date.
     *
     * @return string|null
     */
    public function getFormattedBirthDateAttribute(): ?string
    {
        return $this->birth_date?->format('d/m/Y');
    }
}