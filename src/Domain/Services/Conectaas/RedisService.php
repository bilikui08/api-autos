<?php

namespace Domain\Services\Conectaas;

use Redis;
use RedisException;

class RedisService
{
    /**
     * @var Redis
     */
    private $client;

    /**
     * RedisService constructor.
     *
     * @param string $host
     * @param int $port
     * @param float $timeout
     * @throws RedisException
     */
    public function __construct(string $host = '127.0.0.1', int $port = 6379, float $timeout = 0.0)
    {
        $this->client = new Redis();
        $this->client->connect($host, $port, $timeout);
    }

    /**
     * Set a value in Redis.
     *
     * @param string $key
     * @param mixed $value
     * @param int $ttl Time to live in seconds (optional)
     * @return bool
     */
    public function set(string $key, $value, int $ttl = 0): bool
    {
        if ($ttl > 0) {
            return $this->client->setex($key, $ttl, serialize($value));
        }
        return $this->client->set($key, serialize($value));
    }

    /**
     * Get a value from Redis.
     *
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        $value = $this->client->get($key);
        return $value !== false ? unserialize($value) : null;
    }

    /**
     * Delete a key from Redis.
     *
     * @param string $key
     * @return bool
     */
    public function delete(string $key): bool
    {
        return $this->client->del($key) > 0;
    }

    /**
     * Check if a key exists in Redis.
     *
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool
    {
        return $this->client->exists($key) > 0;
    }

    /**
     * Close the Redis connection.
     */
    public function close(): void
    {
        $this->client->close();
    }
}