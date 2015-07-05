@extends('admin.partials.master')
@section('content')
<a href="{{route('newsappNew')}}">new</a>
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Name</th>
              <th>Broadcaster</th>
              <th>Sources</th>
              <th>Manage</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach($newsapps as $newsapp)
            <tr class="channelrow">
              <td>
       
                {{$newsapp->name}}
              </td>
              <td class="broadcaster">
                {{$newsapp->broadcaster->display_name}}
              </td>
              <td><a href="{{route('newsappManageSources',$newsapp->id)}}">
                @if(count($newsapp->sources))
                  manage
                @else
                  create
                @endif
              </a></td>
              <td class="">
                <a href="{{route('newsappEdit',$newsapp->id)}}" class="b-edit" title="edit">edit</i></a>
                <a href="{{route('newsappDelete',$newsapp->id)}}" class="b-remove deletenewsapp" title="remove">delete</a>
                </td>
                <td>
                  <a href="{{route('newsappChangeStatus',$newsapp->id)}}">
                    @if($newsapp->active)
                      {{"disable"}}
                    @else
                      {{"enable"}}
                    @endif
                  </a>
                </td>
            
            </tr>
            @endforeach
          </tbody>
</table>
@stop
@section('foot')
  <script type="text/javascript" src="{{asset('js/newsapp.js')}}"></script> 
@stop
