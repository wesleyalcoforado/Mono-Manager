<?php

/**
 * BaseProjeto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $titulo
 * @property integer $estudante_id
 * @property integer $professor_id
 * @property string $coorientadores
 * @property date $data_requisicao
 * @property date $data_sugestao
 * @property date $data_aprovacao
 * @property date $data_autorizacao
 * @property string $documento
 * @property string $documento_final
 * @property integer $qtde_linhas
 * @property Estudante $Estudante
 * @property Professor $Professor
 * 
 * @method string    getTitulo()           Returns the current record's "titulo" value
 * @method integer   getEstudanteId()      Returns the current record's "estudante_id" value
 * @method integer   getProfessorId()      Returns the current record's "professor_id" value
 * @method string    getCoorientadores()   Returns the current record's "coorientadores" value
 * @method date      getDataRequisicao()   Returns the current record's "data_requisicao" value
 * @method date      getDataSugestao()     Returns the current record's "data_sugestao" value
 * @method date      getDataAprovacao()    Returns the current record's "data_aprovacao" value
 * @method date      getDataAutorizacao()  Returns the current record's "data_autorizacao" value
 * @method string    getDocumento()        Returns the current record's "documento" value
 * @method string    getDocumentoFinal()   Returns the current record's "documento_final" value
 * @method integer   getQtdeLinhas()       Returns the current record's "qtde_linhas" value
 * @method Estudante getEstudante()        Returns the current record's "Estudante" value
 * @method Professor getProfessor()        Returns the current record's "Professor" value
 * @method Projeto   setTitulo()           Sets the current record's "titulo" value
 * @method Projeto   setEstudanteId()      Sets the current record's "estudante_id" value
 * @method Projeto   setProfessorId()      Sets the current record's "professor_id" value
 * @method Projeto   setCoorientadores()   Sets the current record's "coorientadores" value
 * @method Projeto   setDataRequisicao()   Sets the current record's "data_requisicao" value
 * @method Projeto   setDataSugestao()     Sets the current record's "data_sugestao" value
 * @method Projeto   setDataAprovacao()    Sets the current record's "data_aprovacao" value
 * @method Projeto   setDataAutorizacao()  Sets the current record's "data_autorizacao" value
 * @method Projeto   setDocumento()        Sets the current record's "documento" value
 * @method Projeto   setDocumentoFinal()   Sets the current record's "documento_final" value
 * @method Projeto   setQtdeLinhas()       Sets the current record's "qtde_linhas" value
 * @method Projeto   setEstudante()        Sets the current record's "Estudante" value
 * @method Projeto   setProfessor()        Sets the current record's "Professor" value
 * 
 * @package    monomanager
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProjeto extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('projeto');
        $this->hasColumn('titulo', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('estudante_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('professor_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('coorientadores', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('data_requisicao', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_sugestao', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_aprovacao', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('data_autorizacao', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('documento', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('documento_final', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('qtde_linhas', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Estudante', array(
             'local' => 'estudante_id',
             'foreign' => 'id'));

        $this->hasOne('Professor', array(
             'local' => 'professor_id',
             'foreign' => 'id'));
    }
}