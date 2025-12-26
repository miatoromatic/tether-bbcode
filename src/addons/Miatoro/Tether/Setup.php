<?php

namespace Miatoro\Tether;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    /**
     * Create the tether table
     */
    public function installStep1()
    {
        $this->schemaManager()->createTable('xf_miatoro_tether', function(Create $table)
        {
            $table->addColumn('tether_id', 'int')->autoIncrement();
            $table->addColumn('identifier', 'varchar', 100);
            $table->addColumn('title', 'varchar', 255);
            $table->addColumn('category', 'varchar', 50)->setDefault('');
            $table->addColumn('tags', 'text')->nullable();
            $table->addColumn('wiki_url', 'varchar', 500)->nullable();
            $table->addColumn('image_path', 'varchar', 500)->nullable();
            $table->addColumn('description', 'text')->nullable();
            $table->addColumn('negative_1', 'text')->nullable();
            $table->addColumn('negative_2', 'text')->nullable();
            $table->addColumn('negative_3', 'text')->nullable();
            $table->addColumn('negative_4', 'text')->nullable();
            $table->addColumn('negative_5', 'text')->nullable();
            $table->addColumn('negative_6', 'text')->nullable();
            $table->addColumn('negative_7', 'text')->nullable();
            $table->addColumn('positive_1', 'text')->nullable();
            $table->addColumn('positive_2', 'text')->nullable();
            $table->addColumn('positive_3', 'text')->nullable();
            $table->addColumn('positive_4', 'text')->nullable();
            $table->addColumn('positive_5', 'text')->nullable();
            $table->addColumn('positive_6', 'text')->nullable();
            $table->addColumn('positive_7', 'text')->nullable();
            $table->addColumn('created_date', 'int')->setDefault(0);
            $table->addColumn('modified_date', 'int')->setDefault(0);
            $table->addPrimaryKey('tether_id');
            $table->addUniqueKey('identifier');
            $table->addKey('category');
        });
    }

    /**
     * Install the BBCode
     */
    public function installStep2()
    {
        /** @var \XF\Entity\BbCode $bbCode */
        $bbCode = \XF::em()->find('XF:BbCode', 'tether');

        if (!$bbCode)
        {
            $bbCode = \XF::em()->create('XF:BbCode');
            $bbCode->bb_code_id = 'tether';
        }

        $bbCode->bb_code_mode = 'callback';
        $bbCode->has_option = 'yes';
        $bbCode->callback_class = 'Miatoro\Tether\BbCode\Tag\Tether';
        $bbCode->callback_method = 'render';
        $bbCode->option_regex = '#^[a-zA-Z0-9_-]+$#';
        $bbCode->trim_lines_after = 0;
        $bbCode->plain_children = false;
        $bbCode->disable_smilies = false;
        $bbCode->disable_nl2br = false;
        $bbCode->disable_autolink = false;
        $bbCode->allow_empty = false;
        $bbCode->allow_signature = true;
        $bbCode->editor_icon_type = 'fa';
        $bbCode->editor_icon_value = 'fa-link';
        $bbCode->active = true;
        $bbCode->addon_id = 'Miatoro/Tether';

        $bbCode->save();
    }

    /**
     * Uninstall step 1 - drop the tether table
     */
    public function uninstallStep1()
    {
        $this->schemaManager()->dropTable('xf_miatoro_tether');
    }

    /**
     * Uninstall step 2 - remove the BBCode
     */
    public function uninstallStep2()
    {
        /** @var \XF\Entity\BbCode $bbCode */
        $bbCode = \XF::em()->find('XF:BbCode', 'tether');

        if ($bbCode)
        {
            $bbCode->delete();
        }
    }
}
