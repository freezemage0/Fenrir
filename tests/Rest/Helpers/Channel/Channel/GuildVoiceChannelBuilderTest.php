<?php

namespace Tests\Exan\Dhp\Rest\Helpers\Channel\Channel\Shared;

use Exan\Dhp\Enums\Parts\ChannelType;
use Exan\Dhp\Enums\Parts\VideoQualityMode;
use Exan\Dhp\Rest\Helpers\Channel\Channel\GuildVoiceChannelBuilder;
use PHPUnit\Framework\TestCase;

class GuildVoiceChannelBuilderTest extends TestCase
{
    public function testConstructorSetsCorrectType()
    {
        $channelBuilder = new GuildVoiceChannelBuilder();

        $this->assertEquals([
            'type' => ChannelType::GUILD_VOICE->value
        ], $channelBuilder->get());
    }

    public function testSetUserLimit()
    {
        $channelBuilder = new GuildVoiceChannelBuilder();

        $channelBuilder->setUserLimit(50);

        $this->assertEquals(50, $channelBuilder->get()['user_limit']);

        $channelBuilder->setUserLimit(-1);

        $this->assertEquals(0, $channelBuilder->get()['user_limit']);

        $channelBuilder->setUserLimit(101);

        $this->assertEquals(100, $channelBuilder->get()['user_limit']);
    }

    public function testSetVideoQualityMode()
    {
        $channelBuilder = new GuildVoiceChannelBuilder();

        $channelBuilder->setVideoQualityMode(VideoQualityMode::AUTO);

        $this->assertEquals(VideoQualityMode::AUTO->value, $channelBuilder->get()['video_quality_mode']);
    }
}