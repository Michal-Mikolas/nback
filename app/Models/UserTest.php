<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cards()
    {
        return $this->hasMany(UserTestCard::class);
    }

    public function refreshStats()
    {
        $stats = [
            'total_symbols' => 0,
            'total_same' => 0,
            'clicked_same' => 0,
            'passed_same' => 0,
            'total_ordinary' => 0,
            'clicked_ordinary' => 0,
            'passed_ordinary' => 0,
            'total_points' => 0,
        ];

        $cards = $this->cards->where('type', 'symbol');
        foreach ($cards as $card) {
            $stats['total_symbols']++;

            // Same
            if ($card->same) {
                $stats['total_same']++;
                if ($card->clicked) {
                    $stats['clicked_same']++;
                } else {
                    $stats['passed_same']++;
                }

            // Ordinary
            } else {
                $stats['total_ordinary']++;
                if ($card->clicked) {
                    $stats['clicked_ordinary']++;
                } else {
                    $stats['passed_ordinary']++;
                }
            }
        }
        $stats['total_points'] = $stats['clicked_same'] + $stats['passed_ordinary'];

        $this->fill($stats);
        $this->save($stats);
    }
}
