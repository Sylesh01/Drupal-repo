<?php

namespace Drupal\sfmc\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure sfmc_settings.
 */
class SfmcConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sfmc_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'sfmc.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('sfmc.settings');
    $form = $this->inboxSubscritionConfigForm($form, $config);
    $form = $this->pledgeConfigForm($form, $config);
    return parent::buildForm($form, $form_state);
  }

  /**
   * Inbox Subscription Configuration Form.
   */
  public function inboxSubscritionConfigForm(array $form, $config) {
    $form['sfmc'] = [
      '#type' => 'details',
      '#title' => $this->t('Inbox Subscription - SFMC API Config'),
      '#open' => FALSE,
    ];
    $form['sfmc']['de_client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Master DE Client Id'),
      '#default_value' => $config->get('de_client_id'),
    ];
    $form['sfmc']['de_client_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Master DE Client Secret'),
      '#default_value' => $config->get('de_client_secret'),
    ];
    $form['sfmc']['brand_client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Brand Client Id'),
      '#default_value' => $config->get('brand_client_id'),
    ];
    $form['sfmc']['brand_client_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Brand Client secret'),
      '#default_value' => $config->get('brand_client_secret'),
    ];
    $form['sfmc']['brand_token_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Brand Token Endpoint'),
      '#default_value' => $config->get('brand_token_url'),
    ];
    $form['sfmc']['de_token_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Master DE Token Endpoint'),
      '#default_value' => $config->get('de_token_url'),
    ];
    $form['sfmc']['de_add_contact_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Master DE Add Contact Endpoint'),
      '#default_value' => $config->get('de_add_contact_url'),
    ];
    $form['sfmc']['brand_add_contact_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Add brand contact Endpoint'),
      '#default_value' => $config->get('brand_add_contact_url'),
    ];
    $form['sfmc']['brand_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Brand Id'),
      '#default_value' => $config->get('brand_id'),
    ];
    $form['sfmc']['account_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Brand Account Id'),
      '#default_value' => $config->get('account_id'),
    ];
    $form['sfmc']['de_account_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Master DE Account Id'),
      '#default_value' => $config->get('de_account_id'),
    ];
    $form['sfmc']['source_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Source code'),
      '#default_value' => $config->get('source_code'),
    ];
    $form['sfmc']['inbox_success_msg'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Inbox Subscription Success Message'),
      '#default_value' => $config->get('inbox_success_msg'),
    ];
    return $form;
  }

  /**
   * Pledge Configuration Form.
   */
  public function pledgeConfigForm(array $form, $config) {
    $form['sfmc_pledge'] = [
      '#type' => 'details',
      '#title' => $this->t('Take The Pledge - SFMC API Config'),
      '#open' => FALSE,
    ];
    $form['sfmc_pledge']['pledge_client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pledge Client Id'),
      '#default_value' => $config->get('pledge_client_id'),
    ];
    $form['sfmc_pledge']['pledge_client_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pledge Client Secret'),
      '#default_value' => $config->get('pledge_client_secret'),
    ];
    $form['sfmc_pledge']['pledge_account_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pledge Account Id'),
      '#default_value' => $config->get('pledge_account_id'),
    ];
    $form['sfmc_pledge']['pledge_token_endpoint'] = [
      '#type' => 'url',
      '#title' => $this->t('Pledge Token EndPoint'),
      '#default_value' => $config->get('pledge_token_endpoint'),
    ];
    $form['sfmc_pledge']['pledge_event_endpoint'] = [
      '#type' => 'url',
      '#title' => $this->t('Pledge Event EndPoint'),
      '#default_value' => $config->get('pledge_event_endpoint'),
    ];
    $form['sfmc_pledge']['pledge_brand_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Pledge Brand Id'),
      '#default_value' => $config->get('pledge_brand_id'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('sfmc.settings')
      ->set('de_client_id', $form_state->getValue('de_client_id'))
      ->set('de_client_secret', $form_state->getValue('de_client_secret'))
      ->set('brand_client_id', $form_state->getValue('brand_client_id'))
      ->set('brand_client_secret', $form_state->getValue('brand_client_secret'))
      ->set('brand_token_url', $form_state->getValue('brand_token_url'))
      ->set('de_token_url', $form_state->getValue('de_token_url'))
      ->set('de_add_contact_url', $form_state->getValue('de_add_contact_url'))
      ->set('brand_add_contact_url', $form_state->getValue('brand_add_contact_url'))
      ->set('brand_id', $form_state->getValue('brand_id'))
      ->set('account_id', $form_state->getValue('account_id'))
      ->set('de_account_id', $form_state->getValue('de_account_id'))
      ->set('source_code', $form_state->getValue('source_code'))
      ->set('inbox_success_msg', $form_state->getValue('inbox_success_msg'))
      ->set('pledge_client_id', $form_state->getValue('pledge_client_id'))
      ->set('pledge_client_secret', $form_state->getValue('pledge_client_secret'))
      ->set('pledge_account_id', $form_state->getValue('pledge_account_id'))
      ->set('pledge_token_endpoint', $form_state->getValue('pledge_token_endpoint'))
      ->set('pledge_event_endpoint', $form_state->getValue('pledge_event_endpoint'))
      ->set('pledge_brand_id', $form_state->getValue('pledge_brand_id'))
      ->save();
  }

}
