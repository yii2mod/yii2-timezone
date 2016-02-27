<?php

namespace yii2mod\timezone;

use DateTimeZone;
use Yii;
use yii\base\Action;

/**
 * Class TimezoneAction
 * @package yii2mod\timezone
 */
class TimezoneAction extends Action
{
    /**
     * @throws \yii\base\ExitException
     */
    public function run()
    {
        $timezone = Yii::$app->getRequest()->post('timezone', false);
        $zoneList = DateTimeZone::listIdentifiers();

        if (empty($timezone) || !in_array($timezone, $zoneList)) {
            $timezoneAbbr = Yii::$app->getRequest()->post('timezoneAbbr');
            $timezoneOffset = Yii::$app->getRequest()->post('timezoneOffset');
            $timezone = timezone_name_from_abbr($timezoneAbbr, $timezoneOffset * 3600);
        }

        if (!$timezone || !in_array($timezone, $zoneList)) {
            $timezone = date_default_timezone_get();
        }

        Yii::$app->session->set('timezone', $timezone);
        Yii::$app->end();
    }
}