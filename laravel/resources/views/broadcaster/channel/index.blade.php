@extends('broadcaster.partials.master')
@section('content')
<!--<a href="{{route('channelNew')}}">new</a>-->
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Channel Name</th>
              <th>Sources</th>
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
              <td class="sourceslist">
                  <button type="button"  class="btn btn-default btn-xs" title="{{$channel->local_source}}">local</button>
                  <button type="button"  class="btn btn-default btn-xs" title="{{$channel->cdn_source}}">cdn</button>
              </td>
              <td class="country">{{$countries[$channel->country_id]}}</td>
              <td class="language">{{$channel->language}}</td>
              <td class="">
                <a href="{{route('bchannelShow',$channel->id)}}" class="b-view" title="view">view</a>
                <a href="{{route('bchannelEdit',$channel->id)}}" class="b-edit" title="edit">edit</i></a>
                <a href="{{route('bchannelEpgManage',$channel->id)}}">epg</a>
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
