<?php

use PHPUnit\Framework\TestCase;

/**
 * Every class the plugin ships autoloads (catches syntax errors, bad namespaces and missing dependencies).
 */
class SmokeTest extends TestCase
{
    /**
     * @dataProvider classes
     */
    public function testClassLoads(string $class): void
    {
        $this->assertTrue(class_exists($class) || interface_exists($class) || trait_exists($class), $class);
    }

    public function classes(): array
    {
        return [
            ['JeffersonSimaoGoncalves\\CakePermission\\Constants'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Exception\\InvalidArgumentException'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Exception\\RuntimeException'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\HasPermissionTrait'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\Permission'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\PermissionInterface'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\PermissionTrait'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\Role'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\RoleInterface'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\RoleTrait'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\User'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Entity\\UserTrait'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Table\\PermissionsTable'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Table\\PermissionsTableTrait'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Table\\RolesTable'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Table\\RolesTableTrait'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Table\\UsersTable'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Model\\Table\\UsersTableTrait'],
            ['JeffersonSimaoGoncalves\\CakePermission\\SchemaFactory'],
            ['JeffersonSimaoGoncalves\\CakePermission\\Shell\\PermissionMigrateShell'],
            ['JeffersonSimaoGoncalves\\CakePermission\\TableFactory'],
        ];
    }
}
