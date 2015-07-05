@if(Session::has('errors'))
<div class="alert alert-danger alert-dissmissable">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
@foreach($errors->all() as $error)
<p class="has-error">{{$error}}</p>
@endforeach
</div>
@endif
