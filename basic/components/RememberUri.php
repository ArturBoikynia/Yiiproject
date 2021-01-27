<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
class RememberUri extends Component
{
    public static string $uri = 'none';

    /**
     * @param string $uri
     */
    public static function setUri(string $uri): void
    {
        self::$uri = $uri;
    }

    /**
     * @return string
     */
    public static function getUri(): string
    {
        return self::$uri;
    }


}