<?php

if(!class_exists('PermissionHelper')) {
    class PermissionHelper {
        public static function generatePermissions(): array {
            $controllers = self::extractControllerNames();
            $permissions = [];
            foreach($controllers as $controller) {
                $permission = str_replace(['Controller', '@'], ['', '-'], $controller);
                $permission = implode('-', array_reverse(explode('-', $permission)));
                $permissions[] = $permission;
            }
            return $permissions;
        }

        public static function extractControllerNames(): array {
            $extractControllerNames = [];
            // Loop through all routes
            foreach(Route::getRoutes() as $route) {
                $action = $route->getAction();
                // Check if the route has a controller key in its action
                if(array_key_exists('controller', $action)) {
                    $fullControllerName = $action['controller'];

                    // Check if the controller is in the correct namespace and does not belong to Auth namespace
                    if(
                        strpos($fullControllerName, 'App\Http\Controllers\\') === 0 &&
                        strpos($fullControllerName, 'App\Http\Controllers\Auth\\') !== 0
                    ) {
                        // Extract the controller name without the namespace
                        $extractControllerNames[] = str_replace('App\Http\Controllers\\', '', $fullControllerName);
                    }
                }
            }
            return $extractControllerNames;
        }
    }
}
