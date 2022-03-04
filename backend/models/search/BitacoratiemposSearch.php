<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bitacoratiempos;

/**
 * BitacoratiemposSearch represents the model behind the search form of `backend\models\Bitacoratiempos`.
 */
class BitacoratiemposSearch extends Bitacoratiempos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idBitacoraTiempo', 'idActividadPlaneada', 'idProyecto', 'idUsuario'], 'integer'],
            [['Fecha', 'HoraInicio', 'HoraFinal', 'Interrupcion', 'ActividadNoPlaneada', 'Artefacto'], 'safe'],
            [['Total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Bitacoratiempos::find();

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
            'idBitacoraTiempo' => $this->idBitacoraTiempo,
            'Fecha' => $this->Fecha,
            'HoraInicio' => $this->HoraInicio,
            'HoraFinal' => $this->HoraFinal,
            'Interrupcion' => $this->Interrupcion,
            'Total' => $this->Total,
            'idActividadPlaneada' => $this->idActividadPlaneada,
            'idProyecto' => $this->idProyecto,
            'idUsuario' => $this->idUsuario,
        ]);

        $query->andFilterWhere(['like', 'ActividadNoPlaneada', $this->ActividadNoPlaneada])
            ->andFilterWhere(['like', 'Artefacto', $this->Artefacto]);

        return $dataProvider;
    }
}
