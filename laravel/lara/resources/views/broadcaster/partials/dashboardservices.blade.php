@if($servicename=="Live Tv")
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Channel Name</th>
              <th>Sources</th>
              <th>Country</th>
              <th>Language</th>
            </tr>
          </thead>
          <tbody>
          @foreach($data[$serviceid] as $channel)
            <tr class="channelrow">
              <td>
              <span class="logo">
                @if($channel->logo)
                   <img style="width: 40px" src="{{asset($cbs_options['channelLogoPath'].$channel->logo)}}">
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
            </tr>
            @endforeach
          </tbody>
</table>
<a href="{{route('bchannelList')}}"class="pull-right">more</a>

@elseif($servicename == "News App")
<table class="table table-hover table-condensed">
          <thead>
            <tr>
              <th>Name</th>
              <th>Manage</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach($data[$serviceid] as $newsapp)
            <tr class="channelrow">
              <td>
                {{$newsapp->name}}
              </td>

   
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
@elseif($servicename=="News Blog")
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
          @foreach($data[$serviceid] as $article)
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
            </tr>
            @endforeach
          </tbody>
</table>
<a href="{{route('newsList')}}"class="pull-right">more</a>
@endif