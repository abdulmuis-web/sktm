<?php

namespace Drupal\sktm\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for SKTM edit forms.
 *
 * @ingroup sktm
 */
class SktmForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\sktm\Entity\Sktm */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

	if(!$entity->get('id')->value){
	  $form['code'] = [
        '#title' => 'Code',
        '#type' => 'number',
        '#default_value' => '0',
		'#weight' => '-10',
		'#required' => TRUE,
      ];
	}
	
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\wilayah_indonesia_province\Entity\Province */		
	parent::validateForm($form, $form_state);

    $entity = $this->entity;
	
	if(is_null($entity->id())){
	  $query = \Drupal::entityQuery('sktm')
			->range('0', '1');
	  $or = $query->orConditionGroup();
	  $or->condition('id', $form_state->getValue('code'));
	  $or->condition('name', $form_state->getValue('name')[0]['value']);
	  $query->condition($or);
	  $id = $query->execute();
	  if(!empty($id)){
	    $form_state->setErrorByName('code',"The code or name field already exist");
	  }
	}else{
	  $id = \Drupal::entityQuery('sktm')
	        ->condition('name', $form_state->getValue('name')[0]['value'])
			->condition('id', $entity->id(), '!=')
			->range('0', '1')
			->execute();
	  if(!empty($id)){
	    $form_state->setErrorByName('name',t("The SKTM with name @name already exist", array('@name' => $form_state->getValue('name')[0]['value'])));
	  }
	}
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

	if(is_null($entity->id())){
		$entity->set('id', $form_state->getValue('code'));
	}
	
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label SKTM.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label SKTM.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.sktm.canonical', ['sktm' => $entity->id()]);
  }

}
