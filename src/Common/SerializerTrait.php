<?php

namespace App\Common;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Service\Attribute\Required;

trait SerializerTrait
{
    private SerializerInterface $serializer;

    #[Required]
    public function setSerializer(SerializerInterface $serializer): void
    {
        $this->serializer = $serializer;
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
