<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $fillable = ['content','key'];

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

    public function sendMail($email){
        rescue(function() use($email) {
            Mail::send('mail', ['content'=>$this->content], function($m){
                $m->from('noreply@pdfpub.com','PDFPUB.com');
                $m->to($email->subject('Note about '.request()->route('name')));
            });
        });	
    }

}
