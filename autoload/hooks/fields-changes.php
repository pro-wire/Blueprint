<?php

/**
 * Detect changes in fields
 */

namespace ProcessWire;

$this->addHookAfter('Page(parent.name=example)::changed(title)', function (HookEvent $event) {

  $page = $event->object;

  $old = $event->arguments(1);
  $new = $event->arguments(2);

  $event->addHookAfter("Pages::saved($page)", function (HookEvent $event) use ($page, $old, $new) {

    // Do something with the changes
    $this->message("Field 'title' changed from '$old' to '$new' on page '{$page->name}'");

    $event->removeHook(null);
  });
});
