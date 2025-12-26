<?php

namespace Miatoro\Tether\Repository;

use XF\Mvc\Entity\Repository;

class Tether extends Repository
{
    /**
     * Find all tethers
     *
     * @return \XF\Mvc\Entity\Finder
     */
    public function findTethersForList()
    {
        return $this->finder('Miatoro\Tether:Tether')
            ->order('title');
    }

    /**
     * Get a tether by identifier
     *
     * @param string $identifier
     * @return \Miatoro\Tether\Entity\Tether|null
     */
    public function getTetherByIdentifier($identifier)
    {
        return $this->finder('Miatoro\Tether:Tether')
            ->where('identifier', $identifier)
            ->fetchOne();
    }

    /**
     * Get tether by ID
     *
     * @param int $id
     * @return \Miatoro\Tether\Entity\Tether|null
     */
    public function getTetherById($id)
    {
        return $this->finder('Miatoro\Tether:Tether')
            ->where('tether_id', $id)
            ->fetchOne();
    }

    /**
     * Get tethers by category
     *
     * @param string $category
     * @return \XF\Mvc\Entity\Finder
     */
    public function findTethersByCategory($category)
    {
        return $this->finder('Miatoro\Tether:Tether')
            ->where('category', $category)
            ->order('title');
    }

    /**
     * Get all categories
     *
     * @return array
     */
    public function getCategoryList()
    {
        return [
            'Eater' => 'Eater',
            'Death' => 'Death',
            'God' => 'God',
            'Entity' => 'Entity',
            'Dedication' => 'Dedication'
        ];
    }
}
