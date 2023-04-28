<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $user_id
 * @property bool|null $result
 * @property bool|null $prediction
 * @property string $filename
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Mammogram extends Model
{
    use HasFactory;

    public function getUser()
    {
        return $this->belongsTo(User::class);
    }

    public function uploadFile()
    {

    }

    public static function create($filename): Mammogram
    {
        $image = new self();
        $image->user_id = Auth::user()->id;
        $image->filename = $filename;

        $image->save();

        return $image;
    }
}
