<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

abstract class Controller
{
    protected function logActivity(string $action, ?string $targetType = null, ?int $targetId = null, ?string $description = null): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'target_type' => $targetType,
            'target_id' => $targetId,
            'description' => $description,
        ]);
    }
}
