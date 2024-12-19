<?php

namespace App\Repositories;

use App\Models\Place;
use App\Repositories\BaseRepository;

/**
 * Class PlaceRepository
 * @package App\Repositories
 * @version January 7, 2020, 8:09 am -03
*/

class PlaceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'summary',
        'important_image',
        'publish'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Place::class;
    }
}
