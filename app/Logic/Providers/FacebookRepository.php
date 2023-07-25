<?php

namespace App\Logic\Providers;

use Facebook\Facebook;

class FacebookRepository
{
    protected $facebook;

    public function __construct()
    {
        $this->facebook = new Facebook([
            'app_id' => config('providers.facebook.app_id'),
            'app_secret' => config('providers.facebook.app_secret'),
            'default_graph_version' => 'v11.0'
        ]);
    }

    public function redirectTo()
    {
        $helper = $this->facebook->getRedirectLoginHelper();
    
        $permissions = [
            'pages_manage_posts',
            'pages_read_engagement'
        ];
    
        $redirectUri = config('app.url') . '/auth/facebook/callback';
    
        return $helper->getLoginUrl($redirectUri, $permissions);
    }
}