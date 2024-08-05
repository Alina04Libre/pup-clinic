<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingPrefix;

class Faq extends Model
{
    use HasFactory;
    use Searchable;



    protected $fillable = [
        'question',
        'answer',
        'popularity',
    ];

    #[SearchUsingPrefix(['status'])]

    public function toSearchableArray()
    {
        return [
            'question' => $this->question,
            'answer' => $this->answer,
            'popularity' => $this->popularity,
        ];
    }




}
