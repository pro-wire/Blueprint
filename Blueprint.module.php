<?php

/**
 *  Blueprint 
 *  @author Ivan Milincic <hello@kreativan.dev>
 *  @copyright 2023 kraetivan.dev
 *  @link http://kraetivan.dev
 */


namespace ProcessWire;

class Blueprint extends WireData implements Module {

  public static function getModuleInfo() {
    return array(
      'title' => 'Blueprint',
      'version' => 100,
      'summary' => 'Main blueprint module for the logic and helpers',
      'icon' => 'codepen',
      'permission' => 'page-view',
      'author' => "Ivan Milincic",
      "href" => "https://kreativan.dev",
      'singular' => true,
      'autoload' => false,
      'installs' => array('ProcessBlueprint')
    );
  }

  public function __construct() {
    // ...
  }


  // --------------------------------------------------------- 
  // Init 
  // --------------------------------------------------------- 

  public function init() {
    // do something
  }


  // --------------------------------------------------------- 
  // Ready runs after init() 
  // --------------------------------------------------------- 

  public function ready() {
    // do something
  }

  // ========================================================= 
  // Helpers
  // ========================================================= 

  public function path() {
    return $this->config->paths->siteModules . $this->className() . "/";
  }

  public function url() {
    return $this->wire('config')->urls->siteModules . $this->className() . '/';
  }

  public function loadClass($className, $namespace = "Blueprint") {
    require_once $this->path() . "classes/{$className}.php";
    $fullClassName = "{$namespace}\\{$className}";
    return new $fullClassName();
  }
}
