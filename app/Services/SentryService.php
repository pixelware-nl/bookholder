<?php

namespace App\Services;

use Sentry\Severity;

use function Sentry\captureException;
use function Sentry\captureMessage;

class SentryService
{
    public function log(\Throwable|string $value, ?Severity $severity = null): void
    {
        if (app()->bound('sentry') == false) {
            return;
        }

        if (is_string($value)) {
            captureMessage($value, $severity);

            return;
        }

        captureException($value);
    }
}
