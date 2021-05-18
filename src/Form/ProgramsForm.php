<?php

namespace Drupal\ilumno_programs\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;

/**
 * Class ProgramsForm.
 */
class ProgramsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'programs_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form to create programs
    $form['program_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Program name'),
      '#description' => $this->t('Stores the name of the program'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
      // It makes the call to the Callback that performs the validations to the field
      '#ajax' =>[
        'callback' => '::programNameValidateCallback',
        'effect' => 'fade',
        'event' => 'change',
      ],
    ];
    $form['program_identifier'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Identifier'),
      '#description' => $this->t('Stores the program identifier'),
      '#maxlength' => 20,
      '#size' => 20,
      '#weight' => '0',
      // It makes the call to the Callback that performs the validations to the field
      '#ajax' => [
        'callback' => '::programIdentifierValidateCallback',
        'effect' => 'fade',
        'event' => 'change',
      ],
    ];
    $form['program_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Code'),
      '#description' => $this->t('Stores the program code'),
      '#maxlength' => 20,
      '#size' => 20,
      '#weight' => '0',
      // It makes the call to the Callback that performs the validations to the field
      '#ajax' => [
        'callback' => '::programCodeValidateCallback',
        'effect' => 'fade',
        'event' => 'change',
      ],
    ];
    $form['program_date'] = [
      '#type' => 'date',
      '#title' => $this->t('Date'),
      '#description' => $this->t('Stores the date of the program (dd/mm/yyyy)'),
      '#weight' => '0',
    ];
    $form['program_type'] = [
      '#type' => 'radios',
      '#title' => $this->t('Type'),
      '#description' => $this->t('Stores program option'),
      '#options' => ['Pregrado' => $this->t('Pregrado'), 'Postgrado' => $this->t('Postgrado'), 'Curso corto' => $this->t('Curso corto')],
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      // Send the form via Ajax
      '#ajax' => [
        'callback' => '::submitForm',
      ],
      '#value' => $this->t('Submit'),
    ];
    // Container where the message is displayed to the user
    $form['message'] = [
      '#type' => 'markup',
      '#markup' => '<div class="result_message"></div>',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function programNameValidateCallback(array &$form, FormStateInterface $form_state) {
    // Variables are assigned by default for a correct value
    $text = $this->t('Correct');
    $color = "green";
    // It is validated that the program field is not empty
    if (empty($form_state->getValue('program_name'))) {
      $color = "red";
      $text = $this->t('Is required.');
    }
    // It is validated that the program field is alphanumeric
    if (!empty($form_state->getValue('program_name')) && !ctype_alnum($form_state->getValue('program_name'))) {
      $color = "red";
      $text = $this->t('Special characters are not accepted.');
    }

    // AjaxResponse class instance
    $response = new AjaxResponse();
    // Add the message to the program descriptive field
    $response->addCommand(new HtmlCommand('#edit-program-name--description', $text));
    // Add the color to the program descriptive field
    $response->addCommand(new InvokeCommand('#edit-program-name--description', 'css', ['color', $color]));
    // Return the answer
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function programIdentifierValidateCallback(array &$form, FormStateInterface $form_state) {
    // Variables are assigned by default for a correct value
    $text = $this->t('Correct');
    $color = "green";
    // It is validated that the program field is not empty
    if (empty($form_state->getValue('program_identifier'))) {
      $color = "red";
      $text = $this->t('Is required.');
    }
    // It is validated that the program field is alphanumeric
    if (!empty($form_state->getValue('program_identifier')) && !ctype_alnum($form_state->getValue('program_identifier'))) {
      $color = "red";
      $text = $this->t('Special characters are not accepted.');
    }

    // AjaxResponse class instance
    $response = new AjaxResponse();
    // Add the message to the program descriptive field
    $response->addCommand(new HtmlCommand('#edit-program-identifier--description', $text));
    // Add the color to the program descriptive field
    $response->addCommand(new InvokeCommand('#edit-program-identifier--description', 'css', ['color', $color]));
    // Return the answer
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function programCodeValidateCallback(array &$form, FormStateInterface $form_state) {
    // Variables are assigned by default for a correct value
    $text = $this->t('Correct');
    $color = "green";
    // It is validated that the program field is not empty
    if (empty($form_state->getValue('program_code'))) {
      $color = "red";
      $text = $this->t('Is required.');
    }
    // It is validated that the program field is numeric
    if (!empty($form_state->getValue('program_code')) && !is_numeric($form_state->getValue('program_code'))) {
      $color = "red";
      $text = $this->t('Only numbers.');
    }

    // AjaxResponse class instance
    $response = new AjaxResponse();
    // Add the message to the program descriptive field
    $response->addCommand(new HtmlCommand('#edit-program-code--description', $text));
    // Add the color to the program descriptive field
    $response->addCommand(new InvokeCommand('#edit-program-code--description', 'css', ['color', $color]));
    // Return the answer
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateFields(array &$form, FormStateInterface $form_state) {
    $valid = TRUE;
    // Validate the Program Name field
    if (empty(trim($form_state->getValue('program_name')))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Program name</b> is required.'), 'error', TRUE);
    }
    if (!empty($form_state->getValue('program_name')) && !ctype_alnum($form_state->getValue('program_name'))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Program name</b> does not accept special characters.'), 'error', TRUE);
    }
    // Validate the Identifier field
    if (empty(trim($form_state->getValue('program_identifier')))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Identifier</b> is required.'), 'error', TRUE);
    }
    if (!empty($form_state->getValue('program_identifier')) && !ctype_alnum($form_state->getValue('program_identifier'))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Identifier</b> does not accept special characters.'), 'error', TRUE);
    }
    // Validate the Code field
    if (empty(trim($form_state->getValue('program_code')))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Code</b> is required.'), 'error', TRUE);
    }
    if (!empty($form_state->getValue('program_code')) && !is_numeric($form_state->getValue('program_code'))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Code</b> must be numeric.'), 'error', TRUE);
    }
    // Validate the Date field
    if (empty(trim($form_state->getValue('program_date')))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Date</b> is required.'), 'error', TRUE);
    }
    if (empty($form_state->getValue('program_date'))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Date</b> must have the format dd/mm/yyyy.'), 'error', TRUE);
    }
    // Validate the Type field
    if (empty($form_state->getValue('program_type'))) {
      $valid = FALSE;
      \Drupal::messenger()->addMessage($this->t('The field <b>Type</b> is required.'), 'error', TRUE);
    }
    return $valid;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Validate that the fields meet your requirements before being sent to the database
    $messages = drupal_get_messages();
    if ($this->validateFields($form, $form_state)===TRUE) {
      $fields = [
        'program_name' => $form_state->getValue('program_name'),
        'program_identifier' => $form_state->getValue('program_identifier'),
        'program_code' => $form_state->getValue('program_code'),
        'program_date' => strtotime($form_state->getValue('program_date')),
        'program_type' => $form_state->getValue('program_type'),
        'state' => ($form_state->getValue('program_type') == 'Pregrado') ? 1 : 2,
      ];
      try {
        $db_connection = \Drupal::database();
        $result = $db_connection->insert('programs')
          ->fields($fields)
          ->execute();
        if ($result) {
          \Drupal::messenger()->addMessage($this->t('Program @name created succesfully.', ['@name' => ($form_state->getValue('program_name'))]), 'status', TRUE);
        }
        else {
          \Drupal::messenger()->addMessage($this->t('Problem with the database, please try again.'), 'error', TRUE);
        }
      }
      catch (\Exception $e) {
        \Drupal::messenger()->addMessage($this->t('A problem report in the watchdog.'), 'error', TRUE);
        \Drupal::logger('programs')->error($e->getMessage());
      }
    }
    else {
      \Drupal::messenger()->addMessage($this->t('The fields are not correct'), 'error', TRUE);
    }

    $message = [
      '#theme' => 'status_messages',
      '#message_list' => $messages,
    ];

    $messages = \Drupal::service('renderer')->render($message);
    $response = new AjaxResponse();
    $response->addCommand(new HtmlCommand('.result_message', $messages));
    return $response;
  }

}
