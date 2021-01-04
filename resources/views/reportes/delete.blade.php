<form method="POST" action="/delete/{{$id}}">
	@method('DELETE')
	@csrf
	<a href="/delete/{{$id}}"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
</form> 