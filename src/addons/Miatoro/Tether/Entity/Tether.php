<?php

namespace Miatoro\Tether\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * COLUMNS
 * @property int tether_id
 * @property string identifier
 * @property string title
 * @property string category
 * @property string tags
 * @property string wiki_url
 * @property string image_path
 * @property string description
 * @property string negative_1
 * @property string negative_2
 * @property string negative_3
 * @property string negative_4
 * @property string negative_5
 * @property string negative_6
 * @property string negative_7
 * @property string positive_1
 * @property string positive_2
 * @property string positive_3
 * @property string positive_4
 * @property string positive_5
 * @property string positive_6
 * @property string positive_7
 * @property int created_date
 * @property int modified_date
 */
class Tether extends Entity
{
    /**
     * Get all negative values as an array
     *
     * @return array
     */
    public function getNegativeValues()
    {
        $values = [];
        for ($i = 1; $i <= 7; $i++)
        {
            $key = 'negative_' . $i;
            if (!empty($this->$key))
            {
                $values[$i] = $this->$key;
            }
        }
        return $values;
    }

    /**
     * Get all positive values as an array
     *
     * @return array
     */
    public function getPositiveValues()
    {
        $values = [];
        for ($i = 1; $i <= 7; $i++)
        {
            $key = 'positive_' . $i;
            if (!empty($this->$key))
            {
                $values[$i] = $this->$key;
            }
        }
        return $values;
    }

    /**
     * Get tags as an array
     *
     * @return array
     */
    public function getTagsArray()
    {
        if (empty($this->tags))
        {
            return [];
        }
        return array_map('trim', explode(',', $this->tags));
    }

    /**
     * Set modified date on save
     */
    protected function _preSave()
    {
        if ($this->isInsert())
        {
            $this->created_date = \XF::$time;
        }
        $this->modified_date = \XF::$time;
    }

    /**
     * Define the entity structure
     *
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_miatoro_tether';
        $structure->shortName = 'Miatoro\Tether:Tether';
        $structure->primaryKey = 'tether_id';
        $structure->columns = [
            'tether_id' => ['type' => self::UINT, 'autoIncrement' => true],
            'identifier' => ['type' => self::STR, 'maxLength' => 100, 'required' => true,
                'unique' => true,
                'match' => 'alphanumeric_underscore_hyphen'
            ],
            'title' => ['type' => self::STR, 'maxLength' => 255, 'required' => true],
            'category' => ['type' => self::STR, 'maxLength' => 50, 'default' => '',
                'allowedValues' => ['Eater', 'Death', 'God', 'Entity', 'Dedication', '']
            ],
            'tags' => ['type' => self::STR, 'default' => ''],
            'wiki_url' => ['type' => self::STR, 'maxLength' => 500, 'default' => ''],
            'image_path' => ['type' => self::STR, 'maxLength' => 500, 'default' => ''],
            'description' => ['type' => self::STR, 'default' => ''],
            'negative_1' => ['type' => self::STR, 'default' => ''],
            'negative_2' => ['type' => self::STR, 'default' => ''],
            'negative_3' => ['type' => self::STR, 'default' => ''],
            'negative_4' => ['type' => self::STR, 'default' => ''],
            'negative_5' => ['type' => self::STR, 'default' => ''],
            'negative_6' => ['type' => self::STR, 'default' => ''],
            'negative_7' => ['type' => self::STR, 'default' => ''],
            'positive_1' => ['type' => self::STR, 'default' => ''],
            'positive_2' => ['type' => self::STR, 'default' => ''],
            'positive_3' => ['type' => self::STR, 'default' => ''],
            'positive_4' => ['type' => self::STR, 'default' => ''],
            'positive_5' => ['type' => self::STR, 'default' => ''],
            'positive_6' => ['type' => self::STR, 'default' => ''],
            'positive_7' => ['type' => self::STR, 'default' => ''],
            'created_date' => ['type' => self::UINT, 'default' => 0],
            'modified_date' => ['type' => self::UINT, 'default' => 0]
        ];
        $structure->getters = [
            'negative_values' => true,
            'positive_values' => true,
            'tags_array' => true
        ];
        $structure->relations = [];

        return $structure;
    }
}
