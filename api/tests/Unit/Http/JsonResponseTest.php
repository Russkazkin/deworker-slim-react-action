<?php

use App\Http\JsonResponse;
use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testWithCode(): void
    {
        $response = new JsonResponse(0, 201);

        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals('0', $response->getBody()->getContents());
        self::assertEquals(201, $response->getStatusCode());
    }

    public function testNull(): void
    {
        $response = new JsonResponse(null);

        self::assertEquals('null', $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @throws JsonException
     */
    public function testInt(): void
    {
        $response = new JsonResponse(12);

        self::assertEquals('12', $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }

    public function testString(): void
    {
        $response = new JsonResponse('12');

        self::assertEquals('"12"', $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @throws JsonException
     */
    public function testObject(): void
    {
        $object = new stdClass();
        $object->str = 'value';
        $object->int = 1;
        $object->none = null;

        $response = new JsonResponse($object);

        self::assertEquals('{"str":"value","int":1,"none":null}', $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }

    /**
     * @throws JsonException
     */
    public function testArray(): void
    {
        $array = ['str' => 'value', 'int' => 1, 'none' => null];

        $response = new JsonResponse($array);

        self::assertEquals('{"str":"value","int":1,"none":null}', $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
    }
}
