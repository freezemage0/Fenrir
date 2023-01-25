<?php

declare(strict_types=1);

use Exan\Dhp\Parts\Channel as PartsChannel;
use Exan\Dhp\Parts\Emoji;
use Exan\Dhp\Parts\Message;
use Exan\Dhp\Parts\User;
use Exan\Dhp\Rest\Channel;
use Exan\Dhp\Rest\Helpers\MessageBuilder;
use Tests\Exan\Dhp\Rest\HttpHelperTestCase;

class ChannelTest extends HttpHelperTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->httpItem = new Channel($this->http, $this->jsonMapper);
    }

    public function httpBindingsProvider(): array
    {
        return [
            'Get channel' => [
                'method' => 'get',
                'args' => ['::channel id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => PartsChannel::class,
                ]
            ],
            /**
             * @todo modify
             */
            'Delete channel' => [
                'method' => 'delete',
                'args' => ['::channel id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => PartsChannel::class,
                ]
            ],
            'Get messages' => [
                'method' => 'getMessages',
                'args' => ['::channel id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) [], (object) [], (object) []],
                ],
                'validationOptions' => [
                    'returnType' => Message::class,
                    'array' => true,
                ]
            ],
            'Get message' => [
                'method' => 'getMessage',
                'args' => ['::channel id::', '::message id::'],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Message::class,
                ]
            ],
            'Create message' => [
                'method' => 'createMessage',
                'args' => ['::channel id::', new MessageBuilder()],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Message::class,
                ]
            ],
            'Create message with file' => [
                'method' => 'createMessage',
                'args' => ['::channel id::', (new MessageBuilder())->addFile('something.png', '::data::')],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => (object) [],
                ],
                'validationOptions' => [
                    'returnType' => Message::class,
                ]
            ],
            /**
             * @todo crosspostMessage
             */
            'Create reaction' => [
                'method' => 'createReaction',
                'args' => ['::channel id::', '::message id::', Emoji::get('::id::')],
                'mockOptions' => [
                    'method' => 'put',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'Delete own reaction' => [
                'method' => 'deleteOwnReaction',
                'args' => ['::channel id::', '::message id::', Emoji::get('::id::')],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'Delete user reaction' => [
                'method' => 'deleteUserReaction',
                'args' => ['::channel id::', '::message id::', Emoji::get('::id::'), '::user id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'Get reactions' => [
                'method' => 'getReactions',
                'args' => ['::channel id::', '::message id::', Emoji::get('::id::')],
                'mockOptions' => [
                    'method' => 'get',
                    'return' => [(object) [], (object) [], (object) []],
                ],
                'validationOptions' => [
                    'returnType' => User::class,
                    'array' => true,
                ]
            ],
            'Delete all reactions' => [
                'method' => 'deleteAllReactions',
                'args' => ['::channel id::', '::message id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'Delete all reactions for emoji' => [
                'method' => 'deleteAllReactions',
                'args' => ['::channel id::', '::message id::', Emoji::get('::id::')],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            /**
             * @todo editMessage
             */
            'Bulk delete messages' => [
                'method' => 'bulkDeleteMessages',
                'args' => ['::channel id::', ['::message id::'], Emoji::get('::id::')],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            /**
             * @todo editChannelPermissions
             * @todo getChannelInvites
             * @todo createChannelInvite
             */
            'Delete channel permissions' => [
                'method' => 'deleteChannelPermissions',
                'args' => ['::channel id::', '::overwrite id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            /**
             * @todo followAnnouncementChannel
             */
            'Trigger typing indicator' => [
                'method' => 'triggerTypingIndicator',
                'args' => ['::channel id::'],
                'mockOptions' => [
                    'method' => 'post',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            /**
             * @todo getPinnedMessages
             */
            'Pin message' => [
                'method' => 'pinMessage',
                'args' => ['::channel id::', '::message id::'],
                'mockOptions' => [
                    'method' => 'put',
                    'return' => null,
                ],
                'validationOptions' => [],
            ],
            'Unpin message' => [
                'method' => 'unpinMessage',
                'args' => ['::channel id::', '::message id::'],
                'mockOptions' => [
                    'method' => 'delete',
                    'return' => null,
                ],
                'validationOptions' => [],
            ]
        ];
    }
}