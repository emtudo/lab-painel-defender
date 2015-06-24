@extends('app')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Permissão!</div>

				<div class="panel-body">
					Você não está logado! Utilize o menu "ENTRAR" para entrar com seu usuário.
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ preg_replace('#^https?://([^/])+#', '',url('/js/angular/home.js')) }}"></script>
@endsection
