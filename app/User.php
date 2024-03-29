<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
	AuthorizableContract,
	CanResetPasswordContract {
	use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

	protected $dates = [ 'deleted_at' ];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'username', 'email', 'password', 'gender', 'contact_number', 'address' ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [ 'password', 'remember_token' ];

	public function tshirts() {
		return $this->hasMany( 'App\Tshirt' );
	}

	public function orders() {
		return $this->hasMany( 'App\Order' );
	}

	public function role() {
		return $this->belongsTo( 'App\Role' );
	}

	public function cart() {
		return $this->hasOne( 'App\Cart' );
	}

	public function cartItems() {
		return $this->hasManyThrough( 'App\CartItem', 'App\Cart' );
	}

	public function isAdmin() {
		return $this->role_id == 1;
	}

	public function scopeUsers( $query ) {
		return $query->where( 'role_id', 2 );
	}

	public function fileentries(){
		return $this->hasMany('App\FileEntry');
	}

}
