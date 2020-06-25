<?php

namespace App\Notifications;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAnnouncement extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $sender;

    /**
     * @var \App\Models\Course
     */
    protected $course;

    /**
     * Create a new notification instance.
     *
     * @param  string  $title
     * @param  string  $content
     * @param  string  $sender
     * @param  \App\Models\Course  $course
     */
    public function __construct(string $title, string $content, string $sender, Course $course)
    {
        $this->title = $title;
        $this->content = $content;
        $this->sender = $sender;
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title . ' | ' . $this->course->name)
            ->greeting($this->title)
            ->line($this->content)
            ->line('Course: ' . $this->course->name)
            ->salutation($this->sender)
            ->action('Bekijk announcement', str_replace('{course}', $this->course->id,
                config('announcements.url')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
