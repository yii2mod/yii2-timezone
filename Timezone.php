<?php

namespace yii2mod\timezone;

use Yii;
use yii\base\Component;
use yii\web\Controller;

/**
 * Class Timezone
 * @package yii2mod\timezone
 */
class Timezone extends Component
{
    /**
     * @var string
     */
    public $actionRoute = '/site/timezone';

    /**
     * @var timezone name (ex: Europe/Kiev)
     */
    public $name;

    /**
     * Registering offset-getter if timezone is not set
     */
    public function init()
    {
        $this->actionRoute = Url::toRoute($this->actionRoute);
        $this->name = Yii::$app->session->get('timezone');
        if ($this->name == null) {
            $this->registerTimezoneScript($this->actionRoute);
            $this->name = date_default_timezone_get();
        }
        Yii::$app->setTimeZone($this->name);
    }

    /**
     * Registering script for timezone detection on before action event
     * @param $actionRoute
     */
    public function registerTimezoneScript($actionRoute)
    {
        Yii::$app->on(Controller::EVENT_BEFORE_ACTION, function ($event) use ($actionRoute) {
            $view = $event->sender->view;
            $js = <<<JS
                var timezone = '';
                var timezoneAbbr = '';
                try {
                    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                    var timezoneAbbr = /\((.*)\)/.exec(new Date().toString())[1];
                }
                catch(err) {
                    console.log(err);
                }
                $.post("$actionRoute", {
                    timezone: timezone,
                    timezoneAbbr: timezoneAbbr,
                    timezoneOffset: -new Date().getTimezoneOffset() / 60
                });
JS;
            $view->registerJs($js);
        });
    }
}
