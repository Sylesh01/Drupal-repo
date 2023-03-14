<?php

namespace Drupal\schema_metatag\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class SchemaForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'schema_form.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'schema_form';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = $this->prepareForm($form);
    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('fname', $form_state->getValue('fname'))
      // You can set multiple configurations at once by making
      // multiple calls to set().
      ->set('lname', $form_state->getValue('lname'))
      ->set('oname', $form_state->getValue('oname'))
      ->set('address', $form_state->getValue('address'))
      ->set('displaypage', $form_state->getValue('displaypage'))
      ->save();

    parent::submitForm($form, $form_state);
  }
  public function prepareForm($variables)
    {
        $config= $this->config(static::SETTINGS);
        $form['schema_form']=[
            '#type' => 'details',
            '#title' => $this->t('Schema Form'),
            '#open' => FALSE,
        ];
        $form['schema_form']['fname']=[
            '#type' =>'textfield',
            '#title' => $this->t('First Name'),
            '#default_value' => $config->get('fname'),
        ];
        $form['schema_form']['lname']=[
            '#type' =>'textfield',
            '#title' => $this->t('Last Name'),
            '#default_value' => $config->get('lname'),
        ];
        $form['schema_form']['oname']=[
            '#type' =>'textfield',
            '#title' => $this->t('Other Name'),
            '#default_value' => $config->get('oname'),
        ];
        $form['schema_form']['address']=[
            '#type' => 'textfield',
            '#title' => $this->t('Address'),
            '#default_value' => $config->get('address'),            
        ];
        $form['schema_form']['displaypage']=[
            '#type' => 'textfield',
            '#title' => $this->t('Display Page'),
            '#default_value' => $config->get('displaypage'),            
        ];
        return $form;
        
    }
    
}