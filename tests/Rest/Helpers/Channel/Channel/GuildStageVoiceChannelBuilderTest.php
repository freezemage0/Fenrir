<?php

declare(strict_types=1);

namespace Tests\Ragnarok\Fenrir\Rest\Helpers\Channel\Channel;

use Ragnarok\Fenrir\Enums\Parts\ChannelTypes;
use Ragnarok\Fenrir\Rest\Helpers\Channel\Channel\GuildStageVoiceChannelBuilder;
use PHPUnit\Framework\TestCase;

class GuildStageVoiceChannelBuilderTest extends TestCase
{
    public function testConstructorSetsCorrectType(): void
    {
        $channelBuilder = new GuildStageVoiceChannelBuilder();

        $this->assertEquals([
            'type' => ChannelTypes::GUILD_STAGE_VOICE->value
        ], $channelBuilder->get());
    }
}
