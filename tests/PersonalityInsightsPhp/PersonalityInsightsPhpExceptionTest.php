<?php

namespace DarrynTen\PersonalityInsightsPhp\Tests\PersonalityInsightsPhp;

use DarrynTen\PersonalityInsightsPhp\CustomException;
use DarrynTen\PersonalityInsightsPhp\PersonalityInsights;
use PHPUnit_Framework_TestCase;

class PersonalityInsightsPhpExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testApiException()
    {
        $this->expectException(CustomException::class);

        new PersonalityInsights([], 'xxx');
    }

    public function testApiJsonException()
    {
        $this->expectException(CustomException::class);

        throw new CustomException(
            json_encode(
                [
                    'errors' => [
                        'code' => 1,
                    ],
                    'status' => 404,
                    'title' => 'Not Found',
                    'detail' => 'Details',
                ]
            )
        );
    }

    public function testCheapskateTriggerException()
    {
        $this->expectException(CustomException::class);

        $config = [
            'projectId' => 'project-id',
        ];

        $instance = new PersonalityInsights($config);

        $instance->setCheapskate(true);
        $instance->setText(str_repeat('test ', 1000));
    }
}