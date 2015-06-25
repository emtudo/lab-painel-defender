@extends('app')

@section('content')
    <script>
        var _url = "{{ preg_replace('#^https?://([^/])+#', '',route('admin.permission.resetall')) }}";
        var _user =<?php echo $user; ?>;

        var _permission =<?php echo $permission; ?>;
        var _session =<?php echo $session; ?>;

    </script>
    <div id="result"></div>
    <div class="container-fluid hidden startHidden" ng-controller="appPermissionController">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Alterar permissões de múltiplos usuários simultaneamente!</div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body cloneButtons">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary" ng-click="save()">Salvar tudo
                                        </button>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" ng-model="resetPermissions"/> Apagar as permissões
                                            existentes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @include("permission::partials.users")
                        </div>
                        <div class="col-sm-6">
                            @include('permission::partials.sessions')
                            @include('permission::partials.permissions')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("person::details")
    </div>
@endsection
