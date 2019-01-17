<?php
namespace tinydots\cpeditsegment\controllers;

use Craft;
use craft\base\ElementInterface;
use craft\web\Controller;
use yii\web\HttpException;

class CpEditSegmentController extends Controller
{
    public $allowAnonymous = true;

    /**
     * @param string $elementUri
     * @throws HttpException
     */
    public function actionRedirect(string $elementUri)
    {
        /** @var ElementInterface $element */
        $element = Craft::$app->getElements()->getElementByUri($elementUri);

        if (!$element || !$element->getCpEditUrl() || !$element->getIsEditable()) {
            throw new HttpException(404);
        }

        return $this->redirect($element->getCpEditUrl())->send();
    }
}