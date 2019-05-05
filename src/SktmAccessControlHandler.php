<?php

namespace Drupal\sktm;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the SKTM entity.
 *
 * @see \Drupal\sktm\Entity\Sktm.
 */
class SktmAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\sktm\Entity\SktmInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished sktm entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published sktm entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit sktm entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete sktm entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add sktm entities');
  }

}
