@extends('admin.partials.master')
@section('content')
<a href="{{route('vodNew')}}">new</a>
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Channel</th>
              <th>Featured Playlist</th>
              <th>Broadcaster</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody>
          @foreach($vods as $vod)
          <?php $cod = unserialize($vod->cod); ?>
            <tr>
              <td>
                {{$cod['channel_id']}}
              </td>
              <td class="broadcaster">
                {{$cod['feat_playlist']}}
              </td>
              <td>
                {{$vod->broadcaster->display_name}}
              </td>
<td>
                  <a href="{{route('vodEdit',$vod->id)}}" class="b-edit" title="edit">edit</i></a>
           <a href="#" data-href="{{route('vodDelete',$vod->id)}}" data-delete="{{csrf_token()}}" data-singleton="true" class="b-remove" title="remove">delete</a>
</td>
            </tr>
            @endforeach
          </tbody>
</table>
@stop
@section('foot')
  @include('partials/confirmdelete')
@stop
