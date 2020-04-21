<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Traits\ApiResponder;
use http\Exception\RuntimeException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Validators\TaskValidator;
use Whoops\Exception\ErrorException;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class TasksController.
 *
 * @package namespace App\Http\Controllers;
 */
class TasksController extends Controller
{
    use ApiResponder;
    /**
     * @var Task
     */
    protected $task;

    /**
     * @var TaskRepository
     */
    protected $repository;

    /**
     * @var TaskValidator
     */
    protected $validator;

    /**
     * TasksController constructor.
     *
     * @param Task $task
     * @param TaskRepository $repository
     * @param TaskValidator $validator
     */
    public function __construct(
        Task $task,
        TaskRepository $repository,
        TaskValidator $validator
    )
    {
        $this->task = $task;
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    final public function index()
    {
        $this->repository->pushCriteria(app(RequestCriteria::class));
        $tasks = $this->repository->all();

        return $this->successResponse(['tasks' =>$tasks]);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidatorException
     */
    final public function store(Request $request): JsonResponse
    {
        // dd('Incoming Request: ', $request);
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required|min:10|string',
                'completed' => 'required|boolean',
                'target_date' => 'required|date|after_or_equal:today'
            ]);
           // $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if ($validator->fails()) {
                return $this->errorResponse([
                    'message' => $validator->errors()->jsonSerialize(),
                    'data'    => null,
                    'error' => true
                ], 422);
            }

            $task = $this->repository->create($request->all());

            $response = $this->successResponse([
                'message' => 'Task success fully created',
                'error' => false,
                'data' => $task->toArray()
            ], 201);

        } catch (ErrorException $e) {
            $response = $this->errorResponse([
                'message' => $e->getMessage(),
                'data'    => 'Error ... task could not be created',
                'error' => true
            ], 422);
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return JsonResponse
     */
    final public function show(int $id): JsonResponse
    {
        $task = $this->repository->find($id);
        return $this->successResponse($task, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    final public function update(Request $request, int $id): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'required|min:10|string',
                'completed' => 'required|boolean',
                'target_date' => 'required|date|after_or_equal:today'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse([
                    'message' => $validator->errors()->jsonSerialize(),
                    'data'    => null,
                    'error' => true
                ],422);
            }

           // $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $task = $this->task::findOrFail($id);
            $this->repository->update($request->all(), $task->id);

            $response = $this->successResponse([
                'message' => 'Task created.',
                'data'    => $task->toArray(),
                'error' => false
            ], 200);

        } catch (ErrorException $e) {
            $response = $this->errorResponse([
                'message' => $e->getMessage(),
                'data'    => 'Error ... task could not be updated',
                'error' => true
            ], 422);
        }

        return response()->json($response);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    final public function updateTOCompleted(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'completed' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse([
                    'errors' => $validator->errors()->jsonSerialize(),
                    'data' => null,
                    'success' => false
                ], 422);
            }

            $todos = $this->task::query()->update(['completed' => $request->completed]);

            return $this->successResponse([
                'updated' => true,
                'data' => $todos,
                'success' => true,
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse([
                'message' => $e->getMessage(),
                'error' => 'could not update all completed todos',
                'success' => false,
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    final public function destroyCompleted(Request $request): JsonResponse
    {
       // dd('Request: ', $request);
        try {
            $validator = Validator::make($request->all(), [
                'todos' => 'required|array',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse([
                    'errors' => $validator->errors()->jsonSerialize(),
                    'data' => null,
                    'success' => false
                ], 422);
            }

            $destroyed = $this->task::destroy($request->todos);

            $response = [
              'success' => true,
              'status' => 'Removed ' . $destroyed . ' completed todos'
            ];

        } catch (RuntimeException $e) {

            $response = [
                'success' => false,
                'status' => $e->getMessage(),

            ];

        }

        $response['success'] === true
            ? $this->successResponse($response)
            : $this->errorResponse($response);

        return response()->json($response);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    final public function destroy(int $id): JsonResponse
    {
        $task = $this->task::findOrFail($id);
        $deleted = $this->repository->delete($id);
        $response = $deleted
            ? $this->successResponse(['destroyed' => $task], 200)
            : $this->errorResponse(['error' => 'There was an error deleting the current task'], 422);

        return response()->json($response);
    }
}
