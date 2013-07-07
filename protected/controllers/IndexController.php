<?php
/**
 * User: t0m
 * Date: 16.05.13
 * Time: 15:26
 */
class IndexController extends \RMC\Controller
{
    public function indexAction()
    {
        $me = Me::getInstance()->getFullInfo();
        $skillsString = '';
        $skillsArray = array();
        foreach($me->resume->skills as $skill){
            $skillsString .= ", {$skill->name}";
            $skillsArray[$skill->level][] = array(
                'name' => $skill->name,
                'description' => $skill->description,
            );
        }

        $this->view->setPageTitle('Klimenko Aleksander. PHP Developer.');
        $viewParams = array(
            'skills' => $skillsString,
            'skillsArray' => $skillsArray,
            'age' => $me->getAge(),
            'name' => $me->firstName . ' ' . $me->lastName,
            'city' => $me->city,
            'technologies' => $me->resume->technologies,
            'experience' => $me->resume->experience,
            'jobs' => $me->resume->jobs,
            'education' => $me->education,
            'expectations' => $me->resume->expectations,
            'phone' => $me->phone,
            'email' => $me->email,
        );
        if(isset($_GET['print'])){
            $this->printCV('index', $viewParams);
        } else {
            echo $this->view->render('index', $viewParams);
        }
    }

    private function printCV($template, $params)
    {
        $html = $this->view->renderWithoutLayout($template, $params);
        $start = strpos($html, '<!-- print -->') + strlen('<!-- print -->');
        $end = strpos($html, '<!-- printEnd -->');
        $html = substr($html, $start, $end - $start);
        $html = str_replace('section', 'div', $html);
        $html = str_replace('<span id="email"></span>', $params['email'], $html);
        $html = str_replace('<span id="phone"></span>', $params['phone'], $html);
        $html = "
        <style>
           p.title{
                text-align: center;
                font-size: 20px;
           }
           ul{
                list-style-type: disc;
           }
        </style>
        " . $html;

        //die($html);
        $tcpdf = Config::get()->basePath . DIRECTORY_SEPARATOR . 'html2pdf' . DIRECTORY_SEPARATOR . 'html2pdf.class.php';

        require_once($tcpdf);

        $pdf = new HTML2PDF('P','A4','en',true, 'UTF-8');
        $pdf->setDefaultFont('freesans');
        $pdf->writeHTML($html);
        $pdf->Output('KlimenkoAleksanderPHP.pdf');

    }
}
