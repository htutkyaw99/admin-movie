<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;

    use SoftDeletes;

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function director()
    {
        return $this->belongsTo(Director::class);
    }

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // public function admins()
    // {
    //     return $this->belongsToMany(Admin::class);
    // }
}
