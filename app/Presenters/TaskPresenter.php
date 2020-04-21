<?php

namespace App\Presenters;

use App\Transformers\TaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TaskPresenter.
 *
 * @package namespace App\Presenters;
 */
class TaskPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TaskTransformer();
    }
}
