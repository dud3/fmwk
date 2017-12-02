<?php

namespace app\ctrl;

\lib\sys\module::inc('app/ctrl/ctrl');

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
