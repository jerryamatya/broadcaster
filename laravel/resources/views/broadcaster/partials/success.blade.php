@if(Session::has('success'))
<div class="row-fluid">
<div class="col-md-12">
<div class="alert alert-success alert-dismissable">
<i class="fa fa-check-circle"></i>
{{Session::get('success')}}
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
</div>
</div>
</div>
@endif