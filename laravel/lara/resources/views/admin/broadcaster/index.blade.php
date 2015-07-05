@extends('admin.partials.master')
@section('content')
<a href="{{route('broadcasterNew')}}">new</a>
<table class="table table-hover table-condensed">
  <thead>
    <tr>
      <th>Company</th>
      <th>Name</th>
      <th>Logo</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($broadcasters as $broadcaster)
    <tr>
      <td>{{$broadcaster->company_name}}</td>
      <td>{{$broadcaster->display_name}}</td>
      <td>
        @if($broadcaster->logo)
        <img style="max-width:80px;height:auto" src="{{asset($cbs_options['broadcasterLogoPath'].$broadcaster->logo)}}">
        @endif
      </td>
      <td>
      <a href="{{route('broadcasterEdit',$broadcaster->id)}}">edit</a>
      <a href="#">delete</a>
      <a href="{{route('broadcasterAccount',$broadcaster->id)}}">account</a>
      <a href="{{route('broadcasterConfig',$broadcaster->id)}}">config</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@stop