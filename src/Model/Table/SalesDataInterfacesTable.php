<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesDataInterfaces Model
 *
 * @method \App\Model\Entity\SalesDataInterface get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesDataInterface newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesDataInterface[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesDataInterface|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesDataInterface patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesDataInterface[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesDataInterface findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesDataInterfacesTable extends AppTable
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('sales_data_interfaces');
        $this->displayField('id');
        $this->primaryKey('id');

        
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('status');

        $validator
            ->allowEmpty('store_number');

        $validator
            ->allowEmpty('vendor_machine_number');

        $validator
            ->date('sales_date')
            ->allowEmpty('sales_date');

        $validator
            ->dateTime('sales_time')
            ->allowEmpty('sales_time');

        $validator
            ->allowEmpty('account_number');

        $validator
            ->allowEmpty('account_name');

        $validator
            ->integer('price')
            ->allowEmpty('price');

        $validator
            ->integer('sales_qty')
            ->allowEmpty('sales_qty');

        $validator
            ->integer('sales_amount')
            ->allowEmpty('sales_amount');

        $validator
            ->allowEmpty('payment_type');

        $validator
            ->integer('p_card_amount')
            ->allowEmpty('p_card_amount');

        $validator
            ->integer('comb_cash_amount')
            ->allowEmpty('comb_cash_amount');

        $validator
            ->integer('conb_p_card_amount')
            ->allowEmpty('conb_p_card_amount');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }
}
