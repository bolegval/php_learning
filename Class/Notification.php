<?php

namespace Notification;

class User
{
    public $name;
    public $email;
    public $gender;
    public $age;
    public $phone;

    public function __construct($name, $email, $gender = null, $age = null, $phone = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
        $this->age = $age;
        $this->phone = $phone;
    }

    private function notifyOnEmail($message)
    {
        $notif = new Notification($this->name, 'email', $this->email);
        $notif-> send($this, $message);
    }

    private function notifyOnPhone($message)
    {
        $notif = new Notification($this->name, 'phone', $this->email);
        $notif-> send($this, $message);
    }
    
    public function notify($message)
    {
        if ($this->age > 18) 
        {
            $this-> notifyOnEmail($message);

            if ($this->phone)
            {
                $this-> notifyOnPhone($message);
            }

        } else 
        {
            $this->censor($message);
            $this-> notifyOnEmail($message);

            if ($this->phone)
            {
                $this-> notifyOnPhone($message);
            }
        }

        
    }

    public function censor($message) 
    {
        return htmlspecialchars($message);
    }
    
}

class Notification
{
    public $receiver;
    public $via;
    public $to;

    public function __construct($receiver, $via, $to)
    {
        $this->receiver = $receiver;
        $this->via = $via;      
        $this->to = $to;
    }

    public function send(User $user, $message)
    {   
        echo "Уведомление клиенту: " . $user->name . " на email " . 
        ($this->via == 'email' ? $user->email : $user->phone) . " : " . $message .  "</br>";
    }
}

$user1 = new User('Рома', 'user1@email.com', 'male', 17, +7912345698);
$user2 = new User('Владимир Николаевич', 'user24@email.com', 'male', 45, +793694169);
$user3 = new User('Саша', 'some@email.com', 'male', 15);
$user4 = new User('Даша', 'super@email.com', 'female', 20);


$user1->notify('Привет');
$user2->notify('Вам поступило новое сообщение');
$user3->notify('Вы добавлены');
$user4->notify('Как дела?');
