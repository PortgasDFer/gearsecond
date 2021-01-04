<form method="POST" action="/deudores/{{$id}}">
	@method('DELETE')
	@csrf
	<a href="/deudores/{{$id}}"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
</form> 