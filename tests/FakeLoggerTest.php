<?php
declare(strict_types=1);

namespace Filisko\Tests;

use PHPUnit\Framework\TestCase;
use Filisko\FakeLogger;
use Psr\Log\LogLevel;

class FakeLoggerTest extends TestCase
{
    public function test_when_an_invalid_log_level_is_passed_an_exception_is_thrown(): void
    {
        $logger = new FakeLogger();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid level "wronk". Valid levels are: emergency, alert, critical, error, warning, notice, info, debug');

        $logger->log('wronk', 'Error');
    }

    public function test_log_levels_are_case_sensitive(): void
    {
        $logger = new FakeLogger();

        $this->expectException(\InvalidArgumentException::class);

        $logger->log('InFo', 'Error');
    }

    public function test_logs_are_recorded(): void
    {
        $logger = new FakeLogger();

        $logger->log(LogLevel::INFO, 'Something interesting happened', [
            'user_id' => 1
        ]);

        $this->assertSame([
            [
                'level' => 'info',
                'message' => 'Something interesting happened',
                'context' => [
                    'user_id' => 1,
                ],
            ]
        ], $logger->logs());
        $this->assertSame(1, $logger->count());

        $logger->clean();

        $this->assertSame(0, $logger->count());
    }
}
