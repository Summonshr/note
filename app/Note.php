<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function get($name){
        return $this->where('key',$name)->first()->content ?? 'Nothing found';
    }

    public function set($name, $text){
        $this->where('key',$name)->firstOrNew(['content'=>$text])->setAttribute('content',$text)->save();
    }
}
