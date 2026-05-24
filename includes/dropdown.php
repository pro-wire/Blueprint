<?php

/**
 * Includes: dropdown.php
 * Dropdown content triggered by dropdown button
 * @var $_GET['id'] - page id
 * @var $_GET['back_url'] - back url
 */

namespace ProcessWire;

$id = $sanitizer->int($input->get->id);
$back_url = $sanitizer->text($input->get->back_url);
$page = $pages->get($id);

?>

<ul class="uk-nav uk-dropdown-nav">

  <li>
    <a href="<?= $adminHelper->pageEditLink($id, $back_url) ?>">
      <i class="fa fa-pencil"></i>
      <?= __('Edit'); ?>
    </a>
  </li>

  <li>
    <a href="#" <?= $adminHelper->pageEditModal($id) ?>>
      <i class="fa fa-edit"></i>
      <?= __('Quick Edit'); ?>
    </a>
  </li>

  <li>
    <a href="#" onclick="adminHelper.actions.togglePage(<?= $id ?>)">
      <?php if ($page->isUnpublished()): ?>
        <i class="fa fa-toggle-off"></i>
        <?= __('Publish'); ?>
      <?php else: ?>
        <i class="fa fa-toggle-on"></i>
        <?= __('Unpublish'); ?>
      <?php endif; ?>
    </a>
  </li>
  <li>
    <a href="#" onclick="adminHelper.actions.trashPage(<?= $id ?>)">
      <i class="fa fa-trash"></i>
      <?= __('Trash'); ?>
    </a>
  </li>

</ul>