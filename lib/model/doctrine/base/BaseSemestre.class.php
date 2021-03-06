<?php

/**
 * BaseSemestre
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $nome
 * @property date $data_colacao
 * @property date $data_max_proposta
 * @property date $data_max_copiao
 * @property date $data_max_defesa
 * @property date $data_colacao_especial
 * @property date $data_max_proposta_especial
 * @property date $data_max_copiao_especial
 * @property date $data_max_defesa_especial
 * @property Doctrine_Collection $Projeto
 * 
 * @method string              getNome()                       Returns the current record's "nome" value
 * @method date                getDataColacao()                Returns the current record's "data_colacao" value
 * @method date                getDataMaxProposta()            Returns the current record's "data_max_proposta" value
 * @method date                getDataMaxCopiao()              Returns the current record's "data_max_copiao" value
 * @method date                getDataMaxDefesa()              Returns the current record's "data_max_defesa" value
 * @method date                getDataColacaoEspecial()        Returns the current record's "data_colacao_especial" value
 * @method date                getDataMaxPropostaEspecial()    Returns the current record's "data_max_proposta_especial" value
 * @method date                getDataMaxCopiaoEspecial()      Returns the current record's "data_max_copiao_especial" value
 * @method date                getDataMaxDefesaEspecial()      Returns the current record's "data_max_defesa_especial" value
 * @method Doctrine_Collection getProjeto()                    Returns the current record's "Projeto" collection
 * @method Semestre            setNome()                       Sets the current record's "nome" value
 * @method Semestre            setDataColacao()                Sets the current record's "data_colacao" value
 * @method Semestre            setDataMaxProposta()            Sets the current record's "data_max_proposta" value
 * @method Semestre            setDataMaxCopiao()              Sets the current record's "data_max_copiao" value
 * @method Semestre            setDataMaxDefesa()              Sets the current record's "data_max_defesa" value
 * @method Semestre            setDataColacaoEspecial()        Sets the current record's "data_colacao_especial" value
 * @method Semestre            setDataMaxPropostaEspecial()    Sets the current record's "data_max_proposta_especial" value
 * @method Semestre            setDataMaxCopiaoEspecial()      Sets the current record's "data_max_copiao_especial" value
 * @method Semestre            setDataMaxDefesaEspecial()      Sets the current record's "data_max_defesa_especial" value
 * @method Semestre            setProjeto()                    Sets the current record's "Projeto" collection
 * 
 * @package    monomanager
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSemestre extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('semestre');
        $this->hasColumn('nome', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('data_colacao', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_max_proposta', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_max_copiao', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_max_defesa', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_colacao_especial', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_max_proposta_especial', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_max_copiao_especial', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_max_defesa_especial', 'date', null, array(
             'type' => 'date',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Projeto', array(
             'local' => 'id',
             'foreign' => 'semestre_id'));
    }
}