<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Facilities Model
 *
 * @property \App\Model\Table\DepartmentsTable&\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\HasMany $Bookings
 *
 * @method \App\Model\Entity\Facility newEmptyEntity()
 * @method \App\Model\Entity\Facility newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Facility> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Facility get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Facility findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Facility patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Facility> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Facility|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Facility saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Facility>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Facility>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Facility>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Facility> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Facility>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Facility>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Facility>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Facility> deleteManyOrFail(iterable $entities, array $options = [])
 */
class FacilitiesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('facilities');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
        ]);
        $this->hasMany('Bookings', [
            'foreignKey' => 'facility_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->integer('department_id')
            ->allowEmptyString('department_id');

        $validator
            ->integer('capacity')
            ->allowEmptyString('capacity');

        $validator
            ->scalar('image_url')
            ->maxLength('image_url', 255)
            ->allowEmptyString('image_url');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['department_id'], 'Departments'), ['errorField' => 'department_id']);

        return $rules;
    }
}
