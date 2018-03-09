<?php
namespace App;
class Map
{
    public $attributes = [
        'center'=>[],
        'markers'=>[],
        'zoom'=>4
    ];

    public function __construct($lat, $lng)
    {
        $this->attributes['center']['lat'] = $lat;
        $this->attributes['center']['lng'] = $lng;
    }

    public function __toString(){
        return $this->render();
    }

    public function pushAttributes($attribute, $value){
        $this->attributes[$attribute][] = $value;
        return $this; 
    }

    public function mergeAttributes($attribute, $value){

        $this->attributes[$attribute] = array_merge($this->attributes[$attribute], $value);
        return $this;
    }

    public function getAttributes(){
        return $this->attributes;
    }

    public function zoom($level = 4){
        $this->attributes['zoom'] = $level;
        return $this;
    }

    public function render(){
        return '<div class="map" style="width: 80%; height: 300px; background-color: grey;" data-attributes=\''.json_encode($this->getAttributes()).'\'></div>';
    }


    // Markers
    public function addMarker($lat, $lng, $content = null){
        $this->pushAttributes('markers',['lat'=>$lat,'lng'=>$lng,'content'=>$content ?:['html'=>'marker content missing','title'=>'title missing']]);
        return $this;
    }

    public function addMarkers(array $markers){
        $this->mergeAttributes('markers', array_map(function($val){
            return array_combine(array_slice(['lat','lng','content'],0,count($val)),$val);
        },$markers));
        return $this;
    }
    // Clusters
    public function addCluster($key, $markers){
        $this->attributes['clusters'][$key][] = $markers;
        return $this;
    }

    public function addClusters(array $clusters){
        foreach($clusters as $key => $cluster){
            $this->attributes['clusters'][$cluster['key'] ?? $key][] = $markers;
        }
        return $this;
    }
    //
}
