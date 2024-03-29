<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class FileEntry extends Model {
	use SoftDeletes;

	protected $table = 'fileentries';
	protected $dates = [ 'deleted_at' ];
	protected $fillable = [ 'filename', 'mime', 'original_filename', 'custom_name', 'user_id' ];

	public function user() {
		return $this->belongsTo( 'user' );
	}

	public function scopeUsableImages( $query, $user_id ) {
		return $query->whereIn( 'user_id', [ 1, $user_id ] );
	}
}
