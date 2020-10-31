<?php
/**
 * @copyright 2020
 * @author Stefan "eFrane" Graupner <stefan.graupner@gmail.com>
 */

namespace EFraneCom\Builder;


use Illuminate\Support\Str;
use TightenCo\Jigsaw\Collection\CollectionItem;

class ProjectCollection extends CollectionItem
{
    /**
     * @var string
     */
    protected $snakeName;

    public function fromItem(CollectionItem $project)
    {
        $this->snakeName = Str::snake($project->get('name'));
    }

    /**
     * @return string
     */
    public function getSnakeName(): string
    {
        return $this->snakeName;
    }
}
