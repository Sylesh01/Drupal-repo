<?php

namespace Drupal\example_module\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Serialization\Yaml;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ExampleController.
 *
 * @package Drupal\example_module\Controller
 */
class ExampleController extends ControllerBase {

  /**
   * The entity query factory service.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $entityQueryFactory;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a ExampleController object.
   *
   * @param \Drupal\Core\Entity\Query\QueryFactory $entity_query_factory
   *   The entity query factory service.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(QueryFactory $entity_query_factory, EntityTypeManagerInterface $entity_type_manager) {
    $this->entityQueryFactory = $entity_query_factory;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.query'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * Retrieves a list of items.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response containing a list of items.
   */
  public function index() {
    $entity_type = 'node';
    $query = $this->entityQueryFactory->get($entity_type);
    $nids = $query->execute();
    $entities = $this->entityTypeManager->getStorage($entity_type)->loadMultiple($nids);
    $items = [];
    foreach ($entities as $entity) {
      $items[] = [
        'id' => $entity->id(),
        'title' => $entity->label(),
        'body' => $entity->get('body')->value,
      ];
    }
    return new JsonResponse($items);
  }

  /**
   * Creates a new item.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The HTTP request.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response containing the new item.
   */
  public function createController(Request $request) {
    $entity_type = 'node';
    $data = Yaml::decode($request->getContent());
    $entity = $this->entityTypeManager->getStorage($entity_type)->create($data);
    $entity->save();
    return new JsonResponse($entity->toArray());
  }

  /**
   * Updates an existing item.
   *
   * @param int $id
   *   The ID of the item to update.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The HTTP request.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   A JSON response containing the updated item.
   */
  public function update($id, Request $request) {
    $entity_type = 'node';
    $data = Yaml::decode($request->getContent());
    $entity = $this->entityTypeManager->getStorage($entity_type)->load($id);
    if (!$entity) {
    return new JsonResponse(['error' => 'Item not found'], 404);
    }
    foreach ($data as $key => $value) {
    $entity->set($key, $value);
    }
    $entity->save();
    return new JsonResponse($entity->toArray());
    }
    
    /**
    
    *Deletes an item.
    *@param int $id
    *The ID of the item to delete.
    *@return \Symfony\Component\HttpFoundation\JsonResponse
    *A JSON response indicating success or failure.
    */
    public function delete($id) {
    $entity_type = 'node';
    $entity = $this->entityTypeManager->getStorage($entity_type)->load($id);
    if (!$entity) {
    return new JsonResponse(['error' => 'Item not found'], 404);
    }
    $entity->delete();
    return new JsonResponse(['status' => 'Item deleted']);
    }
    }
