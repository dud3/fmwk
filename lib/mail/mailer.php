<?php

namespace lib\mail;

class mailer
{
    private $mail;

    public function self()
    {
        $this->mail = \lib\mail\mail::make();
        return new mailer;
    }

    public function to(string $to)
    {
        $this->mail->setTo($to, 'Recipient 1');
        return $this;
    }

    public function subj(string $subj)
    {
        $this->mail->setSubject($subj)
            ->setFrom(\lib\cfg::$cfg->mail['from'], 'Mail Bot')
            ->setReplyTo(\lib\cfg::$cfg->mail['from'], 'Mail Bot')
            ->addGenericHeader('X-Mailer', 'PHP/' . phpversion());

        return $this;
    }

    public function data(string $data, int $wrap = 79)
    {
        $this->mail->setHtml()
            ->setMessage($data)
            ->setWrap($wrap);

        return $this;
    }

    public function send()
    {
        return $this->mail->send();
    }
}
