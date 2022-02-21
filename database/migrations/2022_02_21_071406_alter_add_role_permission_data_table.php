<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddRolePermissionDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //roles
        DB::table('roles')->insert(
            array(
                [
                    'name' => 'Admin',
                ],
                [
                    'name' => 'SubAdmin',
                ],
                [
                    'name' => 'User',
                ],
            )
        );


        //Permission
        DB::table('permissions')->insert(
            array(
                [
                    'name' => 'index-usercontroller',
                ],
                [
                    'name' => 'addPermission-usercontroller',
                ],
                [
                    'name' => 'addRole-usercontroller',
                ],
                [
                    'name' => 'addRolePermission-usercontroller',
                ],
                [
                    'name' => 'register-usercontroller',
                ],
                [
                    'name' => 'show-usercontroller',
                ],
                [
                    'name' => 'update-usercontroller',
                ],
                [
                    'name' => 'destroy-usercontroller',
                ],
                [
                    'name' => 'deleteAll-usercontroller',
                ],
                [
                    'name' => 'export-usercontroller',
                ],
                [
                    'name' => 'login-logincontroller',
                ],
                [
                    'name' => 'logout-logincontroller',
                ],
                [
                    'name' => 'changePassword-logincontroller',
                ],
                [
                    'name' => 'forgotPassword-logincontroller',
                ],
                [
                    'name' => 'forgotPassword-logincontroller5',
                ],
                [
                    'name' => 'store-permissions',
                ],
                [
                    'name' => 'store-roles',
                ],
                [
                    'name' => 'index-roles',
                ],
                [
                    'name' => 'update-roles',
                ],
                [
                    'name' => 'show-roles',
                ],
                [
                    'name' => 'destroy-roles',
                ],
                [
                    'name' => 'deleteAll-roles',
                ],
                [
                    'name' => 'index-permissions',
                ],
                [
                    'name' => 'update-permissions',
                ],
                [
                    'name' => 'show-permissions',
                ],
                [
                    'name' => 'destroy-permissions',
                ],
                [
                    'name' => 'deleteAll-permissions',
                ],
                [
                    'name' => 'store-countriescontroller',
                ],
                [
                    'name' => 'index-countriescontroller',
                ],
                [
                    'name' => 'update-countriescontroller',
                ],
                [
                    'name' => 'show-countriescontroller',
                ],
                [
                    'name' => 'destroy-countriescontroller',
                ],
                [
                    'name' => 'deleteAll-countriescontroller',
                ],
                [
                    'name' => 'store-states',
                ],
                [
                    'name' => 'index-states',
                ],
                [
                    'name' => 'update-states',
                ],
                [
                    'name' => 'show-states',
                ],
                [
                    'name' => 'destroy-states',
                ],
                [
                    'name' => 'deleteAll-states',
                ],
                [
                    'name' => 'store-cities',
                ],
                [
                    'name' => 'index-cities',
                ],
                [
                    'name' => 'update-cities',
                ],
                [
                    'name' => 'show-cities',
                ],
                [
                    'name' => 'destroy-cities',
                ],
                [
                    'name' => 'deleteAll-cities',
                ],
                [
                    'name' => 'import-usercontroller',
                ],
               
            )
        );

        //role Permission
        DB::table('permission_role')->insert(
            array(
                [
                    'permission_id' => '1',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '2',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '3',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '4',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '5',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '6',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '6',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '7',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '8',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '9',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '10',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '11',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '12',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '13',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '14',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '15',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '16',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '17',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '18',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '19',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '20',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '21',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '22',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '23',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '24',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '25',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '26',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '27',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '28',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '29',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '30',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '31',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '32',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '33',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '34',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '35',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '36',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '37',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '38',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '39',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '40',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '41',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '42',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '43',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '44',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '45',
                    'role_id' => '1',
                ],
                [
                    'permission_id' => '46',
                    'role_id' => '1',
                ],
               
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
