<?php

/**
 * Action: example
 * Actions are are defined with autoloader module using pages, 
 * where each page defines GET variable and root folder for the actions.
 * This file will be executed in module init() method if there is a GET request:
 * @example ./?BlueprintActions=example
 */

namespace ProcessWire;

JSON::response([
  'message' => 'Hello from example action!'
]);
