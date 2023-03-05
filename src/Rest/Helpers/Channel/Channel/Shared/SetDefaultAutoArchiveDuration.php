<?php

declare(strict_types=1);

namespace Exan\Fenrir\Rest\Helpers\Channel\Channel\Shared;

trait SetDefaultAutoArchiveDuration
{
    public function setDefaultAutoArchiveDuration(int $minutes): self
    {
        $this->data['default_auto_archive_duration'] = $minutes;

        return $this;
    }

    public function getDefaultAutoArchiveDuration(): ?int
    {
        return isset($this->data['default_auto_archive_duration'])
            ? $this->data['default_auto_archive_duration']
            : null;
    }
}
