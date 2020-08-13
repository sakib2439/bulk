<table class="table table-hover social-accounts"> 
	<thead> 
		<tr><th>SL</th> <th>User</th> <th>Group</th> <th>Post</th> <th>Account</th> <th>Account Service</th> <th>Post Text</th> <th>Sent At</th> </tr> 
	</thead> 
	<tbody> 
	@foreach ($bufferPostings as $key => $post)
		<tr>
			<td>{{ $key  + 1}}</td>
			<td>{{ optional($post->user)->name }}</td>
			<td>{{ optional($post->groupInfo)->name }}</td>
			<td>{!! $post->post? substr_replace($post->post->text, "...", 20) : '' !!}</td>
			<td>{{ optional($post->accountInfo)->name }}</td>
			<td>{{ $post->account_service }}</td>
			<td>{!! substr_replace($post->post_text, "...", 20) !!}</td>
			<td>{{ date($post->sent_at, strtotime('F j, Y')) }}</td>
		</tr>
	@endforeach
	</tbody> 
</table>
<center>{!! $bufferPostings->links() !!}</center>

<script type="text/javascript">
	$(document).ready(function() {
		$('ul.pagination li a').on('click',function(e){
			e.preventDefault();
			openMyLink($(this).attr('href'));
		});
	});
</script>