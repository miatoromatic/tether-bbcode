<?php

namespace Miatoro\Tether\Pub\Controller;

use XF\Pub\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class Tether extends AbstractController
{
    /**
     * View tether details (popup)
     *
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\View
     */
    public function actionView(ParameterBag $params)
    {
        $identifier = $this->filter('identifier', 'str');
        $positiveValue = $this->filter('positive', 'uint');
        $negativeValue = $this->filter('negative', 'uint');

        /** @var \Miatoro\Tether\Repository\Tether $tetherRepo */
        $tetherRepo = $this->repository('Miatoro\Tether:Tether');
        $tether = $tetherRepo->getTetherByIdentifier($identifier);

        if (!$tether)
        {
            return $this->error(\XF::phrase('requested_tether_not_found'));
        }

        $viewParams = [
            'tether' => $tether,
            'positiveValue' => $positiveValue,
            'negativeValue' => $negativeValue
        ];

        return $this->view('Miatoro\Tether:Tether\View', 'miatoro_tether_popup', $viewParams);
    }
}
