<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailResetPasswordToken extends Notification
{
		use Queueable;

		protected $token;

		protected $user;

		/**
		 * Create a new notification instance.
		 *
		 * @return void
		 */
		public function __construct($token,$user)
		{
				$this->token = $token;
				$this->user = $user;
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
				/*return (new MailMessage)
										->subject("Reset your password")
										->line("You are receiving this email because we received a password reset request for your account.")
										->action('Reset Password', url('password/reset', $this->token))
										->line('If you did not request a password reset, no further action is required.')
										;*/
				return (new MailMessage)->subject("Your Password Reset Link")->view(
						'auth.emails.password', ['resetToken' => $this->token,'user'=> $this->user]
				);

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
