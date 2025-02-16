<?php

namespace App\Providers;

use App\Models\SMTPModel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $mailsetting = SMTPModel::first();

        if ($mailsetting) {
            $data_mail = [
                'driver'        =>  $mailsetting->mail_mailer,
                'host'          =>  $mailsetting->mail_host,
                'port'          =>  $mailsetting->mail_port,
                'encryption'    =>  $mailsetting->mail_encryption,
                'username'      =>  $mailsetting->mail_username,
                'password'      =>  $mailsetting->mail_password,
                'from'          =>  [
                    'address'   => $mailsetting->mail_from_address,
                    'name' => 'Admin E-Commerce Molla'
                ]
            ];
        }

        Config::set('mail', $data_mail);
    }
}
