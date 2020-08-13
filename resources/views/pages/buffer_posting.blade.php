@extends('layouts.app')
@section('content')
<div class="container-fluid app-body">
	<h3>Buffer Postings 

	@if($user->plansubs())
		@if($user->plansubs()['plan']->slug == 'proplusagencym' OR $user->plansubs()['plan']->slug == 'proplusagencyy' )
			<a href="https://bufferapp.com/oauth2/authorize?client_id={{env('BUFFER_CLIENT_ID')}}&redirect_uri={{env('BUFFER_REDIRECT')}}&response_type=code" class="btn btn-primary pull-right">Add Buffer Post</a>
		@endif
	@endif
	</h3>
	<center>
		<div class="form-group col-md-6">
			<input type="date" name="date" onchange="search()" id="date" class="form-control">
		</div>
		<div class="form-group col-md-6">
			<select class="form-control" onchange="search()" id="group_id" name="group_id">
				<option value="0">All Groups</option>
			@foreach($groups as $group)
				<option value="{{ $group->id }}">{{ $group->name }}</option>
			@endforeach
		</select>
		</div>
		
		
	</center>

	<div class="row">
		<div class="col-md-12" id="posting_views">
			@include('pages.buffer_posting_view',['bufferPostings' => $bufferPostings])
		</div>
	</div>
</div>
@endsection

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script >
	function search(){
		var date= $('#date').val();
		if(date==""){
			date = 0;
		}		
		var group_id = $('#group_id').val();

		openMyLink('{{ url('buffer-posting') }}/search/'+date+'&'+group_id);
	}

	function openMyLink(link){
		$('#posting_views').html('<h1 class="text-center"><strong>Loading...</strong></h1>');

		$.ajax({
			url: link,
			type: 'GET',
		})
		.done(function(response) {
			$('#posting_views').html(response);
		});
	}
</script>
