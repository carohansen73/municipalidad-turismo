<?php

namespace App\Repositories;

use App\Models\PostGaleryImage;
use App\Repositories\BaseRepository;

/**
 * Class PostGaleryImageRepository
 * @package App\Repositories
 * @version October 23, 2019, 10:50 am -03
*/

class PostGaleryImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image'
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
        return PostGaleryImage::class;
    }
}
