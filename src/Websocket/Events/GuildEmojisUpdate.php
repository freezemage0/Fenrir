<?php

namespace Exan\Dhp\Websocket\Events;

/**
 * @see https://discord.com/developers/docs/topics/gateway-events#guild-emojis-update
 */
class GuildEmojisUpdate
{
    public string $guild_id;
    public array $emojis; // @TODO
}