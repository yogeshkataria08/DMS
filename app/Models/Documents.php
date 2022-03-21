<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';
    protected $primaryKey = 'id';

    /**
     * add document
     *
     * @param array $models
     * @return void
     */
    public static function add($models = []) {
        $document = new Documents;
        $document->entity_id = $models['entity_id'];
        $document->entity_type = $models['entity_type'];
        $document->path = $models['path'];
        $document->file_name = $models['file_name'];
        $document->created_at = date('Y-m-d H:i:s');
        $document->updated_at = date('Y-m-d H:i:s');
        $documentId = $document->save();
        if ($documentId) {
            return $document;
        }

        return false;
    }
}
