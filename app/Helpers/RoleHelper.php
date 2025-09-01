<?php

if (!function_exists('getRoleCategory')) {
    function getRoleCategory($role)
    {
        $roleMappings = [
            'development' => ['superadmin', 'developer', 'admin'],
            'project_superadmin' => ['globaladmin', 'technicalcommittee', 'executivemember', 'financemanager'],
            'project_admin' => ['setadmin', 'setchairman'],
            'project_member' => ['member'],
            'project_family_members' => ['familymember'],
            'project_general_users' => ['customer'],
            'project_guest' => ['guest'],
        ];

        // Loop through the roleMappings and return the appropriate roles
        foreach ($roleMappings as $category => $roles) {
            if (in_array($role, $roles)) {
                return $roles; // Return the roles as an array
            }
        }

        return []; // Return an empty array if the role isn't found
    }
}


// Then register the helper in composer.json:
// Add this line under "autoload" → "files":
// "autoload": {
//     "files": [
//         "app/Helpers/RoleHelper.php"
//     ]
// }

// composer dump-autoload



// To use in code
// $roleCategory = getRoleCategory($user->role);

// if ($roleCategory === 'development') {
//     // Actions for developers and superadmins
// }


//OR
// <?php

// namespace App\Helpers;

// class RoleHelper
// {
//     public static function getRoleCategory($role)
//     {
//         $roleMappings = [
//             'development' => ['superadmin', 'developer', 'admin'],
//             'project_superadmin' => ['globaladmin', 'technicalcommittee', 'executivemember', 'financemanager'],
//             'project_admin' => ['setadmin', 'setchairman'],
//             'project_member' => ['member'],
//             'project_family_members' => ['familymember'],
//             'project_general_users' => ['customer'],
//             'project_guest' => ['guest'],
//         ];

//         foreach ($roleMappings as $category => $roles) {
//             if (in_array($role, $roles)) {
//                 return $category;
//             }
//         }

//         return 'others'; // Default for roles not listed
//     }
// }


// use App\Helpers\RoleHelper;

// $roleCategory = RoleHelper::getRoleCategory($user->role);

