<?php

declare(strict_types=1);

namespace App\Repository\Business;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use stdClass;

abstract class AbstractRepository
{
    private $model;
    private $details;

    public function __construct($model)
    {
        $this->model = $model;
        $this->details = new stdClass();
    }

    public function all(Request $request)
    {
        try {
            $models = $this->model->query();
            if (!empty($request->input('search'))) {
                $this->filter($request->input('search'), $models);
            }
            $models = $this->ordenate($request, $models);
            $this->setDetails(null, 'success', 200);
            return $models;
        } catch (Exception $e) {
            return ['message' => 'Erro encontrado com o código ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function create(Request $request)
    {
        try {
            $model = new $this->model();
            $model->fill($request->all());

            $model->save();

            $this->setDetails('Salvo com sucesso', 'success', 201);
            return $model;
        } catch (Exception $e) {
            return ['message' => 'Erro ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $model->fill($request->all());
                $model->save();

                $this->setDetails('Atualizado com sucesso', 'success', 200);
                return $model;
            }

            $this->setDetails('Não encontrado', 'danger', 404);
            return null;
        } catch (Exception $e) {
            return ['message' => 'Erro ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function findById($id)
    {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $this->setDetails('Recurso encontrado', 'success', 200);
                return $model;
            }
            $this->setDetails('Não encontrado', 'danger', 404);
            return null;
        } catch (Exception $e) {
            return ['message' => 'Erro ' . $e->getMessage(), 'status' => 500];
        }
    }

    public function delete($id)
    {
        try {
            $model = $this->model->find($id);
            if (empty($model)) {
                $this->setDetails('Não encontrado', 'danger', 404);
                return null;
            }
            $model->delete();
            $this->setDetails('Apagado com sucesso', 'success', 200);
        } catch (Exception $e) {
            return ['message' => 'Erro ' . $e->getMessage(), 'status' => 500];
        }
    }

    protected function ordenate(Request $request, $search)
    {
        $perPage = $request->input('per_page', 15);
        $orderBy = $request->orderBy;
        $order = $request->sortedBy;
        if (empty($orderBy)) {
            $orderBy = 'id';
        }
        if (empty($order)) {
            $order = 'desc';
        }
        if (Schema::hasColumn($this->model->getTable(), $orderBy) == false) {
            $orderBy = 'id';
        }
        return $search->orderBy($orderBy, $order)->paginate($perPage);
    }

    public function getDetails()
    {
        return $this->details;
    }

    protected function setDetails($message, $type, $status)
    {
        $this->details->message = $message;
        $this->details->type = $type;
        $this->details->status = $status;
    }

    protected function filter($search, $query)
    {
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                foreach (Schema::getColumnListing($this->model->getTable()) as $column) {
                    $q->orWhere($column, 'ilike', '%' . $search . '%');
                }
            });
        }
    }
}
