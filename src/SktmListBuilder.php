<?php

namespace Drupal\sktm;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of SKTM entities.
 *
 * @ingroup sktm
 */
class SktmListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ID');
    $header['name'] = $this->t('SKTM');
    $header['score'] = $this->t('Skor');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\sktm\Entity\Sktm */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.sktm.canonical',
      ['sktm' => $entity->id()]
    );
    $row['score'] = $entity->score->value;
    return $row + parent::buildRow($entity);
  }

}
