<?php
/**
 * Contact Form Templates plugin for Craft CMS 3.x
 *
 * Custom email templates for the Craft CMS Contact Form plugin
 *
 * @link      https://github.com/lukeyouell
 * @copyright Copyright (c) 2018 Luke Youell
 */

namespace lukeyouell\contactformtemplates;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

use \craft\contactform\Mailer;
use \craft\contactform\events\SendEvent;

/**
 * Class ContactFormTemplates
 *
 * @author    Luke Youell
 * @package   ContactFormTemplates
 * @since     1.0.0
 *
 */
class ContactFormTemplates extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ContactFormTemplates
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(Mailer::class, Mailer::EVENT_BEFORE_SEND, function(SendEvent $e) {
            $submission = $e->submission;

            // Prep values
            $template = isset($submission['message']['template']) ? Craft::$app->security->validateData($submission['message']['template']) : null;

            if ($template)
            {
                // Render the set template
                $html = Craft::$app->view->renderTemplate(
                    '_emails/' . $template,
                    ['submission' => $submission]
                );

                // Update the message body
                $e->message->setHtmlBody($html);
            }
        });
    }

    // Protected Methods
    // =========================================================================

}
