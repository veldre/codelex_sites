<?php

namespace Core\Managers\ErrorManager;

interface ErrorManagerInterface
{
    public function add(string $key, string $message): void;

    public function has(string $key): bool;

    public function get(string $key): string;

    public function clear(): void;

    public function any(): bool;
}