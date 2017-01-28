<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\AccessLog;

/**
 * AccessLogSearch represents the model behind the search form about `app\models\AccessLog`.
 */
class AccessLogSearch extends AccessLog
{
    /**
     * Start date for filter
     * @var string
     */
    public $dateStart;
    
    /**
     * End date for filter
     * @var string
     */
    public $dateEnd;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status_code', 'size'], 'integer'],
            [['dateStart', 'dateEnd'], 'filter', 'filter' => function($value) {
                if (empty($value)) {
                    return null;
                }
                return date('Y-m-d H:i:s', strtotime($value));
            }],
            [['ip', 'url', 'date', 'headers', 'referrer', 'user_agent', 'dateStart', 'dateEnd'], 'safe'],
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
        $query = AccessLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'status_code' => $this->status_code,
            'size' => $this->size,
        ]);

        $query->andFilterWhere(['ilike', 'ip', $this->ip])
            ->andFilterWhere(['ilike', 'url', $this->url])
            ->andFilterWhere(['ilike', 'headers', $this->headers])
            ->andFilterWhere(['ilike', 'referrer', $this->referrer])
            ->andFilterWhere(['ilike', 'user_agent', $this->user_agent])
            ->andFilterWhere(['>=', 'date', $this->dateStart])
            ->andFilterWhere(['<=', 'date', $this->dateEnd]);

        return $dataProvider;
    }
    
    public function analyze($params)
    {
        $this->load($params);
        if (!$this->validate()) {
            throw new \yii\db\Exception('Invalid search params');
        }
        
        $query->andFilterWhere(['>=', 'date', $this->dateStart])
            ->andFilterWhere(['<=', 'date', $this->dateEnd]);
        
        $query = (new Query())->select([
                
            ])
            ->from(AccessLog::tableName());
        
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->getRawSql(),
            'totalCount' => $query->count(),
            'sort' => [
                'attributes' => [
                    
                ],
                'defaultOrder' => [
                    'date' => SORT_ASC
                ]
            ],
        ]);

        return $dataProvider;
    }
}
