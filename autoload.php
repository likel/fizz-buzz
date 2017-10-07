<?php
/**
 * PSR-4 autoload
 *
 * After registering this autoload function with require_once()
 * an example line which will fire this autoload is
 *
 *		new \Fizz\Buzz\Class\Model;
 *
 * This will attempt to load /path/to/project/models/Class/Model.php
 *
 * @author Liam Kelly (likel)
 * @created 07/10/2017
 * @version 1.0.0
 */

/**
 * @param string $class_name The requested class name.
 * @return void
 */
spl_autoload_register(function ($class_name) {
  // Change these depending on the project
  $project_prefix = 'Fizz\\Buzz\\';
  $models_dir = __DIR__ . '/models/';

  // Helper variables used in the autoloader
  $project_prefix_length = strlen($project_prefix);
  $relative_class = substr($class_name, $project_prefix_length);

  // Return if the requested class does not include the prefix
  if (strncmp($project_prefix, $class_name, $project_prefix_length) !== 0) {
    return;
  }

  // Replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the class name and append with .php
  $file = $models_dir . str_replace('\\', '/', $relative_class) . '.php';

  if (file_exists($file)) {
    require_once($file);
  }
});
