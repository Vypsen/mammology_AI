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

    public static function create($filename): Mammogram
    {
        $image = new self();
        $image->user_id = Auth::user()->id;

        $id_img = 1;
        if (Mammogram::query()->exists())
            $id_img = Mammogram::query()->latest()->first()->id + 1;

        $image->filename = $id_img . '_' . $filename;

        $image->save();

        return $image;
    }

    public function enterPredict($predict)
    {
        $this->prediction = $predict;
        $this->save();
    }
}
