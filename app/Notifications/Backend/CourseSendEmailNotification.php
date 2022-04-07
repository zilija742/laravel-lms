<?php

namespace App\Notifications\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CourseSendEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($course)
    {
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
                    ->line('You were registered at ' . $this->course->title . ' Course')
                    ->action('View the course', url('/course/' . $this->course->slug))
                    ->line(trans('labels.backend.courses.fields.official_code') . ': ' . $this->course->official_code)
                    ->line(trans('labels.backend.courses.fields.category') . ': ' . $this->course->category->name)
                    ->line(trans('labels.backend.courses.fields.description') . ': ' . $this->course->description)
                    ->line(trans('labels.backend.courses.fields.start_date') . ': ' . $this->course->start_date)
                    ->line(trans('labels.backend.courses.fields.end_date') . ': ' . $this->course->end_date)
                    ->line(trans('labels.backend.courses.fields.expire_at') . ': ' . $this->course->expire_at);
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
