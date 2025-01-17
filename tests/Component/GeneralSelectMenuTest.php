<?php

declare(strict_types=1);

namespace Tests\Ragnarok\Fenrir\Component;

use PHPUnit\Framework\TestCase;
use Ragnarok\Fenrir\Component\SelectMenu\MentionableSelectMenu;
use Ragnarok\Fenrir\Component\SelectMenu\RoleSelectMenu;
use Ragnarok\Fenrir\Component\SelectMenu\UserSelectMenu;
use Ragnarok\Fenrir\Enums\SelectMenuType;

class GeneralSelectMenuTest extends TestCase
{
    /**
     * @dataProvider convertionExpectationProvider
     */
    public function testCorrectlyConverted(array $args, array $expected): void
    {
        $selectTypes = [
            MentionableSelectMenu::class => SelectMenuType::Mentionable,
            RoleSelectMenu::class => SelectMenuType::Role,
            UserSelectMenu::class => SelectMenuType::User,
        ];

        foreach ($selectTypes as $selectClass => $selectType) {
            $expected['type'] = $selectType;

            $select = new $selectClass(...$args);

            $this->assertEquals($expected, $select->get());
        }
    }

    public function convertionExpectationProvider(): array
    {
        return [
            'Completely filled out' => [
                'args' => [
                    '::custom id::',
                    '::placeholder::',
                    5,
                    10,
                    true
                ],
                'expected' => [
                    'custom_id' => '::custom id::',
                    'placeholder' => '::placeholder::',
                    'min_values' => 5,
                    'max_values' => 10,
                    'disabled' => true,
                ],
            ],
            'Missing placeholder' => [
                'args' => [
                    '::custom id::',
                    null,
                    5,
                    10,
                    true
                ],
                'expected' => [
                    'custom_id' => '::custom id::',
                    'min_values' => 5,
                    'max_values' => 10,
                    'disabled' => true,
                ],
            ],
            'Missing min values' => [
                'args' => [
                    '::custom id::',
                    '::placeholder::',
                    null,
                    10,
                    true
                ],
                'expected' => [
                    'custom_id' => '::custom id::',
                    'placeholder' => '::placeholder::',
                    'min_values' => 1,
                    'max_values' => 10,
                    'disabled' => true,
                ],
            ],
            'Missing max values' => [
                'args' => [
                    '::custom id::',
                    '::placeholder::',
                    5,
                    null,
                    true
                ],
                'expected' => [
                    'custom_id' => '::custom id::',
                    'placeholder' => '::placeholder::',
                    'min_values' => 5,
                    'max_values' => 25,
                    'disabled' => true,
                ],
            ],
            'Missing disabled' => [
                'args' => [
                    '::custom id::',
                    '::placeholder::',
                    5,
                    10,
                ],
                'expected' => [
                    'custom_id' => '::custom id::',
                    'placeholder' => '::placeholder::',
                    'min_values' => 5,
                    'max_values' => 10,
                    'disabled' => false,
                ],
            ],
        ];
    }
}
