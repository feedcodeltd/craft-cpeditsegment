<?php
namespace tinydots\cpeditsegment\controllers;

use craft\base\ElementInterface;
use craft\web\Controller;
use yii\web\HttpException;

/**
 * Class CpEditSegmentController
 * @package tinydots\cpeditsegment\controllers
 */
class CpEditSegmentController extends Controller
{
    /**
     * @param string|null $elementUri
     * @throws HttpException
     */
    public function actionRedirect(string $elementUri = null)
    {
        /** @var ElementInterface|null $element */
        $element = \Craft::$app->getElements()->getElementByUri($elementUri ?: '__home__');

        if (!$element || !$element->getCpEditUrl() || !$element->getIsEditable()) {
            throw new HttpException(404);
        }

        $this->redirect($element->getCpEditUrl())->send();
    }
}