<?php

namespace backend\models\support;

use common\models\GlobalFunctions;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\support\CronjobTask;

/**
 * CronjobTaskSearch represents the model behind the search form of `backend\models\support\CronjobTask`.
 */
class CronjobTaskSearch extends CronjobTask
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CronjobTask::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        $this->load($params);

        // descomenta y utiliza tu relación con las traducciones para poder cargar los atributos de traducción
        // $query->leftJoin('table_lang',"table.id = table_lang.table_id AND table_lang.language='".Yii::$app->language."'");

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        if(isset($this->created_at) && !empty($this->created_at))
        {
            $date_explode = explode(' - ',$this->created_at);
            $start_date = GlobalFunctions::formatDateToSaveInDB($date_explode[0]).' 00:00:00';
            $end_date = GlobalFunctions::formatDateToSaveInDB($date_explode[1]).' 23:59:59';

            $query->andFilterWhere(['>=', 'created_at', $start_date])
                ->andFilterWhere(['<=', 'created_at', $end_date]);

            $this->created_at = null;
        }


        return $dataProvider;
    }
}
