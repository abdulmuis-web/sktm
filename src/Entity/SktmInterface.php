<?php

namespace Drupal\sktm\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining SKTM entities.
 *
 * @ingroup sktm
 */
interface SktmInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the SKTM name.
   *
   * @return string
   *   Name of the SKTM.
   */
  public function getName();

  /**
   * Sets the SKTM name.
   *
   * @param string $name
   *   The SKTM name.
   *
   * @return \Drupal\sktm\Entity\SktmInterface
   *   The called SKTM entity.
   */
  public function setName($name);

  /**
   * Gets the SKTM creation timestamp.
   *
   * @return int
   *   Creation timestamp of the SKTM.
   */
  public function getCreatedTime();

  /**
   * Sets the SKTM creation timestamp.
   *
   * @param int $timestamp
   *   The SKTM creation timestamp.
   *
   * @return \Drupal\sktm\Entity\SktmInterface
   *   The called SKTM entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the SKTM published status indicator.
   *
   * Unpublished SKTM are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the SKTM is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a SKTM.
   *
   * @param bool $published
   *   TRUE to set this SKTM to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\sktm\Entity\SktmInterface
   *   The called SKTM entity.
   */
  public function setPublished($published);

}
