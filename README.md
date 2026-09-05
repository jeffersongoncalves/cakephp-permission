# Permission Management For CakePHP 3.x

![CakePHP Permission](banners/cakephp-permission.png)

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-support-FFDD00?style=flat-square&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/jeffersongoncalves)

The library provides a flexible way to add role-based access control management to CakePHP 3.x

Inspired by [Laravel Permission](https://github.com/spatie/laravel-permission)

## Requirements

- CakePHP >=3.6
- PHP 7.0+

## Installation

1. Install via composer

```bash
composer require jeffersonsimaogoncalves/cakephp-permission
```

2. Load the plugin in `config/bootstrap.php`:

```php
// Load the plugin.
Plugin::load('JeffersonSimaoGoncalves/CakePermission');
```
3. Add the following configuration to your `app.php`

```php
'Permission' => [

    'tableNameMap' => [
        /**
         * Your users table, remember to modify it
         */
        'users' => 'your users table name',

        /**
         * Your roles table;If you want to use the default configuration. you don't need to change.
         */
        //'roles' => 'roles',

        /**
         * Your permissions table;If you want to use the default configuration. you don't need to change.
         */
        //'permissions' => 'permissions',

        /**
         * The join table between users and roles;If you want to use the default configuration. you don't need to change.
         */
        //'users_roles' => 'users_roles',

        /**
         * The join table between roles and permissions;If you want to use the default configuration. you don't need to change.
         */
        //'roles_permissions' => 'roles_permissions',
    ],

    'tableClassMap' => [
        /**
         * The Users model class, remember to modify it
         */
        'Users' => App\Model\Table\YourUsersTable::class,

        /**
         * The Roles model class;If you want to use the default configuration. you don't need to change.
         */
        //'Roles' => JeffersonSimaoGoncalves\CakePermission\Model\Table\RolesTable::class,

        /**
         * The Permissions model class;If you want to use the default configuration. you don't need to change.
         */
        //'Permissions' => JeffersonSimaoGoncalves\CakePermission\Model\Table\PermissionsTable::class
    ]
]
```

4. Generate the permission migration

```bash
./cake permission_migrate
```
If ok, now run the migrate command

```bash
./cake migrations migrate
```
 
 
## Usage

### Quick example

```php
//Creats a role
$role = Role::create('editor');
 
//Givs a permission to the role
$role->givePermission('edit article');

//Adds the role to the user 
$user->assignRole($role); 
// You can also give it directly by its name
$user->assignRole('editor');

//Checks whether the user has the permission
var_dump($user->hasPermission('edit article')) //output "true"
```

### Models

Open your `User` entity, use `UserTrait` like this:

```php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use JeffersonSimaoGoncalves\CakePermission\Model\Entity\UserTrait;

class User extends Entity
{
    use UserTrait; //Use trait provied by CakePermission

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
    
    // ...
}
```

Open your `UsersTable`, use `UserTableTrait` like this:

```php
namespace App\Model\Table;

use Cake\ORM\Table;
use JeffersonSimaoGoncalves\CakePermission\Model\Table\UsersTableTrait;

class UsersTable extends Table
{
    use UsersTableTrait;  // Use `UsersTableTrait`

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->buildPermissionRelationship(); // Creats the relationship
    }
    
    // ...
}
```

### Using permissions

Creates the permissions with `PermissionTrait::create` or `PermissionTrait::findOrCreate`

```php
$addPermission = Permission::findOrCreate('add article');

$editPermission = Permission::create('edit article');
```

### Using roles and permissions

Creates a role to the database with the `RoleTrait::create` or `RoleTrait::findOrCreate`

```php
$role = Role::create('editor');

//You can also use the following method. 
$role = Role::findOrCreate('editor');
```

Give the permission to the role;  You must confirm that the permission exists.

```php
$role->givePermission($addPermission);
$role->givePermission($editPermission);

//You can also directly give them by thier name
$role->givePermission('add article');
$role->givePermission('edit article');

//You can also give multiple permissions at once
$role->givePermission(['add article', 'edit article']);
```

Gets all permissions of the role

```php
$role->getAllPermissions();
```

Checks whether the role has permission to do something:

```php
$role->hasPermission('edit article'); //true

$role->hasPermission(['edit artic;e', 'add article']); //true

$role->hasPermission(['edit article', 'drop article']); // false

$role->hasAnyPermission('edit article', 'drop article'); // true
```

Removes the permission

```php
$role->revokePermission($addPermission);
 
//Or by its name
$role->revokePermission('add article'); 

//Revokes all permissions
$role->revokeAllPermissions();
```


### User's roles and permissions

Add the role to the user:

```php
$user->assignRole($role);

$user->assignRole('editor');

//You can also assign multiple roles at once
$user->assignRole(['editor', 'other role']);
```

Gets all the roles of user

```php
$user->getAllRoles();
```

Gets all permissions of user:

```php
$user->getAllPermissions();
```

Checks whether the user has permission to do something:

```php
$user->hasPermission('edit article'); //true

$user->hasPermission(['edit artic;e', 'add article']); //true

$user->hasPermission(['edit article', 'drop article']); // false

$user->hasAnyPermission('edit article', 'drop article'); // true
```

Removes the role of the user:

```php
$user->removeRole('editor');

//Or removes all roles of the user
$user->removeAllRoles(); 
```

## Extending

You can extends all existing Entity or Table. Do not forget to modify the default configuration in your `app.php`

## Credits

- [Jèfferson Gonçalves](https://github.com/jeffersongoncalves)
- [slince](https://github.com/slince) — author of the original [cakephp-permission](https://github.com/slince/cakephp-permission)

## License

The MIT license. See [MIT](https://opensource.org/licenses/MIT)
