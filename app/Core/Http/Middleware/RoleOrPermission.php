<?php

namespace ResultSystems\Emtudo\Core\Http\Middleware;

use Artesaos\Defender\Middlewares\AbstractDefenderMiddleware;

use Closure;

class RoleOrPermission extends AbstractDefenderMiddleware {

    /**
     * @param \Illuminate\Http\Request $request
     * @param callable                 $next
     *
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
		if (!isset($_SESSION)) {
			try {
				session_start();
			} catch (\Exception $e) {
			}
		}
		//Permissão de root desativada enconta termina as regras

		if (isset($_SESSION['Usuario']['Tipo_Usuario']) && $_SESSION['Usuario']['Tipo_Usuario']=='adm')
	        return $next($request);

	    //Verifica se o usuário está no grupo X
        $roles = $this->getRoles($request);
        $anyRole = $this->getAny($request);

        if (is_null($this->user)) {
			if ($request->ajax() || $request->json())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return view('auth::sem_permissao');
			}
        }

        if (is_array($roles) and count($roles) > 0) {
            $hasResult = false;

            foreach ($roles as $role) {
                $hasRole = $this->user->hasRole($role);


                // Check if any role is enough
                if ($anyRole and $hasRole) {
                    return $next($request);
                }

                $hasResult = $hasRole;
            }

            if ($hasResult) {
		        return $next($request);
            }
        }

        $permissions = $this->getPermissions($request);
        $anyPermission = $this->getAny($request);
        if (is_null($this->user)) {
			if ($request->ajax() || $request->isJson())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return view('auth::sem_permissao');
			}
        }

        if (is_array($permissions) and count($permissions) > 0) {
            $canResult = false;

            foreach ($permissions as $permission) {
                $canPermission = $this->user->can($permission);

                // Check if any permission is enough
                if ($anyPermission and $canPermission) {
                    return $next($request);
                }

                $canResult = $canPermission;
            }

            if (!$canResult) {
				if ($request->ajax() || $request->isJson())
				{
					return response('Unauthorized.', 401);
				}
				else
				{
                    return response('Unauthorized.', 401);
					return view('auth::sem_permissao');
				}
            }
        }

        return $next($request);
	}
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    private function getPermissions($request)
    {
        $routeActions = $this->getActions($request);

        $permissions = array_get($routeActions, 'can', []);

        return is_array($permissions) ? $permissions : (array) $permissions;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    private function getRoles($request)
    {
        $routeActions = $this->getActions($request);

        $roles = array_get($routeActions, 'is', []);

        return is_array($roles) ? $roles : (array) $roles;
    }}