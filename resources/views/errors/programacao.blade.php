<?php
if (!isset($title)){
	$title='Manutenção!';
}
?>
@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Atualização!</div>
				<div class="panel-body">Estamos atualizando o sistema, por favor volte em instantes.</div>
			</div>
		</div>
	</div>
</div>
@endsection