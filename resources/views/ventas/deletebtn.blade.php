<form method="POST" action="/venta/{{$folio}}">
	@method('DELETE')
	@csrf
	<a href="/venta/{{$folio}}"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
</form> 