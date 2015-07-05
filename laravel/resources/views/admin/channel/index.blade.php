@extends('admin.partials.master')
@section('content')
<a href="{{route('channelNew')}}">new</a>
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Channel Name</th>
              <th>Broadcaster</th>
              <th colspan="2">Sources</th>
              <th>Country</th>
              <th>Language</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody>
          @foreach($channels as $channel)
            <tr class="channelrow">
              <td>
              <span class="logo">
                @if($channel->logo)
                   <img style="width: 80px" src="{{asset($cbs_options['channelLogoPath'].$channel->logo)}}">
                @endif  
              </span>
              <span class="name">
                {{$channel->name}}
                </span>
              </td>
              <td class="broadcaster">
                {{$channel->broadcaster->display_name}}
              </td>
              <td class="sourceslist">
                  <button type="button"  class="btn btn-default btn-xs" title="{{$channel->local_source}}">local</button>
                  <button type="button"  class="btn btn-default btn-xs" title="{{$channel->cdn_source}}">cdn</button>
              </td>
              <td>
                <a href="javascript:void(0)" data-target="#manageSources"><i class="fa fa-pencil-square-o"></i></a>
              </td>
              <td class="country">{{$countries[$channel->country_id]}}</td>
              <td class="language">{{$channel->language}}</td>
              <td class="">
                <a href="{{route('channelShow',$channel->id)}}" class="b-view" title="view">view</a>
                <a href="{{route('channelEdit',$channel->id)}}" class="b-edit" title="edit">edit</i></a>
                <a href="#" class="b-remove" title="remove">delete</a>
                <a href="{{route('channelEpgManage',$channel->id)}}">epg</a>
                <a href="{{route('channelConfig',$channel->id)}}">config</a>

                </td>
                <td>
                <a href="javascript:void(0)" class="b-toggle-active" title="toggle active">
                  @if($channel->active)
                    <i class="fa fa-dot-circle-o"></i>
                  @else
                    <i class="fa fa-circle-o"></i>
                  @endif
                </a>
                <a href="javascript:void(0)" class="b-toggle-approve" title="toggle approve">
                  @if($channel->approved)
                    <i class="fa fa-check-square-o"></i>
                  @else
                    <i class="fa fa-square-o"></i>
                  @endif
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
</table>
@stop
@section('foot')
<script type="text/javascript">
    $('.b-remove').click(function(e){
      openchanneldeletemodal(e,$(this));
    })
</script>
@stop
