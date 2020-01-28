<?php

namespace App\Models;

use DateTimeInterface;

class Advertisement
{
    private $id;
    private $userId;
    private $categoryId;
    private $text;
    private $createdAt;
    private $updatedAt;
    private $acceptedAt;

    public function __construct(
        int $id,
        int $userId,
        int $categoryId,
        string $text,
        DateTimeInterface $createdAt,
        DateTimeInterface $updatedAt,
        ?DateTimeInterface $acceptedAt
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        $this->text = $text;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->acceptedAt = $acceptedAt;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function categoryId(): int
    {
        return $this->categoryId;
    }

    public function text(): string
    {
        return $this->text;
    }

    public function createdAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function acceptedAt(): ?DateTimeInterface
    {
        return $this->acceptedAt;
    }
}