<?php

class SocialLogin
{
    public function redirectToProvider(string $provider)
    {
        $client = $this->getOAuthClient($provider);

        // CSRF y PKCE
        $_SESSION['oauth2_state'] = bin2hex(random_bytes(16));
        $_SESSION['oauth2_code_verifier'] = bin2hex(random_bytes(64));
        $codeChallenge = rtrim(strtr(base64_encode(hash('sha256', $_SESSION['oauth2_code_verifier'], true)), '+/', '-_'), '=');

        $authUrl = $client->getAuthorizationUrl([
            'state' => $_SESSION['oauth2_state'],
            'scope' => match ($provider) {
                'google' => ['openid', 'email', 'profile'],
                'facebook' => ['email', 'public_profile'],
                default => [],
            },
            'code_challenge' => $codeChallenge,
            'code_challenge_method' => 'S256',
        ]);

        $_SESSION['oauth2_state'] = $client->getState(); // En caso de que lo sobrescriba

        header('Location: ' . $authUrl);
        exit;
    }

    public function handleProviderCallback(string $provider)
    {
        if (!isset($_GET['state']) || $_GET['state'] !== ($_SESSION['oauth2_state'] ?? null)) {
            $_SESSION['errors'][] = "Estado inválido. Intenta de nuevo.";
            header('Location: /login');
            exit;
        }

        try {
            $client = $this->getOAuthClient($provider);
            $accessToken = $client->getAccessToken('authorization_code', [
                'code' => $_GET['code'],
                'code_verifier' => $_SESSION['oauth2_code_verifier'] ?? null,
            ]);

            $owner = $client->getResourceOwner($accessToken);

            $profile = match ($provider) {
                'google' => [
                    'provider' => 'google',
                    'provider_id' => $owner->getId(),
                    'email' => $owner->getEmail(),
                    'name' => $owner->getName(),
                    'avatar' => $owner->getAvatar(),
                    'email_verified' => $owner->toArray()['email_verified'] ?? false,
                ],
                'facebook' => [
                    'provider' => 'facebook',
                    'provider_id' => $owner->getId(),
                    'email' => $owner->getEmail(),
                    'name' => $owner->getName(),
                    'avatar' => 'https://graph.facebook.com/' . $owner->getId() . '/picture?type=large',
                    'email_verified' => true,
                ],
                default => throw new \RuntimeException("Proveedor no soportado: $provider"),
            };

            $userModel = new usersModel();
            $user = $userModel->findOrCreateUserFromSocial($profile);

            session_regenerate_id(true);
            //$_SESSION['usersId'] = $user['usersId'];
            $_SESSION['app_emilio'] = 1;
            $_SESSION['login_attemp'] = 0;
            $_SESSION['user'] = $user;

            unset($_SESSION['oauth2_state'], $_SESSION['oauth2_code_verifier']);
            header('Location: ' . APP_DOMAIN);
            exit;
        } catch (\Throwable $e) {
            $_SESSION['errors'][] = $e->getMessage();
            unset($_SESSION['oauth2_state'], $_SESSION['oauth2_code_verifier']);
            $_SESSION['errors'][] = "Fallo en la autenticación con $provider.";
            header('Location: /login');
            exit;
        }
    }

    private function getOAuthClient(string $provider)
    {
        $cfg = $this->getProviderConfig($provider);

        return match ($provider) {
            'google' => new \League\OAuth2\Client\Provider\Google([
                'clientId' => $cfg['client_id'],
                'clientSecret' => $cfg['client_secret'],
                'redirectUri' => $cfg['redirect_uri'],
            ]),
            // 'facebook' => new \League\OAuth2\Client\Provider\Facebook([
            //     'clientId' => $cfg['client_id'],
            //     'clientSecret' => $cfg['client_secret'],
            //     'redirectUri' => $cfg['redirect_uri'],
            //     'graphApiVersion' => 'v19.0',
            // ]),
        };
    }

    private function getProviderConfig(string $provider): array
    {
        return [
            'google' => [
                'client_id' => GOOGLE_CLIENT_ID,
                'client_secret' => GOOGLE_CLIENT_SECRET,
                'redirect_uri' => GOOGLE_REDIRECT_URI
            ]

        ][$provider] ?? throw new \InvalidArgumentException("Proveedor inválido");
    }
}
