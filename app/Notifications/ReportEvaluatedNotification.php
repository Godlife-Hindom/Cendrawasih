<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportEvaluatedNotification extends Notification
{
    use Queueable;
    public $report;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // opsional: tambahkan 'database' jika ingin tampil di UI
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
            ->subject('Hasil Evaluasi Laporan Anda')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Laporan Anda telah dievaluasi oleh pimpinan.')
            ->line('Status: ' . ucfirst($this->report->approval_status))
            ->line('Catatan Evaluasi: ' . $this->report->evaluation_note)
            ->action('Lihat Laporan', url('/user/reports/' . $this->report->id));
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
            'message' => 'Laporan Anda telah dievaluasi',
            'status' => $this->report->approval_status,
            'note' => $this->report->evaluation_note,
            'report_id' => $this->report->id
        ];
    }
}
