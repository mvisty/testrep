<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package App\Models
 */
class Ticket extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'deadline_at', 'finished_at', 'finished'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deadline_at', 'finished_at'
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'user_id' => 1
    ];
    //TODO now only for one user

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
