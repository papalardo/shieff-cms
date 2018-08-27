<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{

	/**
	 *  Name of table
	 */
	protected $table = 'user_social';

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider', 'provider_id',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
