<?php

declare(strict_types=1);

namespace Exan\Fenrir\Rest\Helpers\AuditLog;

use Exan\Fenrir\Const\Validation\ItemLimit;

class GetGuildAuditLogsBuilder
{
    private $data = [];

    public function setUserId(string $userId): GetGuildAuditLogsBuilder
    {
        $this->data['user_id'] = $userId;

        return $this;
    }

    public function getUserId(): ?string
    {
        return isset($this->data['user_id']) ? $this->data['user_id'] : null;
    }

    public function setActionType(int $actionType): GetGuildAuditLogsBuilder
    {
        $this->data['action_type'] = $actionType;

        return $this;
    }

    public function getActionType(): ?int
    {
        return isset($this->data['action_type']) ? $this->data['action_type'] : null;
    }

    public function setBefore(string $before): GetGuildAuditLogsBuilder
    {
        $this->data['before'] = $before;

        return $this;
    }

    public function getBefore(): ?string
    {
        return isset($this->data['before']) ? $this->data['before'] : null;
    }

    public function setAfter(string $after): GetGuildAuditLogsBuilder
    {
        $this->data['after'] = $after;

        return $this;
    }

    public function getAfter(): ?string
    {
        return isset($this->data['after']) ? $this->data['after'] : null;
    }

    public function setLimit(int $limit): GetGuildAuditLogsBuilder
    {
        $this->data['limit'] = ItemLimit::withinLimit($limit);

        return $this;
    }

    public function getLimit(): ?int
    {
        return isset($this->data['limit']) ? $this->data['limit'] : null;
    }

    public function get(): array
    {
        return $this->data;
    }
}
