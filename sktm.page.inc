<?php

/**
 * @file
 * Contains sktm.page.inc.
 *
 * Page callback for SKTM entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for SKTM templates.
 *
 * Default template: sktm.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_sktm(array &$variables) {
  // Fetch Sktm Entity Object.
  $sktm = $variables['elements']['#sktm'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
