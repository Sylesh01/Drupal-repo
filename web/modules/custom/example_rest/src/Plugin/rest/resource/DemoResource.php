<?php

namespace Drupal\example_rest\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "demo_resource",
 *   label = @Translation("Demo Resource"),
 *   uri_paths = {
 *     "canonical" = "/demo_rest_api/demo_resource"
 *   }
 * )
 */
class DemoResource extends ResourceBase {

  /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */
  public function get() {
    $data = ['message'=>'hello'];    
    return new ResourceResponse($data);
  }
}