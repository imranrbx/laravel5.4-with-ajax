<div class="modal fade" id="editTodoTask">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Update Todo Record - {{$task->id}}</h4>
			</div>
			<form action="{{ URL::to('todo/update')}}" id="frmEditTask" method="post" accept-charset="utf-8">
				<div class="modal-body">
				<div class="form-group">
					<label for="txtName">Update Todo Task:</label>
					{{csrf_field()}}
					<input type="hidden" name="id" value="{{$task->id}}" />
					<input type="text" id="txtName" name="name" class="form-control" placeholder="Enter New Todo Task" value="{{$task->name}}" required />
				</div>
				</div>
				<div class="modal-footer" >
					<button type="button" data-dismiss="modal" aria-hidden="true" data-task="{{$task->id}}" id="btnDelete" class=" btn btn-danger">Delete</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
			
		</div>
	</div>
</div>