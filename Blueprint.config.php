<?php

/**
 * Blueprint Module Config
 * @author Ivan Milincic <hello@kreativan.dev>
 * @link http://www.kraetivan.dev
 */

namespace ProcessWire;

class BlueprintConfig extends ModuleConfig {

  public function getInputfields() {
    $inputfields = parent::getInputfields();

    /**
     * Checkbox
     */
    $f = $this->wire('modules')->get("InputfieldCheckbox");
    $f->attr('name', 'check_option');
    $f->label = 'Check Option';
    $f->checkboxLabel = 'Yes / No';
    $f->value = 1;
    $inputfields->add($f);

    /**
     * Radio
     */
    $f = $this->wire('modules')->get("InputfieldRadios");
    $f->attr('name', 'radio_options');
    $f->label = 'Radio Options';
    $f->options = [
      '1' => 'One',
      '2' => "Two",
    ];
    $f->required = true;
    $f->defaultValue = "1";
    $f->optionColumns = 1;
    $f->columnWidth = "100%";
    $inputfields->add($f);

    //  Render inputfields
    // ===========================================================
    return $inputfields;
  }
}
