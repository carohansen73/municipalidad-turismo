<?php

namespace App\Repositories;

use App\Models\ServiceProvider;
use App\Repositories\BaseRepository;

/**
 * Class EventRepository
 * @package App\Repositories
 * @version October 15, 2019, 10:41 am -03
 */

class ServiceProviderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'location_city',
        'loction_address',
        'price',
        'capacity',
        'considerations',
        'contact_name',
        'contact_email',
        'contact_ig',
        'contact_fb',
        'contact_web'

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
        return ServiceProvider::class;
    }
}
