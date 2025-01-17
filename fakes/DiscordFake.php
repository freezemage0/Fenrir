<?php

declare(strict_types=1);

namespace Fakes\Ragnarok\Fenrir;

use Ragnarok\Fenrir\Discord;
use Mockery;
use Mockery\Mock;

class DiscordFake
{
    public static function get(): Mock|Discord
    {
        $discord = Mockery::mock(Discord::class);

        $discord->rest = RestFake::get();
        $discord->gateway = GatewayFake::get();
        $discord->interaction = InteractionHandlerFake::get();

        return $discord;
    }
}
