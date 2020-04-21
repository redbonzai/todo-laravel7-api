<?php

namespace App\Repositories;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\TaskInterface;
use App\Models\Task;
use App\Validators\TaskValidator;

/**
 * Class TaskInterface.
 *
 * @package namespace App\Repositories;
 */
class TaskRepository extends BaseRepository implements TaskInterface
{
    /** @var Task $task */
    protected $task;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->task = new $this->model();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return TaskValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
