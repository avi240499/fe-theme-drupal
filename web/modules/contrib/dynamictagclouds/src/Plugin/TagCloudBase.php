<?php


namespace Drupal\dynamictagclouds\Plugin;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for Tag cloud plugins.
 */
abstract class TagCloudBase extends PluginBase implements TagCloudInterface {

  /**
   * {@inheritdoc}
   */
  public function build($tags) {
    $template = $this->getTemplatePath();

    $build = [
      '#type' => 'inline_template',
      '#template' => file_get_contents($template), // Load the template content as a string.
      '#context' => ['tags' => $tags], // Pass context to the template.
    ];

    foreach ($this->getPluginDefinition()['libraries'] as $library) {
      $build['#attached']['library'][] = $library;
    }

    return $build;
  }

  /**
   * Method to return tag cloud style template file path.
   *
   * @return string
   *   Template file path.
   */
  protected function getTemplatePath() {
    $template = $this->getPluginDefinition()['template'];

    // Use modern service to get the module or theme path.
    $extension_path = \Drupal::service('extension.list.' . $template['type'])->getPath($template['name']);

    return $extension_path . '/' . $template['directory'] . '/' . $template['file'] . '.html.twig';
  }
}








// namespace Drupal\dynamictagclouds\Plugin;

// use Drupal\Component\Plugin\PluginBase;

// /**
//  * Base class for Tag cloud plugins.
//  */
// abstract class TagCloudBase extends PluginBase implements TagCloudInterface {


//   /**
//    * {@inheritdoc}
//    */
//   public function build($tags) {
//     $template = $this->getTemplatePath();
//     $build = [
//       '#type' => 'inline_template',
//       '#template' => \Drupal::service('twig')
//         ->loadTemplate($template)
//         ->render(['tags' => $tags])
//     ];
//     foreach ($this->getPluginDefinition()['libraries'] as $library) {
//       $build['#attached']['library'][] = $library;
//     }

//     return $build;
//   }

//   /**
//    * Method to return tag cloud style template file path.
//    *
//    * @return string
//    *   Template file path.
//    */
//   protected function getTemplatePath() {
//     $template = $this->getPluginDefinition()['template'];

//     return drupal_get_path(
//         $template['type'],
//         $template['name']
//       ) . '/' . $template['directory'] . '/' . $template['file'] . '.html.twig';
//   }

// }
