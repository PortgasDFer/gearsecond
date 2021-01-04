<form method="POST" action="/producto/{{$codebar}}">
	@method('DELETE')
	@csrf
	<a href="/producto/{{$codebar}}"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
</form> 