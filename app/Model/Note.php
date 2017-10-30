<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Note   extends Eloquent
{
    protected  $table = 'note';

    public function noteType(){
        return $this->belongsTo('App\Model\NoteType','notesTypeId');
    }
    public function noteStatus(){
        return $this->belongsTo('App\Model\NoteStatus','notesStatusId');
    }
    public function noteCommType(){
        return $this->belongsTo('App\Model\NoteCommType','notesCommTypeId');
    }
    public function noteAssign(){
        return $this->belongsTo('App\Model\NoteAssign','notesAssignId');
    }
    public function noteTypeDetail(){
        return $this->belongsTo('App\Model\NoteTypeDetails','noteTypeDetailId');
    }
    public function people(){
        return $this->belongsTo('App\Model\People','peopleId');
    }
}
