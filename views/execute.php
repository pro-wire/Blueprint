<?php

/**
 * Views: execute.php
 * @var $module - this module object
 * @var $page_name - current page name
 */

namespace ProcessWire;

$adminHelper->renderView("admin-tabs", [
  'tabs' => $module->tabs(),
  'search' => !$input->get->tab ? 1 : 0,
]);

$adminHelper->renderView("admin-search-bar", [
  'module' => $module,
  'labels' => true,
]);

$adminHelper->renderView('admin-table', [
  'selector' => $module->selector(),
  'limit' => !empty($input->get->tab) ? 1 : 10,
  'dropdown' => __DIR__ . "/../includes/dropdown.php",
  'actions' => [
    'parent_id' => $pages->get('/example/')->id,
    'template_id' => $templates->get('system-page')->id,
    'create_new_text' => 'Create New',
  ],
  'fields' => [
    "Parent" => "parent.name",
    "ID" => "id",
  ]
]);
