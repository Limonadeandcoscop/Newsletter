<?php

class Newsletter_NewsletterAdminController extends Omeka_Controller_AbstractActionController {

    
    public function indexAction() {
    }

    public function downloadAction() {

        $this->_helper->viewRenderer->setNoRender();
        
        $name = tempnam('/tmp', 'csv');
        $handle = fopen($name, 'w');

        $line = array('1' => 1);
        
        // CSV header
        $line = array();
        $line[] = "E-mail";
        $line[] = "Status";
        $line[] = "Confirmation link";
        $line[] = "Request date";
        fputcsv($handle, $line);

        $users = get_db()->getTable('Newsletter')->findAll();        
        
        foreach($users as $user) {
            $line = array();
            $line[] = $user->email;
            if ($user->status == 'ok') {
                $line[] = 'OK';
                $line[] = '';
            } else {
                $line[] = 'Waiting';
                $line[] = absolute_url('newsletter/validation/id/'.$user->id.'/key/'.$user->key);
            }
            $line[] = $user->inserted;
            fputcsv($handle, $line);
        }


        header('Content-Type: application/csv');
        header('Content-Disposition:attachment;filename=newsletter.csv');
        fclose($handle);
        readfile($name);
        unlink($name);
        die();
    }

}
