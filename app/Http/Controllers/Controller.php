<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\TransformerAbstract;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function itemResponse($data, TransformerAbstract $transformer): JsonResponse
    {
        return $this->respond(new Item($data, $transformer));
    }

    protected function collectionResponse($data, TransformerAbstract $transformer): JsonResponse
    {
        return $this->respond(new Collection($data, $transformer));
    }

    private function respond(ResourceInterface $resource): JsonResponse
    {
        $manager = new Manager();
        $manager->setSerializer(new ArraySerializer());

        return response()->json($manager->createData($resource)->toArray());
    }

    protected function emptyResponse(): JsonResponse
    {
        return response()->json([], 204);
    }
}
