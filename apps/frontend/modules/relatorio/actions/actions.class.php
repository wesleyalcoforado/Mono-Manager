<?php

/**
 * relatorio actions.
 *
 * @package    monomanager
 * @subpackage relatorio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class relatorioActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }

  public function executeStatus(sfWebRequest $request)
  {
    $generate = $request->hasParameter('gerar');
    if($generate){
      $filters = $request->getParameter('relatorio');
      $matriculaEstudante = $filters['estudante_id'];
      $professorId = $filters['professor_id'];
      $status = $filters['status'];
      $semestreId = $filters['semestre_id'];

      $results = ProjetoTable::getInstance()->generateStatusReport($matriculaEstudante, $professorId, $status, $semestreId);
      $this->reportRows = $results;

      $this->form = new RelatorioStatusForm($filters);
    }else{
      $this->form = new RelatorioStatusForm();
    }
  }

  public function executeConcluidos(sfWebRequest $request)
  {
    $generate = $request->hasParameter('gerar');
    if($generate){
      $filters = $request->getParameter('relatorio');
      $semestreId = $filters['semestre_id'];

      $results = ProjetoTable::getInstance()->generateDefendidosReport($semestreId);
      $this->reportRows = $results;

      $this->form = new RelatorioDefendidosForm($filters);
    }else{
      $this->form = new RelatorioDefendidosForm();
    }
  }

  public function executeAta(sfWebRequest $request)
  {

    $config = sfTCPDFPluginConfigHandler::loadConfig();
    $pdf = new sfTCPDF();

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('TCC-MANAGER');
    $pdf->SetTitle('Ata de apresentação de projeto final');

    $pdf->addPage();

    $html = '<h1>HTML Example</h1>
Some special characters: &lt; € &euro; &#8364; &amp; è &egrave; &copy; &gt; \\slash \\\\double-slash \\\\\\triple-slash
<h2>List</h2>
List example:
<ol>
    <li><img src="../images/logo_example.png" alt="test alt attribute" width="30" height="30" border="0" /> test image</li>
    <li><b>bold text</b></li>
    <li><i>italic text</i></li>
    <li><u>underlined text</u></li>
    <li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
    <li><a href="http://www.tecnick.com" dir="ltr">link to http://www.tecnick.com</a></li>
    <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br />Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
    <li>SUBLIST
        <ol>
            <li>row one
                <ul>
                    <li>sublist</li>
                </ul>
            </li>
            <li>row two</li>
        </ol>
    </li>
    <li><b>T</b>E<i>S</i><u>T</u> <del>line through</del></li>
    <li><font size="+3">font + 3</font></li>
    <li><small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal</li>
</ol>
<dl>
    <dt>Coffee</dt>
    <dd>Black hot drink</dd>
    <dt>Milk</dt>
    <dd>White cold drink</dd>
</dl>
<div style="text-align:center">IMAGES<br />
<img src="../images/logo_example.png" alt="test alt attribute" width="100" height="100" border="0" /><img src="../images/tiger.ai" alt="test alt attribute" width="100" height="100" border="0" /><img src="../images/logo_example.jpg" alt="test alt attribute" width="100" height="100" border="0" />
</div>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('example_006.pdf', 'I');

    throw new sfStopException();
  }

}
