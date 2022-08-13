<?php

namespace App\Services\Facades\Mail;

use App\Services\Facades\Mail\Contracts\MailInterface;
use Exception;

class MailFacade implements MailInterface
{
    /** @var Mail $mail */
    protected $mail;

    /**
     * MailFacade constructor.
     */
    public function __construct()
    {
        $this->mail = app(Mail::class);
    }

    public final function to(string $name, string $email): self
    {
        $this->mail->addTo([$name, $email]);
        return $this;
    }

    public final function from(string $name, string $email): self
    {
        $this->mail->getHeader()->setFrom([$name, $email]);
        return $this;
    }

    public final function message(string $message): self
    {
        $this->mail->setMessage($message);
        return $this;
    }

    public final function subject(string $subject): self
    {
        $this->mail->setSubject($subject);
        return $this;
    }

    public function cc(string $cc): self
    {
        $array = $this->mail->getHeader()->getCc();
        array_push($array, $cc);
        $this->mail->getHeader()->setCc($array);
        return $this;
    }

    public function bcc(string $bcc): self
    {
        $array = $this->mail->getHeader()->getCc();
        array_push($array, $bcc);
        $this->mail->getHeader()->setBcc($array);
        return $this;
    }

    public final function send(): bool
    {
        $this->mail->send();
        return $this->mail->getStatus();
    }

    public function getStatus(): int
    {
        return $this->mail->getStatus();
    }
}
