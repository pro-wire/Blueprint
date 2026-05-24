<?php

/**
 * Blueprint / views / subpage.php
 * @var $module - this module object
 * @var $page_name - current page name
 */

namespace ProcessWire;

$adminHelper->renderView("admin-tabs", [
  "tabs" => $module->tabs(),
]);

$adminHelper->renderView("admin-table", [
  'module' => $module->className(),
  'selector' => "parent=/, include=all, status!=trash, limit=3",
  'limit' => 5,
  'dropdown' => __DIR__ . "/../includes/dropdown.php",
  'htmx_pagination' => !empty($input->get->tab) ? 1 : 0,
  'fields' => [
    "Parent" => "parent.name",
    "ID" => "id",
  ]
]);
