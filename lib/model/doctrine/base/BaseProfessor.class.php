<?php

/**
 * BaseProfessor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $instituicao
 * @property string $titulacao
 * @property string $experiencia
 * @property boolean $is_substituto
 * @property boolean $is_comissao
 * @property Usuario $Usuario
 * @property Doctrine_Collection $Projeto
 * @property Doctrine_Collection $Comentario
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getInstituicao()   Returns the current record's "instituicao" value
 * @method string              getTitulacao()     Returns the current record's "titulacao" value
 * @method string              getExperiencia()   Returns the current record's "experiencia" value
 * @method boolean             getIsSubstituto()  Returns the current record's "is_substituto" value
 * @method boolean             getIsComissao()    Returns the current record's "is_comissao" value
 * @method Usuario             getUsuario()       Returns the current record's "Usuario" value
 * @method Doctrine_Collection getProjeto()       Returns the current record's "Projeto" collection
 * @method Doctrine_Collection getComentario()    Returns the current record's "Comentario" collection
 * @method Professor           setId()            Sets the current record's "id" value
 * @method Professor           setInstituicao()   Sets the current record's "instituicao" value
 * @method Professor           setTitulacao()     Sets the current record's "titulacao" value
 * @method Professor           setExperiencia()   Sets the current record's "experiencia" value
 * @method Professor           setIsSubstituto()  Sets the current record's "is_substituto" value
 * @method Professor           setIsComissao()    Sets the current record's "is_comissao" value
 * @method Professor           setUsuario()       Sets the current record's "Usuario" value
 * @method Professor           setProjeto()       Sets the current record's "Projeto" collection
 * @method Professor           setComentario()    Sets the current record's "Comentario" collection
 * 
 * @package    monomanager
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProfessor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('professor');
        $this->hasColumn('id', 'integer', null, array(
             'primary' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('instituicao', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('titulacao', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('experiencia', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('is_substituto', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('is_comissao', 'boolean', null, array(
             'type' => 'boolean',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Usuario', array(
             'local' => 'id',
             'foreign' => 'id',
             'cascade' => array(
             0 => 'delete',
             )));

        $this->hasMany('Projeto', array(
             'local' => 'id',
             'foreign' => 'professor_id'));

        $this->hasMany('Comentario', array(
             'local' => 'id',
             'foreign' => 'professor_id'));
    }
}