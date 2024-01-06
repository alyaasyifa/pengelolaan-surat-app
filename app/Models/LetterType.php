<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_code',
        'nama_type'
    ];

    
    public function user()
    {
        return $this->hasMany(User::class);
    }
    
    // public function letter()
    // {
    //     return $this->belongsTo(LetterType::class);
    // }

    //memunculkan kode surat ke letter_type_id 
    public function letter() {
        return $this->hasMany(Letter::class, 'letter_type_id', 'id');
    }
}
