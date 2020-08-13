<?php $__env->startSection('content'); ?>
<div class="container-fluid app-body">
	<h3>Buffer Postings 

	<?php if($user->plansubs()): ?>
		<?php if($user->plansubs()['plan']->slug == 'proplusagencym' OR $user->plansubs()['plan']->slug == 'proplusagencyy' ): ?>
			<a href="https://bufferapp.com/oauth2/authorize?client_id=<?php echo e(env('BUFFER_CLIENT_ID')); ?>&redirect_uri=<?php echo e(env('BUFFER_REDIRECT')); ?>&response_type=code" class="btn btn-primary pull-right">Add Buffer Post</a>
		<?php endif; ?>
	<?php endif; ?>
	</h3>
	<center>
		<div class="form-group col-md-6">
			<input type="date" name="date" onchange="search()" id="date" class="form-control">
		</div>
		<div class="form-group col-md-6">
			<select class="form-control" onchange="search()" id="group_id" name="group_id">
				<option value="0">All Groups</option>
			<?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($group->id); ?>"><?php echo e($group->name); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
		</div>
		
		
	</center>

	<div class="row">
		<div class="col-md-12" id="posting_views">
			<?php echo $__env->make('pages.buffer_posting_view',['bufferPostings' => $bufferPostings], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script >
	function search(){
		var date= $('#date').val();
		if(date==""){
			date = 0;
		}		
		var group_id = $('#group_id').val();

		openMyLink('<?php echo e(url('buffer-posting')); ?>/search/'+date+'&'+group_id);
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

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>