<?php

namespace App\Repositories;

use App\Models\PostTag;
use App\Repositories\BaseRepository;

/**
 * Class PostTagRepository
 * @package App\Repositories
 * @version September 27, 2019, 8:39 am -03
*/

class PostTagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'slug',
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
        return PostTag::class;
    }
}
