<table class="table table-hover social-accounts"> 
	<thead> 
		<tr><th>SL</th> <th>User</th> <th>Group</th> <th>Post</th> <th>Account</th> <th>Account Service</th> <th>Post Text</th> <th>Sent At</th> </tr> 
	</thead> 
	<tbody> 
	<?php $__currentLoopData = $bufferPostings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td><?php echo e($key  + 1); ?></td>
			<td><?php echo e(optional($post->user)->name); ?></td>
			<td><?php echo e(optional($post->groupInfo)->name); ?></td>
			<td><?php echo $post->post? substr_replace($post->post->text, "...", 20) : ''; ?></td>
			<td><?php echo e(optional($post->accountInfo)->name); ?></td>
			<td><?php echo e($post->account_service); ?></td>
			<td><?php echo substr_replace($post->post_text, "...", 20); ?></td>
			<td><?php echo e(date($post->sent_at, strtotime('F j, Y'))); ?></td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody> 
</table>
<center><?php echo $bufferPostings->links(); ?></center>

<script type="text/javascript">
	$(document).ready(function() {
		$('ul.pagination li a').on('click',function(e){
			e.preventDefault();
			openMyLink($(this).attr('href'));
		});
	});
</script>