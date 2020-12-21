<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    protected $table = 'items';

    public function substrwords($text, $chars, $end = '...')
    {
        if (strlen($text) > $chars) {
            $text = $text . ' ';
            $text = substr($text, 0, $chars);
            $text = substr($text, 0, strrpos($text, ' '));
            $text = $text . '...';
        }

        return $text;
    }

    public function getShortDescriptionAttribute()
    {
        return $this->substrwords($this->description, 40);
    }

}
