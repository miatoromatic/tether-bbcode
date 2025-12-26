<?php

namespace Miatoro\Tether\Admin\Controller;

use XF\Admin\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class Tether extends AbstractController
{
    /**
     * List all tethers
     *
     * @return \XF\Mvc\Reply\View
     */
    public function actionIndex()
    {
        /** @var \Miatoro\Tether\Repository\Tether $tetherRepo */
        $tetherRepo = $this->repository('Miatoro\Tether:Tether');

        $tethers = $tetherRepo->findTethersForList()->fetch();

        $viewParams = [
            'tethers' => $tethers
        ];

        return $this->view('Miatoro\Tether:Tether\List', 'miatoro_tether_list', $viewParams);
    }

    /**
     * Add a new tether (form)
     *
     * @return \XF\Mvc\Reply\View
     */
    public function actionAdd()
    {
        /** @var \Miatoro\Tether\Entity\Tether $tether */
        $tether = $this->em()->create('Miatoro\Tether:Tether');

        return $this->tetherAddEdit($tether);
    }

    /**
     * Edit a tether (form)
     *
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\View
     */
    public function actionEdit(ParameterBag $params)
    {
        $tether = $this->assertTetherExists($params->tether_id);

        return $this->tetherAddEdit($tether);
    }

    /**
     * Common form for add/edit
     *
     * @param \Miatoro\Tether\Entity\Tether $tether
     * @return \XF\Mvc\Reply\View
     */
    protected function tetherAddEdit(\Miatoro\Tether\Entity\Tether $tether)
    {
        /** @var \Miatoro\Tether\Repository\Tether $tetherRepo */
        $tetherRepo = $this->repository('Miatoro\Tether:Tether');

        $viewParams = [
            'tether' => $tether,
            'categories' => $tetherRepo->getCategoryList()
        ];

        return $this->view('Miatoro\Tether:Tether\Edit', 'miatoro_tether_edit', $viewParams);
    }

    /**
     * Save a tether (add or edit)
     *
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\Redirect
     */
    public function actionSave(ParameterBag $params)
    {
        $this->assertPostOnly();

        if ($params->tether_id)
        {
            $tether = $this->assertTetherExists($params->tether_id);
        }
        else
        {
            $tether = $this->em()->create('Miatoro\Tether:Tether');
        }

        $this->tetherSaveProcess($tether)->run();

        return $this->redirect($this->buildLink('tethers') . $this->buildLinkHash($tether->tether_id));
    }

    /**
     * Delete a tether (confirmation form)
     *
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\View|\XF\Mvc\Reply\Redirect
     */
    public function actionDelete(ParameterBag $params)
    {
        $tether = $this->assertTetherExists($params->tether_id);

        if ($this->isPost())
        {
            $tether->delete();

            return $this->redirect($this->buildLink('tethers'));
        }
        else
        {
            $viewParams = [
                'tether' => $tether
            ];

            return $this->view('Miatoro\Tether:Tether\Delete', 'miatoro_tether_delete', $viewParams);
        }
    }

    /**
     * Process form input for saving
     *
     * @param \Miatoro\Tether\Entity\Tether $tether
     * @return \XF\Mvc\FormAction
     */
    protected function tetherSaveProcess(\Miatoro\Tether\Entity\Tether $tether)
    {
        $form = $this->formAction();

        $input = $this->filter([
            'identifier' => 'str',
            'title' => 'str',
            'category' => 'str',
            'tags' => 'str',
            'wiki_url' => 'str',
            'image_path' => 'str',
            'description' => 'str',
            'negative_1' => 'str',
            'negative_2' => 'str',
            'negative_3' => 'str',
            'negative_4' => 'str',
            'negative_5' => 'str',
            'negative_6' => 'str',
            'negative_7' => 'str',
            'positive_1' => 'str',
            'positive_2' => 'str',
            'positive_3' => 'str',
            'positive_4' => 'str',
            'positive_5' => 'str',
            'positive_6' => 'str',
            'positive_7' => 'str'
        ]);

        $form->basicEntitySave($tether, $input);

        return $form;
    }

    /**
     * Assert that a tether exists by ID
     *
     * @param int $id
     * @param array $with
     * @param string|null $phraseKey
     * @return \Miatoro\Tether\Entity\Tether
     */
    protected function assertTetherExists($id, $with = [], $phraseKey = null)
    {
        return $this->assertRecordExists('Miatoro\Tether:Tether', $id, $with, $phraseKey);
    }
}
