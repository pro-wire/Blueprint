<?php

/**
 *  BlueprintProcess
 *
 *  @author Ivan Milincic <hello@kreativan.dev>
 *  @copyright 2023 kraetivan.dev
 *  @link http://kraetivan.dev
 */

namespace ProcessWire;

class ProcessBlueprint extends Process implements WirePageEditor {

  public static function getModuleInfo() {
    return array(
      'title' => 'Blueprint: Process',
      'version' => 100,
      'summary' => 'Process Module Boilerplate using AdminHelper features',
      'icon' => 'desktop',
      'author' => "Ivan Milincic",
      "href" => "https://kreativan.dev",
      'permission' => 'blueprint',
      'permissions' => ['blueprint' => 'Access to Blueprint'],
      'page' => [
        'name' => 'blueprint',
        'title' => 'Blueprint',
        'parent' => '',
      ],
      'singular' => true,
      'autoload' => false,
      // 'requires' => array('AdminHelper'),
      // 'installs' => array('Blueprint'),
    );
  }

  // for WirePageEditor
  public function getPage() {
    return $this->page;
  }

  public function init() {
    parent::init(); // always remember to call the parent init
  }

  public function ready() {
    // do something
  }

  // --------------------------------------------------------- 
  // Admin Pages
  // --------------------------------------------------------- 

  /**
   * Custom Admin Page Edit
   */
  public function executeEdit() {
    return $this->adminHelper->adminPageEdit();
  }

  /**
   * Main module admin page
   * Can access this page from url: ./
   * Will render file from views/execute.php
   */
  public function ___execute() {
    $this->headline('Blueprint');
    $this->breadcrumb('./', 'Blueprint');
    return [
      "module" => $this,
      "page_name" => "main",
    ];
  }

  /**
   * Subpage
   * Can access this page from main page using url: ./subpage/
   * Will render file from views/subpage.php
   */
  public function ___executeSubpage() {
    $this->headline('Subpage');
    $this->breadcrumb('./', 'Blueprint');
    $this->breadcrumb('./subpage/', 'Subpage');
    return [
      "module" => $this,
      "page_name" => "subpage",
    ];
  }

  // --------------------------------------------------------- 
  // Selector
  // --------------------------------------------------------- 

  public function selector() {
    $selector = "parent=/example/";

    if (!$this->input->get->status) {
      $selector .= ", include=all, status!=trash";
    } else {
      switch ($this->input->get->status) {
        case 'hidden':
          $selector .= ",status=" . Page::statusHidden;
          break;
        case 'unpublished':
          $selector .= ",status=" . Page::statusUnpublished;
          break;
        case 'published':
          $selector .= ",status!=" . Page::statusUnpublished;
          break;
      }
    }

    // whitelist of fields that can be used in search
    $search_fields = array_keys($this->search_fields());

    if ($this->input->get != '') {
      foreach ($this->input->get as $key => $value) {
        $value = $this->sanitizer->selectorValue($value);
        if ($value != "" && in_array($key, $search_fields) && $key != "status") {
          if ($key == "title") {
            $selector .= ",title*=$value";
          } else {
            $selector .= ",$key=$value";
          }
        }
      }
    }

    // for reactive example
    if (
      $this->input->get->tab && $this->input->get->tab == "reactive"
    ) {
      $selector .= ",limit=1";
    }

    return $selector;
  }

  // --------------------------------------------------------- 
  // Tabs 
  // --------------------------------------------------------- 

  public function tabs() {
    $tabs = [
      "main" => [
        "title" => "Main",
        "url" => "",
        "icon" => "table",
        "htmx" => false,
      ],
      "subpage" => [
        "title" => "Subpage",
        "url" => "subpage",
        "icon" => "file-o",
        "htmx" => false,
      ],
      "reactive" => [
        "title" => "Reactive",
        "url" => "?tab=reactive",
        "icon" => "bolt",
        "htmx" => true,
      ]
    ];
    return $tabs;
  }

  // --------------------------------------------------------- 
  // Search 
  // --------------------------------------------------------- 

  /** 
   * Search fields
   * List of fields that will be used in the search bar
   * Array key should be the same as the field name
   */
  public function search_fields() {
    $fields = [
      'id' => [
        'type' => 'text',
        'name' => 'id',
        'value' => $this->input->get->id,
        'label' => __('ID'),
        'placeholder' => __('ID'),
        'grid' => '1-4',
      ],
      'title' => [
        'type' => 'text',
        'name' => 'title',
        'value' => $this->input->get->title,
        'label' => __('Title'),
        'placeholder' => __('Title'),
        'grid' => '1-4',
      ],
      'status' => [
        'type' => 'select',
        'name' => 'status',
        'value' => $this->input->get->status,
        'label' => __('Status'),
        'placeholder' => __('Select Status'),
        'options' => [
          // 'hidden' => __('Hidden'),
          'unpublished' => __('Unpublished'),
          'published' => __('Published')
        ],
        'grid' => '1-4',
      ],
      'category' => [
        'type' => 'select_pages',
        'name' => 'parent',
        'value' => $this->input->get->category,
        'label' => __('Parent'),
        'placeholder' => __('Select Parent'),
        'pages' => $this->pages->get('/')->children('include=all'),
        'grid' => '1-4',
      ],
    ];
    return $fields;
  }
}
