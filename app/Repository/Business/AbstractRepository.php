<?php

namespace App\Repository\Business;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use stdClass;

abstract class AbstractRepository {

    private $model;
    private $message;
    private $upload_file;
    private $relationships = [];

    public function __construct($model, $message, $relationships, $upload_file = null) {
        $this->model = $model;
        $this->message = new stdClass();
        $this->relationships = $relationships;
        $this->upload_file = $upload_file;
    }

    public function all(Request $request) {
        try {
            $models = $this->model->query()->with($this->relationships);
            if (!empty($request->input('search'))) {
                $this->filterGlobal($request, $models);
            } else {
                $this->filterByColumn($request, $models);
            }
            $models = $this->ordenate($request, $models);
            $this->setMessage($models['total'] . " recurso(s) encontrado(s)", 200);
            return $models;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
        return null;
    }

    public function create(Request $request) {
        try {
            $model = new $this->model();
            $model->fill($request->all());
            $this->uploadFiles($model,$request);
            $model->save();
            $this->setMessage("Salvo com sucesso", 201);
            return $model;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $model->fill($request->all());
                $this->uploadFiles($model,$request);
                $model->save();
                $this->setMessage('Atualizado com sucesso', 200);
                return $model;
            }
            $this->setMessage("Recurso não encontrado", 404);
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
        return null;
    }

    public function findById($id) {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $this->setMessage("Recurso encontrado", 200);
                return $model;
            }
            $this->setMessage("Recurso não encontrado", 404);
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
        return null;
    }

    public function delete($id) {
        try {
            $model = $this->model->find($id);
            if (!empty($model)) {
                $this->uploadFiles($model);
                $model->delete();
                $this->setMessage('Apagado com sucesso', 204);
                return null;
            }
            $this->setMessage("O recurso não existe", 404);
            return $model;
        } catch (Exception $e) {
            $this->setMessage('Erro encontrado com o código ' . $e->getMessage(), 500);
        }
        return null;
    }

    protected function filterGlobal(Request $request, $search) {
        if ($field = $request->input('search')) {
            $columns = Schema::getColumnListing($this->model->getTable());
            foreach ($columns as $column) {
                $search->orWhere($column, "LIKE", "%" . $field . "%");
            }
        }
    }

    protected function filterByColumn(Request $request, $search) {
        $columns = Schema::getColumnListing($this->model->getTable());
        foreach ($columns as $field) {
            if ($request->exists($field) == true) {
                $column = Schema::getColumnType($this->model->getTable(), $field);
                if ($column == "string" || $column == "datetime") {
                    $search->where($field, 'like', '%' . $request->$field . '%');
                } else{
                    $search->where($field, $request->$field);
                }
            }
        }
    }

    protected function ordenate(Request $request, $search) {
        $orderBy = $request->order_by;
        $order = $request->order;
        if (empty($orderBy) || $orderBy == null) {
            $orderBy = 'id';
        }
        if (empty($order) || $order == null) {
            $order = 'desc';
        }
        if (Schema::hasColumn($this->model->getTable(), $orderBy) == false) {
            $orderBy = 'id';
        }
        return $search->orderBy($orderBy, $order)->paginate(15);
    }

    public function uploadFiles($model,Request $request = null) {
        if (isset($request)) {
            if (!empty($this->upload_file) && $this->upload_file[0] != null && $file = $request->file($this->upload_file[0])) {
                foreach (Schema::getColumnListing($this->model->getTable()) as $column) {
                    if ($column === $this->upload_file[0]) {
                        $model->$column = Storage::put($this->upload_file[1], $file);
                        break;
                    }
                }
            }
        } else {
            if (!empty($this->upload_file) && $this->upload_file[0] != null) {
                foreach (Schema::getColumnListing($this->model->getTable()) as $column) {
                    if ($column === $this->upload_file[0]) {
                        $file = $this->upload_file[0];
                        if (!empty($model->$file())) {
                            Storage::delete($model->$file());
                        }
                        break;
                    }
                }
            }
        }
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($text, $code) {
        $this->message->text = $text;
        $this->message->code = $code;
    }

}
