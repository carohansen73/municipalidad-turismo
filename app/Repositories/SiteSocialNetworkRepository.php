<?php

namespace App\Repositories;

use App\Models\SiteSocialNetwork;
use App\Repositories\BaseRepository;

/**
 * Class SiteSocialNetworkRepository
 * @package App\Repositories
 * @version October 31, 2019, 11:00 am -03
*/

class SiteSocialNetworkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'url'
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
        return SiteSocialNetwork::class;
    }
}
