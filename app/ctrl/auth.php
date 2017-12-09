<?php

namespace app\ctrl;

use \lib\app\instance\ctrl as ctrl;

class auth extends ctrl
{
    protected function login()
    {

    }

    protected function logout()
    {

    }

    protected function register()
    {
        // Register then ->

        $mail = \lib\mail\mailer::self()->to('a@b.c')->subj('Hi, there')
            ->data('<p>abcd</p>');

        if($mail->send()) {

        }
    }
}
