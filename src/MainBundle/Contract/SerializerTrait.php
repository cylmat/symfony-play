<?php

namespace App\MainBundle\Contract;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;

trait SerializerTrait
{
    public function deserialize(array $data, string $type, array $context = []): object
    {
        if ($this->container->has('serializer')) {
            $serializer = $this->container->get('serializer');
            /** @var Serializer $serializer */
            $object = $serializer->deserialize(json_encode($data), $type, 'json', $context);
        }

        return $object;
    }

    private function createJsonResponse(mixed $data, int $status = JsonResponse::HTTP_OK, array $context = [], array $headers = []): JsonResponse
    {
        $json = $this->serializer->serialize($data, 'json', $context);

        return new JsonResponse($json, $status, $headers, true);
    }

    private function create400Response(mixed $data, array $context = [], array $headers = []): JsonResponse
    {
        return $this->createJsonResponse($data, JsonResponse::HTTP_BAD_REQUEST, $context, $headers);
    }

    private function create404Response(mixed $data, array $context = [], array $headers = []): JsonResponse
    {
        return $this->createJsonResponse($data, JsonResponse::HTTP_NOT_FOUND, $context, $headers);
    }
}
