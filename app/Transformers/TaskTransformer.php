<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Task;

/**
 * Class TaskTransformer.
 *
 * @package namespace App\Transformers;
 */
class TaskTransformer extends TransformerAbstract
{
    /**
     * Transform the Task entity.
     *
     * @param \App\Models\Task $model
     *
     * @return array
     */
    public function transform(Task $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
