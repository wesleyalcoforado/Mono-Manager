<?php

/**
 * Proposta
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    monomanager
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Proposta extends BaseProposta
{
    const PENDENTE      = 99;
    const NAO_ANALISADO = 100;
    const APROVADO      = 101;
    const REPROVADO     = 102;
    const LIBERADO      = 103;
    const NAO_LIBERADO  = 104;

    static $status = array(
        self::PENDENTE => "Proposta pendente",
        self::NAO_ANALISADO => "Proposta não analisada",
        self::APROVADO => "Proposta aprovada pelo orientador",
        self::REPROVADO => "Proposta reprovada pelo orientador",
        self::LIBERADO => "Proposta aprovada pela comissão",
        self::NAO_LIBERADO => "Proposta reprovada pela comissão"
    );

    protected $positiveComments;
    protected $negativeComments;
    protected $positivePercentage;
    protected $negativePercentage;
    protected $countComissao;

    public function audit(Professor $professor, $approved, $comment){
      $this->addComment($professor, $approved, $comment);

      if($this->canBeAudited()){
        $positiveDecision = $this->positivePercentage >= $this->negativePercentage;

        $status = $positiveDecision ? Proposta::LIBERADO : Proposta::NAO_LIBERADO;
        $this->setStatus($status);
        $this->save();
      }
    }

    protected function addComment(Professor $professor, $approved, $text){
      $alreadyAuditedByThisProfessor = ComentarioTable::getInstance()->alreadyExists($this, $professor);
      if(!$alreadyAuditedByThisProfessor){
        $comment = new Comentario();
        $comment->setProfessor($professor);
        $comment->setProposta($this);
        $comment->setComentario($text);
        $comment->setLiberado($approved);
        $comment->save();
      }
    }

    protected function canBeAudited(){
      $this->calculatePercentages();
      $quorum = $this->countComissao / 2;
      $qtyComments = $this->positiveComments + $this->negativeComments;

      return ($qtyComments == $this->countComissao) || ($this->positivePercentage >= $quorum) || ($this->negativePercentage > $quorum);
    }

    protected function calculatePercentages(){
      $this->loadComments();
      $this->countComissao = ProfessorTable::getInstance()->countComissao();

      $this->positivePercentage = 0;
      $this->negativePercentage = 0;

      if($this->countComissao > 0){
        $this->positivePercentage = $this->positiveComments / $this->countComissao;
        $this->negativePercentage = $this->negativeComments / $this->countComissao;
      }
    }

    protected function loadComments(){
      $comments = $this->getComentarios();
      $this->positiveComments = 0;
      $this->negativeComments = 0;
      foreach($comments as $c){
        if($c->getLiberado()){
          $this->positiveComments++;
        }else{
          $this->negativeComments++;
        }
      }
    }

    public function isDelayed($now = null){
      extract(Semestre::getTimestamps($this->getProjeto()));
      if($now == null){
        $now = time();
      }
      return ($now > $dataProposta);
    }

    public function responsibleForDelay($now = null){
      if($now == null){
        $now = time();
      }
      
      if($this->isDelayed($now)){
        if($this->getStatus() == self::NAO_ANALISADO){
          return Usuario::PROFESSOR;
        }else if($this->getStatus() == self::APROVADO){
          return Usuario::COMISSAO;
        }
      }

      return '';
    }

}
