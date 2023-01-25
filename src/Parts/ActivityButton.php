<?php

declare(strict_types=1);

namespace Exan\Dhp\Parts;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#activity-object-activity-buttons
 */
class ActivityButton
{
    public string $label;
    public string $url;
}