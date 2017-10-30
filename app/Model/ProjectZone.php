<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProjectZone   extends Eloquent
{
    protected  $table = 'projectzone';
    public function Project(){
        return $this->belongsTo('App\Model\Project','projectId');
    }
    public  function ProjectType(){
        return $this->belongsTo('App\Model\ProjectType', 'projectZoneTypeId');
    }
    public  function Square(){
        return $this->belongsTo('App\Model\Unit', 'AreaUnitId');
    }

}
