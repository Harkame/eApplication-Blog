<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerVqgzndy\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVqgzndy/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerVqgzndy.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerVqgzndy\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerVqgzndy\appDevDebugProjectContainer(array(
    'container.build_hash' => 'Vqgzndy',
    'container.build_id' => 'f4eea048',
    'container.build_time' => 1544712686,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerVqgzndy');
