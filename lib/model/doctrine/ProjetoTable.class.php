<?php

/**
 * ProjetoTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProjetoTable extends Doctrine_Table
{

  public function construct(){
    $this->addNamedQuery('relatorio.status',
      $this->createQuery('p')
           ->select('
             p.*,
             e.*,
             pf.*,
             pp.*,
             s.*,
             d.*')
           ->innerJoin('p.Estudante e')
           ->innerJoin('p.Professor pf')
           ->innerJoin('p.Semestre s')
           ->leftJoin('p.Proposta pp')
           ->leftJoin('p.Defesa d')
    );

    $this->addNamedQuery('relatorio.defendidos',
      $this->createQuery('p')
           ->select('
             p.*,
             e.*,
             s.*,
             d.*')
           ->innerJoin('p.Estudante e')
           ->innerJoin('p.Semestre s')
           ->innerJoin('p.Defesa d')
           ->where('d.status = ?', Defesa::DEFENDIDO)
    );
  }


    /**
     * Returns an instance of this class.
     *
     * @return object ProjetoTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Projeto');
    }

    public function exists($id){
      return $this->find($id) != null;
    }

    public function generateDocumentosReport($matriculaEstudante, $professorId, $semestreId){
      return $this->generateStatusReport($matriculaEstudante, $professorId, null, $semestreId);
    }

    public function generateStatusReport($matriculaEstudante, $professorId, $status, $semestreId){
      $query = $this->createNamedQuery('relatorio.status');

      if(ctype_digit($matriculaEstudante)){
        $query->andWhere('e.Usuario.username = ?', $matriculaEstudante);
      }

      if(ctype_digit($professorId)){
        $query->andWhere('pf.id = ?', $professorId);
      }

      if(ctype_digit($semestreId)){
        $query->andWhere('s.id = ?', $semestreId);
      }

      if(ctype_digit($status)){
        if($status < 100){
          $query->andWhere('pp.id is null');
        }else if($status < 200){
          $query->andWhere('pp.status = ?', $status);
        }else{
          $query->andWhere('d.status = ?', $status);
        }
      }

      $rows = $query->execute();

      return $this->parseStatusReportResults($rows);
    }

    private function parseStatusReportResults($results){
      $arrReport = array();
      foreach ($results as $row) {
        $status = Proposta::$status[Proposta::PENDENTE];
        if($row->getDefesa() != null){
          $status = Defesa::$status[$row->getDefesa()->getStatus()];
        }else if($row->getProposta() != null){
          $status = Proposta::$status[$row->getProposta()->getStatus()];
        }

        $arrReport[] = array(
            'matricula' => $row->getEstudante()->getUsuario()->getUsername(),
            'nomeEstudante' => $row->getEstudante()->getUsuario()->getFullname(),
            'nomeProfessor' => $row->getProfessor()->getUsuario()->getFullname(),
            'projeto' => $row->getTitulo(),
            'projeto_id' => $row->getId(),
            'status' => $status,
            'semestre' => $row->getSemestre()->getNome()
        );
      }
      return $arrReport;
    }

    public function generateDefendidosReport($semestreId){
      $query = $this->createNamedQuery('relatorio.defendidos');

      if(ctype_digit($semestreId)){
        $query->andWhere('s.id = ?', $semestreId);
      }

      $rows = $query->execute();

      return $this->parseDefendidosReportResults($rows);
    }

    private function parseDefendidosReportResults($results){
      $arrReport = array();
      foreach ($results as $row) {
        $arrReport[] = array(
            'matricula' => $row->getEstudante()->getUsuario()->getUsername(),
            'nomeEstudante' => $row->getEstudante()->getUsuario()->getFullname(),
            'projeto' => $row->getTitulo(),
            'semestre' => $row->getSemestre()->getNome()
        );
      }
      return $arrReport;
    }
    

}