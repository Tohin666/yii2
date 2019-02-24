<?php

namespace frontend\modules\v2api\models\filters;

use common\models\tables\Tasks;
use yii\data\ActiveDataProvider;

class ApiTaskFilter
{
    public static function filter(array $filter)
    {
        // front.yii2/api-tasks?filter[month]=2&filter[project_id]=1&filter[responsible_id]=1&filter[status]=2
        $query = Tasks::find();
        if ($filter) {
            // если есть фильтр по месяцам: filter[month]
            if ($filter['month']) {
                $query->where(['MONTH(date)' => $filter['month']]);
                unset($filter['month']);
            }

            // сработает на все остальные запросы: filter[responsible_id]&filter[status]&filter[project_id]
            $query->filterWhere($filter);
        }

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

}