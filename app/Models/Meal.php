<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['status'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class);
    }

    public function getStatusBasedOnDiffTime($diff_time)
    {
        $time = Carbon::createFromTimestamp($diff_time);
        if($this->updated_at > $diff_time && $this->updated_at > $this->created_at && $this->deleted_at==null) {
            return 'modified';
        }elseif($this->deleted_at > $diff_time) {
            return 'deleted';
        }else{
            return 'created';
        }
    }
}
