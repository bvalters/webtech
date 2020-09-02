<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id', 'size', 'real_name', 'local_name'
    ];

    public function user() {
        return $this->hasOne("App\User");
    }

    public function formattedSize() {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($this->size, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
