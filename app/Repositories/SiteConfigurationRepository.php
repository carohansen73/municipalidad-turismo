<?php

namespace App\Repositories;

use App\Models\SiteConfiguration;
use App\Repositories\BaseRepository;

/**
 * Class SiteConfigurationRepository
 * @package App\Repositories
 * @version November 4, 2019, 10:45 am -03
*/

class SiteConfigurationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title_news',
        'subtitle_news',
        'title_events',
        'subtitle_events',
        'title_team',
        'subtitle_team',
        'description_team'
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
        return SiteConfiguration::class;
    }
}
