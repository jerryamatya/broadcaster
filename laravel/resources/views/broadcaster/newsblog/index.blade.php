@extends('broadcaster.partials.master')
@section('content')
<a href="{{route('newsNew')}}">new</a>
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Title</th>
              <th>Slug</th>
              <th>Body</th>
              <th>Status</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody>
          @foreach($articles as $article)
            <tr>
              <td>
                {{$article->title}}
              </td>
              <td>
                {{$article->slug}}
              </td>              
              <td class="broadcaster">
                {{substr($article->body,0,40)}}....
              </td>
              <td class="sourceslist">
                @if($article->active)
                  active
                @else
                  unactive
                @endif
              </td>
  
              <td class="">
                <a href="{{route('newsShow',$article->id)}}" class="b-view" title="view">view</a>
                <a href="{{route('newsEdit',$article->id)}}" class="b-edit" title="edit">edit</i></a>
                <a href="#" data-href="{{route('newsDelete',$article->id)}}" data-delete="{{csrf_token()}}" data-singleton="true" class="b-remove" title="remove">delete</a>
                </td>
            </tr>
            @endforeach
          </tbody>
</table>
{!! $articles->render() !!}
@stop
@section('foot')
  @include('partials/confirmdelete')
@stop
