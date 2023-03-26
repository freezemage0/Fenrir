<?php

declare(strict_types=1);

namespace Tests\Exan\Fenrir;

use Exan\Fenrir\DataMapper;
use Exan\Fenrir\Enums\Parts\ApplicationCommandOptionTypes;
use Exan\Fenrir\Parts\ApplicationCommandInteractionDataOptionStructure;
use Exan\Fenrir\Parts\InteractionData;
use Exan\Fenrir\Parts\Message;
use Exan\Fenrir\Websocket\Events\InteractionCreate;
use Monolog\Test\TestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class DataMapperTest extends TestCase
{
    private function getDataMapper(?LoggerInterface $logger = new NullLogger()): DataMapper
    {
        return new DataMapper(
            $logger
        );
    }

    public function testItMapsDataFromObject()
    {
        $data = (object) [
            'id' => '::id::',
            'channel_id' => '::channel id::',
            'tts' => true,
            'position' => 20,
        ];

        /** @var Message */
        $output = $this->getDataMapper()->map($data, Message::class);

        $this->assertInstanceOf(Message::class, $output);
        $this->assertEquals('::id::', $output->id);
        $this->assertEquals('::channel id::', $output->channel_id);
    }

    public function testItMapsDataFromArray()
    {
        $data = [
            'id' => '::id::',
            'channel_id' => '::channel id::',
            'tts' => true,
            'position' => 20,
        ];

        /** @var Message */
        $output = $this->getDataMapper()->map($data, Message::class);

        $this->assertInstanceOf(Message::class, $output);
        $this->assertEquals('::id::', $output->id);
        $this->assertEquals('::channel id::', $output->channel_id);
    }

    public function testItJugglesDataTypes()
    {
        $data = [
            'id' => 123,
            'tts' => 0,
            'pinned' => 1,
        ];

        /** @var Message */
        $output = $this->getDataMapper()->map($data, Message::class);

        $this->assertInstanceOf(Message::class, $output);
        $this->assertEquals('123', $output->id);
        $this->assertTrue($output->pinned);
        $this->assertFalse($output->tts);
    }

    public function testItDoesNotFailOnImpossibleJuggles()
    {
        $data = [
            'reactions' => 'this is supposed to be an array',
            'position' => 'ten'
        ];

        /** @var Message */
        $output = $this->getDataMapper()->map($data, Message::class);

        // No values should be filled, but type should match
        $this->assertInstanceOf(Message::class, $output);
        $this->assertEquals(new Message(), $output);
    }

    public function testItMapsRecursively()
    {
        $data = [
            'id' => '::interaction id::',
            'data' => [
                'id' => '::interaction data id::',
            ],
        ];

        /** @var InteractionCreate */
        $output = $this->getDataMapper()->map($data, InteractionCreate::class);

        $this->assertInstanceOf(InteractionCreate::class, $output);
        $this->assertEquals('::interaction id::', $output->id);

        $this->assertInstanceOf(InteractionData::class, $output->data);
        $this->assertEquals('::interaction data id::', $output->data->id);
    }

    public function testItMapsArrays()
    {
        $data = [
            'id' => '::interaction id::',
            'token' => '::token::',
            'application_id' => '::application id::',
            'data' => [
                'options' => [
                    [
                        'name' => '::option name:: 0',
                    ],
                    [
                        'name' => '::option name:: 1',
                    ],
                    [
                        'name' => '::option name:: 2',
                    ]
                ],
            ],
        ];

        /** @var InteractionCreate */
        $output = $this->getDataMapper()->map($data, InteractionCreate::class);

        $this->assertInstanceOf(InteractionCreate::class, $output);

        $this->assertInstanceOf(InteractionData::class, $output->data);

        $this->assertCount(3, $output->data->options);
        foreach ($output->data->options as $key => $value) {
            $this->assertInstanceOf(ApplicationCommandInteractionDataOptionStructure::class, $value);
            $this->assertEquals('::option name:: ' . $key, $value->name);
        }
    }

    public function testItUsesSettersWhenAvailable()
    {
        $data = [
            'type' => ApplicationCommandOptionTypes::INTEGER->value
        ];

        /** @var ApplicationCommandInteractionDataOptionStructure */
        $output = $this->getDataMapper()->map($data, ApplicationCommandInteractionDataOptionStructure::class);

        $this->assertInstanceOf(ApplicationCommandInteractionDataOptionStructure::class, $output);
        $this->assertInstanceOf(ApplicationCommandOptionTypes::class, $output->type);
        $this->assertEquals(ApplicationCommandOptionTypes::INTEGER, $output->type);
    }
}