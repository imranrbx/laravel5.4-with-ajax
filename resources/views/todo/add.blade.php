<div class="modal fade" id="addTodoTask">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add New Todo Record</h4>
			</div>
			<form action="{{ URL::to('todo/save')}}" id="frmAddTask" method="post" accept-charset="utf-8">
				<div class="modal-body">
				<ul id="errors" class="list-unstyled">
					
				</ul>
				<div class="form-group">
					<label for="txtName">Enter Todo Task:</label>
					{{csrf_field()}}
					<input type="text" id="txtName" name="name" class="form-control" placeholder="Enter New Todo Task" required />
				</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
			
		</div>
	</div>
</div>