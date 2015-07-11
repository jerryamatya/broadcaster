@extends('broadcaster.partials.master')
@section('content')
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Channel</th>
              <th>Featured Playlist</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody>
          <?php $cod = unserialize($vod->cod); ?>
            <tr>
              <td>
                {{$cod['channel_id']}}
              </td>
              <td class="broadcaster">
                {{$cod['feat_playlist']}}
              </td>
<td>
                  <a href="{{route('bvodEdit',$vod->id)}}" class="b-edit" title="edit">edit</i></a>
</td>
            </tr>
          </tbody>
</table>
@stop
@section('foot')
  @include('partials/confirmdelete')
@stop
