<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.jBD0lq.' shared service.

return $this->privates['.service_locator.jBD0lq.'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'serializer' => ['services', 'serializer', 'getSerializerService', false],
    'usersRepository' => ['privates', 'App\\Repository\\UsersRepository', 'getUsersRepositoryService.php', true],
], [
    'serializer' => '?',
    'usersRepository' => 'App\\Repository\\UsersRepository',
]);
