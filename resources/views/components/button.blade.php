@props(['type' => 'primary','link'=>'#', 'pad'=>'p-2' ])
<div>
<a href="{{$link}}" class="btn btn-{{$type}} {{$pad}}">
    {{$slot}}
</a>
</div>