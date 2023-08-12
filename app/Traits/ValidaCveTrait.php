<?php

trait ValidaCveTrait
{
    public function validateUniqueField($attribute, $value, $model, $ignoreColumn = null)
    {
        $query = $model->where($attribute, $value);

        if ($ignoreColumn) {
            $query->where($ignoreColumn, '!=', $model->$ignoreColumn);
        }

        return $query->exists();
    }

}
