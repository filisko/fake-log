<?php

declare(strict_types=1);

namespace Filisko;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;
use ReflectionClass;

class FakeLogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var array<int, array{
     *     level: string,
     *     message: string,
     *     context: array<string, mixed>
     * }>
     */
    private $records = [];

    /**
     * {@inheritdoc}
     * @phpstan-ignore-next-line we can't use string|Stringable as it is introduced in 8.0
     */
    public function log($level, $message, array $context = []): void
    {
        if (!in_array($level, $this->logLevels())) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid level "%s". Valid levels are: %s',
                    $level,
                    implode(', ', $this->logLevels())
                )
            );
        }

        $this->records[] = [
            'level' => $level,
            'message' => $message,
            'context' => $context,
        ];
    }

    /**
     * @return string[]
     */
    private function logLevels(): array
    {
        return array_values((new ReflectionClass(LogLevel::class))->getConstants());
    }

    /**
     * @return array<int, array{
     *     level: string,
     *     message: string,
     *     context: array<string, mixed>
     * }>
     */
    public function logs(): array
    {
        return $this->records;
    }

    public function count(): int
    {
        return count($this->records);
    }

    public function clean(): void
    {
        $this->records = [];
    }
}
