<?php

namespace App\Repositories;

use App\Models\SocialNetwork;
use App\Repositories\BaseRepository;

/**
 * Class SocialNetworkRepository
 * @package App\Repositories
 * @version October 18, 2019, 1:23 pm -03
*/

class SocialNetworkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'icon'
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
        return SocialNetwork::class;
    }
}
