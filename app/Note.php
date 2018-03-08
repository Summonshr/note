<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $fillable = ['content'];
    public function get($name){
        return $this->where('key',$name)->first()->content ?? '<p>Let\'s start writing.</p>';
    }

    public function set($name, $text){

        $note = Note::where('key',$name)->first();
        
        if(!$note){
            $note = new Note;
                $note->key = $name;
        }
        
        $note->content = $text;
        $note->save();
    }
    public function appends($name, $text){

        $note = Note::where('key',$name)->first();
        
        if(!$note){
            $note = new Note;
            $note->key = $name;
            $note->content = '';
        }
        
        $note->content .= $text;
        $note->save();
    }

    public function protect($name, $email, $password){
 
        $note = Note::where('key',$name)->first();
        $note->email = $email;
        $note->password = bcrypt($password);
        $note->save();
        
    }

}
