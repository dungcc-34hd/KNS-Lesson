<?php
namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    /**
     * Get all roles
     * @return mixed
     */
    public function getObjects($records,$search = null);

    /**
     * Get pages
     * @return mixed
     */
    public function getPages($records,$search = null);
}