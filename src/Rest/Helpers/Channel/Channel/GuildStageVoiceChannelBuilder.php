<?php

namespace Exan\Dhp\Rest\Helpers\Channel\Channel;

use Exan\Dhp\Enums\Parts\ChannelType;
use Exan\Dhp\Rest\Helpers\Channel\Channel\Shared\SetBitrate;
use Exan\Dhp\Rest\Helpers\Channel\Channel\Shared\SetRtcRegion;

/**
 * @see https://discord.com/developers/docs/resources/channel#modify-channel
 */
class GuildStageVoiceChannelBuilder extends ChannelBuilder
{
    use SetBitrate;
    use SetRtcRegion;

    public function __construct()
    {
        $this->setChannelType(ChannelType::GUILD_STAGE_VOICE);
    }
}